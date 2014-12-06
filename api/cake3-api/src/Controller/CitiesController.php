<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Cities Controller
 *
 * @property \App\Model\Table\CitiesTable $Cities
 */
class CitiesController extends AppController {

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->paginate = [
			'contain' => ['Countries']
		];
		$this->set('cities', $this->paginate($this->Cities));
		$this->set('_serialize', ['cities']);
	}

/**
 * Index method
 *
 * @return void
 */
	public function search() {
		$this->paginate = [
			'contain' => ['Countries']
		];

		// pass in the query string
		if (!empty($_GET['q'])) {
			$customFinderOptions = ['q' => $_GET['q']];
			$this->paginate['finder'] = [
                'matched' => $customFinderOptions
            ];
		}

		$cities = $this->paginate($this->Cities);
		$data = $cities;
		$pagination = $this->request->params['paging'];
		$metadata = $this->convertApiPaginationFormat();
		$metadata['query'] = empty($_GET['q']) ? null : $_GET['q'];

		$this->set(compact('data', 'cities', 'metadata', 'pagination'));
		$this->set('_serialize', ['data', 'metadata', 'pagination']);
		$this->render('index');
	}

// need to include next_url, prev_url, first_url, last_url, etc
// need to ensure against 404 for empty search results
	// cater for cursors http://fractal.thephpleague.com/pagination/
	// use http://fractal.thephpleague.com/serializers/
	protected function convertApiPaginationFormat() {
		$apiPagination = [];
		$paginationData = $this->request->params['paging']['Cities'];
		$apiPagination['total'] = $paginationData['count'];
		$apiPagination['count'] = $paginationData['current'];
		$apiPagination['per_page'] = $paginationData['perPage'];
		$apiPagination['current_page'] = $paginationData['page'];
		$apiPagination['total_pages'] = $paginationData['pageCount'];
		$apiPagination['sort'] = $paginationData['sort'];
		$apiPagination['direction'] = $paginationData['direction'];
		$apiPagination['limit'] = $paginationData['limit'];
		$apiPagination['query'] = null;
		return $apiPagination;
	}

/**
 * View method
 *
 * @param string|null $id City id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$city = $this->Cities->get($id, [
			'contain' => ['Countries']
		]);
		$this->set('city', $city);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$city = $this->Cities->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->Cities->save($city)) {
				$this->Flash->success('The city has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The city could not be saved. Please, try again.');
			}
		}
		$countries = $this->Cities->Countries->find('list');
		$this->set(compact('city', 'countries'));
	}

/**
 * Edit method
 *
 * @param string|null $id City id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$city = $this->Cities->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$city = $this->Cities->patchEntity($city, $this->request->data);
			if ($this->Cities->save($city)) {
				$this->Flash->success('The city has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The city could not be saved. Please, try again.');
			}
		}
		$countries = $this->Cities->Countries->find('list');
		$this->set(compact('city', 'countries'));
	}

/**
 * Delete method
 *
 * @param string|null $id City id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$city = $this->Cities->get($id);
		$this->request->allowMethod(['post', 'delete']);
		if ($this->Cities->delete($city)) {
			$this->Flash->success('The city has been deleted.');
		} else {
			$this->Flash->error('The city could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}

}
