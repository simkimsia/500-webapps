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
                $result = $this->Photo->createWatermarkWithAttachments($this->request->data);
                $message = sprintf('Your photo has been saved. Click <a target="_blank" href="%s">here</a>', $result);
                $this->Session->setFlash($message, 'default', ['class' => 'notice success']);
            } catch (Exception $e) {
                $this->Session->setFlash($e->getMessage());
            }
        }
    }

}