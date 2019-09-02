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
		// save donations

		// if ($this->request->is('post')) {
            // $this->Donation->create();
            // if ($this->Donation->save($this->request->data)) {
               	// // $this->Flash->success(__('Your post has been saved.'));
                // // return $this->redirect(array('action' => 'index'));
            // }
            // // $this->Flash->error(__('Unable to add your post.'));
		// }
		
		if( $this->request->is('ajax') ) {
		   	$this->Donation->create();
            if ($this->Donation->save($this->request->data)) {
               	// $this->Flash->success(__('Your post has been saved.'));
                echo $this->Donation->getLastInsertID();
            }else {
				echo json_encode('error');
			}
		}
		
		exit;
	}

	function process() {
		// $this->Donation->id = $id;

		pr( $this->request->data );
        /*if (!$this->Donation->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }

		$this->set('donation', $this->Donation->findById($id));

		

		if ($this->request->is('post')) {			
			//print_r( $this->request->data );
			$data = array(
				'amount' => $this->request->data['amount'],
				'stripeToken' => $this->request->data['stripeToken'],
				'description' => 'Hope Village Donation'
			);
			
			$result = $this->Stripe->charge($data);
			//if charge success
			if(isset($result['stripe_id'])) {
				//$this->Donation->id = $id;
				$this->Donation->saveField('status', 'success');
				
				$this->redirect(array('controller' => 'pages', 'action' => 'thanks'));
			}else {
				echo "error";
			}
			exit;

			// if result success update db status to pending
		}*/

		


	}
}
