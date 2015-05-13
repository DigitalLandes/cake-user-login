<?php

App::uses('AppController', 'Controller');

class DashboardController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Dashboard';

/**
 * Default models
 *
 * @var array
 */
	public $uses = array();

/**
 * Index method
 *
 * Displays dashboard
 *
 */
	public function index() {
		$this->set('title_for_layout', 'Dashboard');
		$this->set('loggedinUser', $this->loggedinUser);
	}

}
