<?php

App::uses('AppController', 'Controller');


class DonationsController extends AppController {
	public $components = array(
		'Stripe.Stripe',
		'Paginator'
	);



	public function beforeFilter() {
		parent::beforeFilter();
 
		$this->Auth->allow('save','process');
	}

	function index() {
		// grab all donations
		$this->layout = 'admin';
		$this->paginate = array(
			'limit' => 5,
			'order' => array(
				'Donation.start_date' => 'asc'
			)
		);
		$donations = $this->paginate('Donation');
		$this->set(compact('donations'));
	}

	public function save() {		
		
		$this->Donation->create();
		if($this->Donation->save($this->request->data)) {
			$id = $this->Donation->getLastInsertID();

			echo json_encode( $id );
		}

		$this->autoRender = false;
		
		// $this->Flash->success(__('Your post has been saved.'));
		exit;
	}

	function process() {
		
		$amount = 0;
		if( isset($this->request->data['ids']) && isset($this->request->data['total_amount'] )) {				
			$amount = $this->request->data['total_amount'];

			$this->Session->write('Donation.ids', $this->request->data['ids']);
			$this->Session->write('Donation.amount', $amount);
		}		

		if ( !empty($this->request->data['stripeToken']) && !empty($this->Session->read('Donation.ids')) ) {
			
			//pr( $this->request->data );
			$data = array(
				'amount' => $this->Session->read('Donation.amount'),
				'stripeToken' => $this->request->data['stripeToken'],
				'description' => 'Hope Village Donation'
			);
			
			$result = $this->Stripe->charge($data);
			//if charge success
			if(isset($result['stripe_id'])) {
				//$this->Donation->id = $id;
				// $this->Donation->saveField('status', 'success');

				$ids = $this->Session->read('Donation.ids');
				$this->Donation->updateAll(  
					array('Donation.status' => "'success'"),
					array('Donation.id' => $ids)
				);
				
				$this->redirect(array('controller' => 'pages', 'action' => 'thanks'));
			} else {
				$ids = $this->Session->read('Donation.ids');
				$this->Donation->updateAll(  
					array('Donation.status' => "'failed'"),
					array('Donation.id' => $ids)
				);
				
				$id = $ids[0];
				// $this->redirect(array('controller' => 'pages', 'action' => 'thanks'));

				// echo "error";
				// pr($result);

				$this->Flash->error(
					__('Something went wrong. Please, try again.')
				);
			}		
			
			// exit;
		}	
		$this->set(compact('amount'));	
	}

	function thisMOnth(){
		// grab all donations
		$this->layout = 'admin';
		$conditions = array(
            'MONTH(Donation.start_date)' => date('n')
        );
		$this->paginate = array(
			'conditions' => $conditions,
			'limit' => 25,
			'order' => array(
				'Donation.start_date' => 'asc'
			)
		);
		$donations = $this->paginate('Donation');
		$this->set(compact('donations'));
	}

	function thisYear(){
		// grab all donations
		$this->layout = 'admin';
		$conditions = array(
            'Year(Donation.start_date)' => date('Y')
        );
		$this->paginate = array(
			'conditions' => $conditions,
			'limit' => 25,
			'order' => array(
				'Donation.start_date' => 'asc'
			)
		);
		$donations = $this->paginate('Donation');
		$this->set(compact('donations'));
	}
	function failedDonations(){
		// grab all donations
		$this->layout = 'admin';
		$conditions = array(
            'Donation.status' => 'failed'
        );
		$this->paginate = array(
			'conditions' => $conditions,
			'limit' => 25,
			'order' => array(
				'Donation.start_date' => 'asc'
			)
		);
		$donations = $this->paginate('Donation');
		$this->set(compact('donations'));
	}
	function incompleteDonations(){
		// grab all donations
		$this->layout = 'admin';
		$conditions = array(
            'Donation.status' => 'incomplete'
        );
		$this->paginate = array(
			'conditions' => $conditions,
			'limit' => 25,
			'order' => array(
				'Donation.start_date' => 'asc'
			)
		);
		$donations = $this->paginate('Donation');
		$this->set(compact('donations'));
	}
}
