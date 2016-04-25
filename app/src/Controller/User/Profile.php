<?php
namespace App\Controller\User;
use App\{Controller, Middleware, Model};
use Slim\{Container, Http\Request, Http\Response, Views\Twig};
use Volnix\CSRF\CSRF;
class Profile {
	protected $handler;
	protected $view;

	public function __construct(Container $ci) {
		$this->handler = new Model\User\Handler($ci->get('pdo'));
		$this->view = $ci->get('view');
	}

	public function __invoke(Request $request, Response $response, $args) {
		switch ($args['base']) {
			case 'process':
				// Check Xhr + CSRF
				$input = $request->getParsedBody() ?: array();
				if (!$request->isXhr() || !CSRF::validate($input))
					return $response->withJson('Invalid Request', 201);

				try {
					$method = $request->isPatch() ? 'patch' : 'insert';
					$result = array('success' => $this->handler->{$method}($input));
				} catch (Controller\Exception\JSON $e) {
					$result = array('error' => $e->getMessage());
				}
				return $response->withJson($result, 201);
				break;
			case 'signup':
			case 'login':
			case 'recovery':
				return $this->view->render($response, 'profile/'.$args['base'].'.html', array(
					'token' => array('name' => CSRF::TOKEN_NAME, 'value' => CSRF::getToken())
				));
				break;
		}

	}

}
