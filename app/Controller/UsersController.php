<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('FormEnum'); // https://github.com/ceeram/static_bakery/blob/master/src/articles/2010/09/Form-Helper-Enum-Fields-to-Select-Boxes.rst
	
	
  public function isAuthorized($user) {
      if($user['role']=='admin') {
             return true;
      }
      if ( in_array($this->action, array('edit','delete')) ) {
	        if($user['id']!=$this->request->params['pass'][0]) {
             return false;
          }
	    }
      return true;
	}
  
  
  public function login() {
		if($this->Auth->loggedIn()) {
			$this->Session->setFlash(__('You are already logged in'.' '.CakeSession::read("Auth.User.name")));
			$this->redirect(array('action' => 'index'));
		}
	    if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
	            $this->redirect($this->Auth->redirect());   
	        } else {
	            $this->Session->setFlash('Your username/password combination was incorrect');
	        }
	    }
	}
	
  public function logout() {
	    $this->redirect($this->Auth->logout());
	}  
  
	function index() {

		
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
		
		
	}

	function view($id = null) {

		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		if(CakeSession::read("Auth.User.role") !='admin'){
			if($this->Auth->loggedIn()) {
				$this->Session->setFlash(__('You can not create another account if you aready have one'));
				$this->redirect(array('action' => 'index'));
			}
		}
		

		if (!empty($this->request->data)) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}

	function edit($id = null) {

		
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid user'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->User->read(null, $id);
		}
	}

	function delete($id = null) {
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Auth->user('role') == 'admin') {
			$this->Session->setFlash(__('Admins can not delete thier account'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	 public function beforeFilter() {
	 	parent::beforeFilter();
        $this->Auth->allow('add'); // allow non-logged in access to media views
    }
}
?>