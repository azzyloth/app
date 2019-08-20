<?php

App::uses('AppController', 'Controller');


class DonationsController extends AppController {

	public function index() {
		// grab all donations

		$this->set('donations', $this->Donation->find('all'));


	}

	public function save(  ) {
		// save donations

		if ($this->request->is('post')) {
            $this->Donation->create();
            if ($this->Donation->save($this->request->data)) {
                $this->Flash->success(__('Your post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add your post.'));
		}
		

		// for ajax calls
		$this->autoRender = false;

	}
}
