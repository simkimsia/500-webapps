<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\City;
use App\Model\Transformer\CityTransformer;
use League\Url\Url;

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
		$extraOptions = [];
		$extraOptions['query'] = empty($_GET['q']) ? null : $_GET['q'];
		$metadata = $this->convertApiPaginationFormat($extraOptions);
		

		$this->set(compact('data', 'cities', 'metadata', 'pagination'));
		$this->set('_serialize', ['data', 'metadata', 'pagination']);
		$this->render('index');
	}

// need to include next_url, prev_url, first_url, last_url, etc
// need to ensure against 404 for empty search results
	// cater for cursors http://fractal.thephpleague.com/pagination/
	// use http://fractal.thephpleague.com/serializers/
	protected function convertApiPaginationFormat($extraOptions = []) {
		$apiPagination 					= [];
		$paginationData 				= $this->request->params['paging']['Cities'];
		$apiPagination['total'] 		= $paginationData['count'];
		$apiPagination['count'] 		= $paginationData['current'];
		$apiPagination['per_page'] 		= $paginationData['perPage'];
		$apiPagination['current_page'] 	= $paginationData['page'];
		$apiPagination['total_pages'] 	= $paginationData['pageCount'];
		$apiPagination['sort'] 			= $paginationData['sort'];
		$apiPagination['direction'] 	= $paginationData['direction'];

		$apiPagination['limit'] = $paginationData['limit'];
		$apiPagination = array_merge($apiPagination, $extraOptions);
		
		$url = Url::createFromServer($_SERVER);
		
		// array to hold the generated URLs
		$paginations = array();

		//get the current path
		$query = $url->getQuery();

		$apiPagination['next_url'] = false;
		$apiPagination['prev_url'] = false;

		if ($paginationData['nextPage']) {
			$query['page'] = $apiPagination['current_page'] + 1;
			$url->setQuery($query);
			$apiPagination['next_url'] = $url->getRelativeUrl();
		} 
		if ($paginationData['prevPage']) {
			$query['page'] = $apiPagination['current_page'] - 1;
			$url->setQuery($query);
			$apiPagination['prev_url'] = $url->getRelativeUrl();
		}
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
