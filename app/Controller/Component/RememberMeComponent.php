<?php

/*
 * RememberMe Component file
 *
 */
App::uses('Component', 'Controller');
App::uses('Security', 'Utility');

/**
 * RememberMe component
 *
 */
class RememberMeComponent extends Component {

/**
 * Other components used by this component
 *
 * @var array
 */
	public $components = array('Cookie');

/**
 * Stores current controller object
 *
 * @var Controller
 */
	public $controller;

/**
 * Cipher key for encryption/decryption
 *
 * @var string
 */
	private $__cypherKey = '17485931237564892755682123047369192123734583655920926';

/**
 * Cookie name
 *
 * @var string
 */
	private $__cookieName = 'secret';

	public function initialize(Controller $controller) {
		parent::initialize($controller);
		$this->controller = $controller;
		$this->__cypherKey = Configure::read('Security.salt');
	}

	public function rememberUser($userData = null, $interval = "14 Days") {
		if (!empty($userData)) {
			$encryptedData = Security::cipher($userData, $this->__cypherKey);
			$this->Cookie->write($this->__cookieName, $encryptedData, false, $interval);
		}
	}

	public function getRememberedUser() {
		$cookieData = $this->Cookie->read($this->__cookieName);
		if (!empty($cookieData)) {
			$data = Security::cipher($cookieData, $this->__cypherKey);
			return $data;
		} else {
			return false;
		}
	}

	public function removeRememberedUser() {
		$this->Cookie->delete($this->__cookieName);
	}

}
