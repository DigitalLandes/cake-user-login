<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Users';

/**
 * Default models
 *
 * @var array
 */
	public $uses = array('User');

/**
 * Login method
 *
 * Logs in a user into system
 *
 * @return void
 */
	public function login() {
		if ($this->request->is('post')) {
			$isValidUser = $this->User->find('first', array('conditions' => array('User.email' => $this->request->data['Login']['email'], 'User.password' => md5($this->request->data['Login']['password']))));
			if (!empty($isValidUser)) {
				$this->setUserSession($isValidUser['User']);
				if (!empty($this->request->data['Login']['remember_me'])) {
					$this->RememberMe->rememberUser($isValidUser['User']['email'], "14 Days");
				}
				$this->Session->setFlash("Successfully logged in!");
				$this->redirect('/dashboard');
			} else {
				$this->Session->setFlash("Email address or password is wrong.");
			}
		}
		$this->set('title_for_layout', 'Login');
		$this->layout = 'signin';
	}

/**
 * Logout method
 *
 * Logs out user from system
 *
 * @return void
 */
	public function logout() {
		$this->Session->delete('Config.LoggedinUser');
		$this->RememberMe->removeRememberedUser();
		$this->redirect('/users/login');
	}

}
