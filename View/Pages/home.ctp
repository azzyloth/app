<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->layout = false;

if (!Configure::read('debug')) :
    throw new NotFoundException(
        'Please replace src/Template/Pages/home.ctp with your own version or re-enable debug mode.'
    );
endif;

$cakeDescription = 'CakePHP: the rapid development PHP framework';
?>
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
    <link rel='stylesheet' href='https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.min.css' />
    <script src='https://fullcalendar.io/js/fullcalendar-3.1.0/lib/jquery.min.js'></script>
    <script src='https://fullcalendar.io/js/fullcalendar-3.1.0/lib/jquery-ui.min.js'></script>
	<?= $this->Html->script('bootstrap.min.js') ?>

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
		<div class="col-md-8">
		 <div class="tab-content">
             <div id='calendar' style='width: 100%; margin: 0 auto;'></div>
			 </div>
		</div>
		<div class="col-md-4">

                  <div class="tab-content">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
					<!-- Default form register -->
<form class="text-center border border-light"  action="#!">

    <p class="h4 mb-4">My information</p>

    <div class="form-row mb-4">
        <div class="col">
            <!-- First name -->
            <input type="text" id="defaultRegisterFormFirstName" class="form-control" placeholder="First name">
        </div>
        <div class="col">
            <!-- Last name -->
            <input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="Last name">
        </div>
    </div>

    <!-- E-mail -->
    <input type="email" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="E-mail">

    <!-- Phone number -->
    <input type="text" id="defaultRegisterPhonePassword" class="form-control mb-4" placeholder="Phone number" aria-describedby="defaultRegisterFormPhoneHelpBlock">
	
	




    <!-- Sign up button -->
    <button class="btn btn-info my-4 btn-block" type="submit">Donate Now</button>

    <hr>

    <!-- Terms of service -->
    <p>By making a 
        <em>Donation</em> you agree to our
        <a href="" target="_blank">Privacy Policy</a> and will be directed to the payment gateway

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

<script src='https://fullcalendar.io/js/fullcalendar-3.1.0/lib/moment.min.js'></script>
<script src='https://fullcalendar.io/js/fullcalendar-3.1.0/lib/jquery.min.js'></script>
<script src='https://fullcalendar.io/js/fullcalendar-3.1.0/lib/jquery-ui.min.js'></script>
<script src='https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.min.js'></script>

<script>
$(document).ready(function() {
		$('#calendar').fullCalendar({
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
       
	    header: {
        left: 'prev,next today',
        center: 'addEventButton',
        right: 'month,agendaWeek,agendaDay,listWeek'
      },
      defaultDate: '2018-11-16',
      navLinks: true,
      editable: true,
      eventLimit: true,
      selectable: true,
      events: [{
          title: 'Simple static event',
          start: '2018-11-16',
          description: 'Super cool event'
        },

      ],
      select: function (startDate, endDate) {
        var dateStart = moment(startDate);
        var dateEnd = moment(endDate);

        if (dateStart.isValid() && dateEnd.isValid()) {
          $('#calendar-5').fullCalendar('renderEvent', {
            title: 'Long event',
            start: dateStart,
            end: dateEnd,
            allDay: true
          });
        }
      }
    });
	
	});
  
   
</script>

</body>

</html>
