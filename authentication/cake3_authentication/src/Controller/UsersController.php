<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\ForbiddenException;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController {

/**
 * beforeFilter method
 *
 * @param Event $event 
 * @return void
 */
	public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow('add', 'logout');
    }

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->set('users', $this->paginate($this->Users));
	}

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$user = $this->Users->get($id, [
			'contain' => []
		]);
		$this->set('user', $user);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$user = $this->Users->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->Users->save($user)) {
				$this->Flash->success('The user has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The user could not be saved. Please, try again.');
			}
		}
		$this->set(compact('user'));
	}

/**
 * login method
 *
 * @return void
 */
	public function login() {
	    if ($this->request->is('post')) {
	        $user = $this->Auth->identify();
	        if ($user) {
	            $this->Auth->setUser($user);
	            return $this->redirect($this->Auth->redirectUrl());
	        }
	        $this->Flash->error(__('Invalid username or password, try again'));
    	}
	}

/**
 * logout method
 *
 * @return void
 */
	public function logout() {
	    return $this->redirect($this->Auth->logout());
	}

}
