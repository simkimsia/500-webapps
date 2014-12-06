<?php
App::uses('AppController', 'Controller');
/**
 * Cities Controller
 *
 * @property City $City
 */
class CitiesController extends AppController {

	public function index() {
        $cities = $this->City->find('all');

        $this->set(compact('cities'));
		$this->set('_serialize', ['cities']); //use this but only in conjunction with JsonView
    }

}
