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
    
        $this->Auth->allow('tags', 'index');
    }

	public function isAuthorized($user) {
    	$action = $this->request->action;

    	// The add and index actions are always allowed.
	    if (in_array($action, ['index', 'add', 'tags'])) {
			return true;
		}
		// All other actions require an id.
		if (empty($this->request->params['pass'][0])) {
			return false;
	    }

	    // Check that the bookmark belongs to the current user.
	    $id = $this->request->params['pass'][0];
	    $bookmark = $this->Bookmarks->get($id);
	    if ($bookmark->user_id == $user['id']) {
			return true;
	    }

	    return parent::isAuthorized($user);
	}

	public function tags() {
	    $tags = $this->request->params['pass'];
	    $bookmarks = $this->Bookmarks->find('tagged', [
			'tags' => $tags
	    ]);
	    $this->set(compact('bookmarks', 'tags'));
	}

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->paginate = [
        	'conditions' => [
            	'Bookmarks.user_id' => $this->Auth->user('id'),
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
			'contain' => ['Users', 'Tags', 'BookmarksTags']
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
