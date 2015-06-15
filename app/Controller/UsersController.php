<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

    public $paginate=array(
        'limit'=>10,
        'order'=>array('User.id'=>'asc')
    );
    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        //$this->Auth->allow('logout');
    }
    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Session->setFlash(__('Usuario y contraseña invalidos'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuario invalido'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('El usuario fue guardado'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('El usuario no pudo ser guardado. Porfavor intente de nuevo.')
            );
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuario Invalido'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Cambios guardados con éxito'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('Cambios no guardados. Porfavor intente de nuevo.')
            );
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }
    public function editMe(){
        $this->User->id = $this->Auth->user('id');
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuario Invalido'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Cambios guardados con éxito'));
                return $this->redirect(array(
                                        'controller' => 'pages',
                                        'action' => 'display',
                                        'home')
                        );
            }
            $this->Session->setFlash(
                __('Cambios no guardados. Porfavor intente de nuevo.')
            );
        } else {
            $this->request->data = $this->User->read(null, $this->Auth->user('id'));
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuario Inválido'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('Usuario Eliminado'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('El usuario no fue eliminado'));
        return $this->redirect(array('action' => 'index'));
    }

}
