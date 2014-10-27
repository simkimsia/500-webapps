<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Log\Log;
use Cake\Database\Expression\ValuesExpression;
use Cake\Database\TypeMap;

/**
 * Users Controller
 *
 * @property App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController {

/**
 * demonstrate upsert in the long winded way. Still works
 *
 * @return void
 */
	public function upsert_long_winded() {
		$newUsers = [
	    	[
	    		'username' => 'Felicia',
	    		'age' => 27,
	    	],
	    	[
	    		'username' => 'Timmy',
	    		'age' => 71,
	    	],
	    ];

		foreach ($newUsers as $newUser) {
	    	$existingRecord = $this->Users->find()
	    		->select(['id'])
	    		->where(['username' => $newUser['username']])
	    		->first();

	    	if (empty($existingRecord)) {
	    		$insertQuery = $this->Users->query();
	    		$insertQuery->insert(array_keys($newUser))
			        ->values($newUser)
			        ->execute();
	    	} else {
			    $updateQuery = $this->Users->query();
	    		$updateQuery->update()
	    			->set($newUser)
	    			->where(['id' => $existingRecord->id])
	    			->execute();
	    	}
	    }
	}

/**
 * demonstrate upsert using epilog method
 *
 */
	public function upsert() {
		$newUsers = [
	    	[
	    		'username' => 'Felicia',
	    		'age' => 27,
	    	],
	    	[
	    		'username' => 'Timmy',
	    		'age' => 71,
	    	],
	    ];

	    $columns = array_keys($newUsers[0]);

	    $newUsersValuesExpression = [];

	    $upsertQuery = $this->Users->query();

	    // $newUsersValuesExpression = new ValuesExpression($columns, $upsertQuery->typeMap()->types([]));
	    // $newUsersValuesExpression->values($newUsers);

	    $upsertQuery->insert($columns);
	    $newUsersValuesExpression = $upsertQuery->clause('values')->values($newUsers);
	    			
	    $upsertQuery->values($newUsersValuesExpression)
			        ->epilog('ON DUPLICATE KEY UPDATE `username`=VALUES(`username`), `age`=VALUES(`age`)')
	    			->execute();
	}

/**
 * Add method
 *
 * @return void
 */
	public function upsert_explanation() {
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
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function reset($id = null) {
		$user = $this->Users->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->data);
			if ($this->Users->save($user)) {
				$this->Flash->success('The user has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The user could not be saved. Please, try again.');
			}
		}
		$this->set(compact('user'));
	}

}
