<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Bookmarks Controller
 *
 * @property App\Model\Table\BookmarksTable $Bookmarks
 */
class BookmarksController extends AppController {

/**
 * beforeFilter method
 *
 * @param Event $event 
 * @return void
 */
	public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
    
        $this->Auth->allow(['tags', 'index', 'view']);
    }

	public function isAuthorized($user) {
    	$action = $this->request->action;

	     // All registered users can access users index action
    	$actionsAuthorizedToAll = [
    		'index', 
    		'add', 
    		'tags', 
    		'mine',
    		'mine_in_public'];
	    if (in_array($action, $actionsAuthorizedToAll)) {
	        return true;
	    }

	    // Check that the bookmark belongs to the current user.
	    $id = $this->request->params['pass'][0];
	    $bookmark = $this->Bookmarks->get($id);
	    if ($bookmark->user_id == $user['id']) {
			return true;
	    }

	    // All other actions require an id.
		if (empty($this->request->params['pass'][0])) {
			return false;
	    }

	    return parent::isAuthorized($user);
	}

	public function tags() {
	    $tags = $this->request->params['pass'];

	    $this->paginate = [
	    	'finder' => [
	    		'tagged' => [
	    			'tags' => $tags
	    		]
	    	]
	    ];

	    $bookmarks = $this->paginate($this->Bookmarks);

	    $this->set(compact('bookmarks', 'tags'));
	}

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$conditions = [
			'Bookmarks.public' => true
		];
		$this->paginate = [
			'conditions' => $conditions,
			'contain' => [
			    'Users' => function ($q) {
			       return $q
			            ->select(['username', 'id']);
			    }
			],
			'order' => [
				'Bookmarks.updated' => 'desc', 
				'Bookmarks.id' => 'desc'
			]
	    ];
	    $this->set('bookmarks', $this->paginate($this->Bookmarks));
	}

/**
 * the index view of logged in user's bookmarks method
 *
 * @return void
 */
	public function mine() {
		$conditions = [
			'Bookmarks.user_id' => $this->Auth->user('id'),
		];
		$this->paginate = [
        	'conditions' => $conditions,
        	'order' => [
				'Bookmarks.updated' => 'desc', 
				'Bookmarks.id' => 'desc'
			]
	    ];
	    $this->set('bookmarks', $this->paginate($this->Bookmarks));
	}

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$bookmark = $this->Bookmarks->get($id, [
			'contain' => ['Users', 'Tags']
		]);
		$this->set('bookmark', $bookmark);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$bookmark = $this->Bookmarks->newEntity($this->request->data);
		$bookmark->user_id = $this->Auth->user('id');
		if ($this->request->is('post')) {
			if ($this->Bookmarks->save($bookmark)) {
				$this->Flash->success('The bookmark has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The bookmark could not be saved. Please, try again.');
			}
		}
		$users = $this->Bookmarks->Users->find('list');
		$tags = $this->Bookmarks->Tags->find('list');
		$this->set(compact('bookmark', 'users', 'tags'));
	}

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$bookmark = $this->Bookmarks->get($id, [
			'contain' => ['Tags']
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$bookmark = $this->Bookmarks->patchEntity($bookmark, $this->request->data);
			$bookmark->user_id = $this->Auth->user('id');
			if ($this->Bookmarks->save($bookmark)) {
				$this->Flash->success('The bookmark has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The bookmark could not be saved. Please, try again.');
			}
		}
		$users = $this->Bookmarks->Users->find('list');
		$tags = $this->Bookmarks->Tags->find('list');
		$this->set(compact('bookmark', 'users', 'tags'));
	}

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$bookmark = $this->Bookmarks->get($id);
		$this->request->allowMethod(['post', 'delete']);
		if ($this->Bookmarks->delete($bookmark)) {
			$this->Flash->success('The bookmark has been deleted.');
		} else {
			$this->Flash->error('The bookmark could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}
