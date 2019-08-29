<?php

App::uses('AppController', 'Controller');


class DonationsController extends AppController {


	public function beforeFilter() {
		parent::beforeFilter();
 
		$this->Auth->allow();
	}
	public $components = array(
		'Stripe.Stripe'
	);

	public function index() {
		// grab all donations

		$this->set('donations', $this->Donation->find('all'));


	}

	public function save(  ) {
		// save donations

		if ($this->request->is('post')) {
            $this->Donation->create();
            if ($this->Donation->save($this->request->data)) {
               	// $this->Flash->success(__('Your post has been saved.'));
				// return $this->redirect(array('action' => 'index'));
				

            }
            // $this->Flash->error(__('Unable to add your post.'));
		}

		$data = array(
			'amount' => '1.50',
			'stripeToken' => 'tok_0NAEASV7h0m7ny',
			'description' => 'Casi Robot - casi@robot.com'
		);
		
		$result = $this->Stripe->charge($data);
		debug($result);
		exit;

		// for ajax calls
		//$this->autoRender = false;
		
	}
}
