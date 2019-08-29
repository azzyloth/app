<?= print_r( $donations ); ?>

<!DOCTYPE html>
<html>
<head>
  <?= $this->Html->charset() ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
      <?= $cakeDescription ?>
  </title>

  <?= $this->Html->meta('icon') ?>
  <?= $this->Html->css('bootstrap.min.css') ?>
  <?= $this->Html->css('home.css') ?>     

	<!--- <?= $this->Html->script('bootstrap.min.js') ?> --->

  <!--- Full Calender IO --->
  <?= $this->Html->script('jquery-3.4.1.min.js') ?>
  <?= $this->Html->script('jquery-ui.min.js') ?>
  <?= $this->Html->css('fullcalendar.min.css') ?>

</head>
<body class="home">

  <header class="row">
  <!--
    <div class="header-image"><?= $this->Html->image('cake.logo.svg') ?></div>
    <div class="header-title">
        <h1>Welcome to CakePHP <?= Configure::version() ?> Red Velvet. Build fast. Grow solid.</h1>
    </div>
	-->
  </header>
  <div class="container">
    <div class="row">
      <div class="col-md-12">        
          <div id='calendar' style='width: 100%; margin: 0 auto;'></div>

          <button>Proceed to Next Step</button>
        
      </div>
    </div>
    <div class="row" style="margin-top: 30px;">
      <div class="col-md-12">
        <div class="tab-content">
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
					  <!-- Default form register -->
            <form class="text-center border border-light"  id="donations" action="#!">
              <p class="h4 mb-4">My information</p>
              
              <div class="form-row mb-4">
                <div class="col">
                  <!-- First name -->
                  <input type="text" id="defaultRegisterFormFirstName" class="form-control" placeholder="First name" />
                </div>
                <div class="col">
                  <!-- Last name -->
                  <input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="Last name" />
                </div>

                <!-- Amount -->
                <input type="text" id="defaultRegisterFormDonation" class="form-control mb-4" placeholder="Amount" />      

                <!-- E-mail -->
                <input type="email" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="E-mail" />
                
                <!-- Phone number -->
                <input type="text" id="defaultRegisterPhonePassword" class="form-control mb-4" placeholder="Phone number" aria-describedby="defaultRegisterFormPhoneHelpBlock" />
                
                <!-- Sign up button -->
                <button class="btn btn-info my-4 btn-block" type="submit">Donate Now</button>
              </div>             
              <hr>

              <!-- Terms of service -->
              <p>By making a  <em>Donation</em> you agree to our <a href="" target="_blank">Privacy Policy</a> and will be directed to the payment gateway</p>
            </form>            
            <!-- Default form register -->
          </div>
  
          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            Your donation will cover Orphanage expenses on all the dates you've selected
          </div>
        </div>
  		</div>
	</div>
</div>

<?= $this->Html->script('moment.min.js') ?>  
<?= $this->Html->script('fullcalendar.min.js') ?>



<script>
$(document).ready(function() {

    $('#calendar').fullCalendar({      
	    header: {
        left: 'prev,next today',
        center: 'addEventButton',
        right: 'month'
      },
      defaultDate: '2018-11-16',
      navLinks: true,
      editable: true,
      eventLimit: true,
      selectable: true,
      events: [{
        title: 'Taken',
        start: '2018-11-16',
        description: 'this day was already taken'
      }],
      select: function (startDate, endDate) {
        var dateStart = moment(startDate);
        var dateEnd = moment(endDate);

        if (dateStart.isValid() && dateEnd.isValid()) {
          console.log(dateStart.utc().format("MM/DD HH:mm") +" - "+dateEnd.utc().format("MM/DD HH:mm"));
          $('#calendar').fullCalendar('renderEvent', {
            title: 'Your choice',
            start: dateStart,
            end: dateEnd,
            allDay: true
          });
        }
      }
    });


    $('form#donations').submit( function (e) {
        e.preventDefault();

        console.log('test1');

        var data1 = $('#calendar').fullCalendar('clientEvents');
        console.log(data1);
        
        console.log('test2');
    })
	
	});
  
// header: {
				// left: 'prev,next today',
				// center: 'title',
				// right: 'month,agendaWeek,agendaDay'
			// },
			// defaultDate: '2019-07-12',
			// selectable: true,
			// selectHelper: true,
			// dayClick: function(date, jsEvent, view) {
				 // alert('You selected ' + date.format())
			// },
				// select: function(startDate, endDate, jsEvent, view) {
					// console.log(startDate.format());
					// console.log(endDate.format());
				  // alert('You selected ' + startDate.format() + ' to ' + endDate.format() );
				// },
			// editable: false,
			// eventOverlap: false,
			// events: [
				// {
					// title: 'Taken',
					// start: '2019-07-01',
					// end: '2019-07-05'
				// },
				// {
					// title: 'Taken',
					// start: '2019-07-08',
					// end: '2019-07-12'
				// },
				// {
					// title: 'Taken',
					// start: '2019-07-17',
					// end: '2019-07-19'
				// }
			// ],
			// selectOverlap: function(event) {
				// return ! event.block;
			// }
		// });   
</script>

</body>

</html>
