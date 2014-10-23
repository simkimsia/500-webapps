<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Network\Exception\ForbiddenException;
use Cake\Event\Event;
use Cake\Controller\Component\AuthComponent;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

/**
 * Initialization hook method.
 *
 * Use this method to add common initialization code like loading components.
 *
 * @return void
 */
	public function initialize() {
		$this->loadComponent('Flash');

        $authOptions = [
            'loginRedirect' => [
                'controller' => 'Users',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'logout'
            ],
            'authorize' => ['Controller']
        ];

        $authOptions['authenticate'] = [
            'FOC/Authenticate.MultiColumn' => [
                'fields' => [
                    'username' => 'login',
                    'password' => 'password'
                ],
                'columns' => ['username', 'email'],
                'userModel' => 'Users',
            ]
        ];

		$this->loadComponent('Auth', $authOptions);
	}

    public function beforeFilter(Event $event) {
        $this->_setAuthUser();
    }

    protected function _setAuthUser() {
        // we want to access the logged in user in the View
        $this->set(array('authUser' => $this->Auth->user()));
    }

    public function isAuthorized($user) {
        // Admin can access every action
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }

        // Default deny
        return false;
    }

}
