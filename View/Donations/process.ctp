<script src="https://js.stripe.com/v3/"></script>
<?php 

    pr($donation);

?>

<?php
/**
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 */

 
?>

<div class="row" style="margin-top: 40px;"> 
    
  <div class="col-md-12">
    <div class="tab-content">
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

        <h5>My Donation</h5>
  
        <!-- Default form register -->
        <form class="text-center border border-light"  method="POST" id="payment-form" action="/hopevillage/donations/process/<?= $donation['Donation']['id']; ?>">

            <input type="hidden" name="id" class="form-control" value="<?= $donation['Donation']['id']; ?>" readonly />

            <div class="form-row"><!-- First name -->
                Name on Card:
                <input type="text" name="name" id="defaultRegisterFormFirstName" class="form-control" placeholder="Name on Card" />
            </div>
            <div id="card-element"></div>

            <input type="hidden" name="amount" class="form-control" placeholder="Amount" readonly value="<?= $donation['Donation']['amount'];?>" />            

          <!-- Sign up button -->
          <button class="btn btn-info my-4 btn-block" type="submit">Proceed</button>

          <p id="loader">Processing...</p>           
          <hr>          
        </form>            
        <!-- Default form register -->
      </div> 
      
    </div>
    
    </div>
   
</div>


<script type="text/javascript">
    // onsubmit 
    var stripe = Stripe('pk_test_5yqj93G0Rh1u6ewOJg4F4prs00iNeUyS00');
    // Create an instance of Elements.
// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
  $('#loader').hide();
}

$(document).ready(function(){
    $('#loader').hide();
});
</script>