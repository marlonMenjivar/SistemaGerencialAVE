<?php
App::uses('AppController', 'Controller');
/**
 * Etl Users Controller
 *
 * @property EtlUser $EtlUser
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class EtlUsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Session');
        public $paginate=array(
            'limit'=>7,
            'order'=>array('EtlUser.id'=>'desc')
        );
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->EtlUser->recursive = 0;
		$this->set('etluser', $this->paginate());
	}

    
}