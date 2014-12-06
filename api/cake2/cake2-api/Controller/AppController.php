<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

/**
 * Components
 *
 * @var array
 */
	public $components = [
		'Paginator', 'Session',
		'RequestHandler'
	];

	public function beforeFilter() {
		// Add new detectors for Request
		// $this->_addNewDetectorsToRequest();
		// $this->_configurePreferredResponseForAPI();
		// $this->_configureSecurityForAPI();
	}

	public function enableCORS() {
		$this->response->header('Access-Control-Allow-Origin','*');
        $this->response->header('Access-Control-Allow-Methods','*');
        $this->response->header('Access-Control-Allow-Headers','X-Requested-With');
        $this->response->header('Access-Control-Allow-Headers','Content-Type, x-xsrf-token');
        $this->response->header('Access-Control-Max-Age','172800');
	}

	protected function _addNewDetectorsToRequest() {
		App::uses('CustomRequestDetector', 'Utility');
		$this->request->addDetector('api', array('callback' => array('CustomRequestDetector', 'isAPISubdomain')));
	}

/**
 *
 * Security component turn validatePost to false for API submissions
 *
 **/
	protected function _configureSecurityForAPI() {
		// do we have Security component?
		$securityComponentOn = (isset($this->Security));

		if ($securityComponentOn) {
			// we only do this for api calls
			if ($this->request->is('api')) {
				$this->Security->validatePost = false;
				$this->Security->requireSecure();
				$this->Security->csrfCheck = false;
			}
		}
	}

/**
 *
 * Configure default extensions for API
 *
 **/
	protected function _configurePreferredResponseForAPI() {
		if ($this->request->is('api')) {
			$this->RequestHandler->prefers('json');
		}
	}
}
