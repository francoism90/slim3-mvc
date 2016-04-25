<?php
namespace App\Model\User;
use App\{Controller, Middleware, Model};
use Slim\{Http\Request, Http\Response, PDO};
use Valitron\Validator;
class Validate {
	protected $input;
	protected $validator;

	public function __construct(array $in) {
		$this->input = $in;
		$this->validator = new Validator($in);
	}

	public function __destruct() {
		if (!$this->validator->validate())
			throw new Controller\Exception\JSON($this->validator->errors());
	}

	public function chkUserId() {
		$this->validator->rule('required', 'id');
		$this->validator->rule('integer', 'id');
		$this->validator->rule('lengthMax', 'id', 12);
	}

	public function chkUserName() {
		$this->validator->rule('required', 'username');
		$this->validator->rule('alphaNum', 'username');
		$this->validator->rule('lengthBetween', 'username', 5, 12);
	}

	public function chkEmailAddress() {
		$this->validator->rule('required', 'email');
		$this->validator->rule('email', 'email');
		$this->validator->rule('lengthBetween', 'email', 5, 128);
	}

	public function chkFirstName() {

	}

	public function chkLastName() {

	}
}
