<?php
namespace App\Model\User;
use App\{Controller, Middleware, Model};
use Rych\Random\Random;
use Slim\{Http\Response, Http\Request, PDO};
class Handler {
	protected $pdo;

	public function __construct(PDO\Database $pdo) {
		$this->pdo = $pdo;
	}

	private function select(string $key, $value) {
		return $this->pdo->select()->from('users')->where($key, '=', $value)
			->execute()->fetch();
	}

	public function insert(array $user) {
		// Trim
		$user = array_map('trim', $user);

		// Validate
		$v = new Validate($user);
		$v->chkEmailAddress();
		$v->chkUserName();

		// Check Exists
		if (!empty($this->getByUserName($user['username'])) || !empty($this->getByEmail($user['email'])))
			throw new Controller\Exception\JSON(_('This email adress and/or username is already in use.'));

		// Generate Password
		$random = new Random();
		$password = $random->getRandomString(12);
		$passhash = password_hash($password, PASSWORD_DEFAULT);

		// Insert User
		$id = $this->pdo->insert(array(
				'apikey', 'status', 'email', 'username', 'passhash',
				'regip', 'registered', 'custom'))
			->into('users')
    	->values(array(
				$this->generateAPIKey(), 1, $user['email'], $user['username'], $passhash,
				inet_pton($_SERVER['REMOTE_ADDR']), date('Y-m-d H:i:s'), json_encode($user['custom']) ?: null
		))->execute();

		// Return ID + password
		return array('id' => $id, 'password' => $password);
	}

	public function get(integer $id) {
		$v = new Validate(array('id' => $id));
		$v->chkUserId();

		return $this->select('id', $id);
	}

	public function getByUserName(string $name) {
		$v = new Validate(array('username' => $name));
		$v->chkUserName();

		return $this->select('username', $name);
	}

	public function getByEmail(string $email) {
		$v = new Validate(array('email' => $email));
		$v->chkEmailAddress();

		return $this->select('email', $email);
	}

	public function generateAPIKey() {
		$random = new Random();
	 	return $random->getRandomString(32);
	}
}
