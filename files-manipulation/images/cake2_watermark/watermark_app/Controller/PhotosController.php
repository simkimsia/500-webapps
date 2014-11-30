<?php
App::uses('AppController', 'Controller');
/**
 * Images Controller
 *
 * @property Image $Image
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PhotosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	public function add() {
        if ($this->request->is('post')) {
            try {
                $this->Photo->createWithAttachments($this->request->data);
                $this->Session->setFlash(__('Your photo has been saved'));
            } catch (Exception $e) {
                $this->Session->setFlash($e->getMessage());
            }
        }
    }

    public function add_watermark() {
        if ($this->request->is('post')) {
            try {
                $this->Photo->createWatermarkWithAttachments($this->request->data);
                $this->Session->setFlash(__('Your photo has been saved'));
            } catch (Exception $e) {
                $this->Session->setFlash($e->getMessage());
            }
        }
    }

}