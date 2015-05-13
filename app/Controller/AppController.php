<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Session', 'Cookie', 'RememberMe');

/**
 * Default models
 *
 * @var array
 */
	public $uses = array('User');

/**
 * Logged in user details
 *
 * @var array
 */
	public $loggedinUser = array();

/**
 * beforeFilter callback
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->__validateAndSetCurrentUser();
	}

/**
 * Validates the user
 *
 * It checks whether user is logged in or not and redirects to corresponding page
 * Also it sets a global variable with loggedin user data which can be
 * used in other controllers and views
 * 
 * @return void
 */
	private function __validateAndSetCurrentUser() {
		$loggedinUser = $this->Session->read('Config.LoggedinUser');
		if ($loggedinUser) {
			$this->loggedinUser = $loggedinUser;
			if ('login' == $this->request->params['action']) {
				$this->redirect('/dashboard');
			}
		} else {
			$isRemembered = $this->RememberMe->getRememberedUser();
			if (!empty($isRemembered) && 'logout' != $this->request->params['action']) {
				$user = $this->User->find('first', array('conditions' => array('User.email' => $isRemembered)));
				if (!empty($user)) {
					$this->RememberMe->removeRememberedUser();
					$this->RememberMe->rememberUser($isRemembered);
					$this->setUserSession($user['User']);
				} else {
					$this->redirect('/users/login');
				}
			}
			if ('login' != $this->request->params['action']) { // need to bypass the login action itself
				$this->redirect('/users/login');
			}
		}
	}

/**
 * Sets the current user session
 *
 * @param array $userArr Data array of the user
 * @return void
 */
	public function setUserSession($userArr = array()) {
		if (!empty($userArr)) {
			if ($this->Session->read('Config.LoggedinUser')) {
				$this->Session->delete('Config.LoggedinUser');
			}
			$this->Session->write('Config.LoggedinUser', $userArr);
		}
	}

}
