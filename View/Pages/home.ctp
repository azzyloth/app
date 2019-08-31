<?php
/**
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 */

 
?>
<div class="row">
    <div id="hero">
        <div class="messageBox">
          <h2>bring a day of hope</h2>
          <a href="#calendar" id="chooseButton" class="btn btn-warning btn-lg btn-md">Choose Your Day</a>
          <h3>We have only 356 days left to have our Children's Home fully funded. For a $500 DONATION your name will be displayed on our website, on the day of your choice.</h3>
          <h1>You can make the difference!</h1>
        </div>
    </div>
</div>

<div class="row" style="margin-top: 40px;">
  <div class="col-md-8">
    <h5 style="margin:0 0 25px 0;">Please Select Your Day(s) of Hope</h5>
    <div id='calendar' style='width: 100%; margin: 0 auto;'></div>
  </div>
    
  <div class="col-md-4">
    <div class="tab-content">
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

        <h5>Provide Your Info</h5>
  
        <!-- Default form register -->
        <form class="text-center border border-light"  id="donations" action="#!">             
          <div class="form-row">            
              <!-- First name -->
              <input type="text" id="defaultRegisterFormFirstName" class="form-control" placeholder="First name" />
          </div>
          <div class="form-row"><!-- E-mail -->
              <!-- Last name -->
              <input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="Last name" />
            
          </div>
          <div class="form-row"><!-- E-mail -->
          
            <input type="email" id="defaultRegisterFormEmail" class="form-control" placeholder="E-mail" />
            
          </div>  
          <div class="form-row">
            <!-- Phone number -->
            <input type="text" id="defaultRegisterFormPhone" class="form-control" placeholder="Phone number" aria-describedby="defaultRegisterFormPhoneHelpBlock" />
          </div>
          <div class="form-row">
            <span class="bold addDonation">$500 cover the childrens basic necessities in a day. If you want to help more, please fill up below:</span>
            <!-- Amount -->
            <input type="number" id="defaultRegisterFormAdditionalDonation" class="form-control" placeholder="Additional Donation" value="0" />
          </div>

          <!-- Sign up button -->
          <button class="btn btn-info my-4 btn-block" type="submit">Donate Now</button>

          <p id="loader">Processing...</p>
           
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


<?= $this->Html->script('moment.min.js') ?>  
<?= $this->Html->script('fullcalendar.min.js') ?>

<?php

  $array = [];

  $events = json_encode($array);
  foreach( $donations as $donation ) {
    // $taken = json_encode($donation['Donation']);

    $taken['title'] = 'Taken';
    $taken['description'] = 'This day is already taken';
    $taken['start'] = $donation['Donation']['start_date'];
    $taken['end'] = $donation['Donation']['end_date'];
	  $taken['color'] = '#F1760A';
    $taken['editable'] = false;
    $taken['allDay'] = true;
    $array[] = $taken;

  }

  $events = json_encode( $array );
  //debug($array);
?>

<script type="text/javascript">
$(document).ready(function() {
  var events = <?php echo $events; ?>;
    $('#calendar').fullCalendar({    
      customButtons: {
        myCustomButton: {
          text: 'Reset',
          click: function() {
            location.reload();
          }
        }
      },  
	    header: {
        right: 'prev,next,month,today',
        left: 'title',
        titleFormat: 'MMM',
        center:'myCustomButton'
      },
      // defaultDate: '2018-11-16',
      navLinks: true,
      //editable: true,
      //eventLimit: true,
      selectable: true,
      events: <?php echo $events; ?>,
      select: function(startDate, endDate, allDay, view) {
        var dateStart = moment(startDate);
        var dateEnd = moment(endDate);
        //console.log(dateStart);
        if (dateStart.isValid() && dateEnd.isValid()) {
          //console.log(dateStart.utc().format("MM/DD HH:mm:ss") +" - "+dateEnd.utc().format("MM/DD HH:mm"));
          $('#calendar').fullCalendar('renderEvent', {
            title: 'My Choice',
            start: dateStart,
            end: dateEnd,
            allDay: true
          });
         
        }
        $("#calendar").fullCalendar("unselect");
      },
        selectAllow: function(selectInfo) {
          var selected_start = selectInfo.start.startOf("day");
          var selected_end = selectInfo.end.startOf("day");
          var evts = $("#calendar").fullCalendar("clientEvents", function(evt) {
              var st = evt.start.clone().startOf("day");
            if (evt.end) {
              var ed = evt.end.clone().startOf("day"); }
            else { 
              ed = st;
           }
            //return true if the event overlaps with the selection
            return (selected_start.isBefore(ed) && selected_end.isAfter(st));
         
           } 
           );
          return evts.length == 0;
        }

       
    });
    var evts = $("#calendar").fullCalendar("clientEvents");
          console.log(evts);

    $('form#donations').submit( function (e) {
      e.preventDefault();      
     
      var firstName = $('#defaultRegisterFormFirstName').val();
      var lastName = $('#defaultRegisterFormLastName').val();
      var email = $('#defaultRegisterFormEmail').val();
      var phone = $('#defaultRegisterFormPhone').val();
      var addDonation = $('#defaultRegisterFormAdditionalDonation').val();

      

      var calendarData = $('#calendar').fullCalendar('clientEvents');
      console.log(calendarData);
      var selectedDays = false;
      for (var key in calendarData) {

        if( calendarData[key].title === 'My Choice') {
          $('#loader').show();

          selectedDays = true;

          var startDate = calendarData[key].start.toJSON();
          var endDate = calendarData[key].end.toJSON();

          var days = Math.ceil((calendarData[key].end.toDate() - calendarData[key].start.toDate()) / (1000 * 60 * 60 * 24));          
          
          if (addDonation > 0 ) {
            var amount = days*500+ parseInt(addDonation);
          } else {
            var amount = days*500;
          }          

          var data = {
            'firstname': firstName,
            'lastname': lastName,
            'email': email,
            'mobile': phone,
            'amount': amount,
            'start_date': startDate,
            'end_date': endDate,
			'transaction_id': Math.floor(Math.random() * 100)
          };
          console.log(data);
		  var url = "<?php echo $this->webroot; ?>donations/save";
		  var thanks = "<?php echo $this->webroot; ?>pages/thanks";
          
          // ajax call
          $.ajax({
            type: 'POST',
            //url: '/hopevillage/donations/save',
            url:url,
            data: data,
            cache: false,
            dataType: 'JSON',
            beforeSend: function() {
              // $('#na').html('checking...')
			 console.log(url);
            },
            success: function (html) {
              $('#loader').hide();

              // redirect to thank you page
              window.location.replace(thanks);
			  console.log(thanks);
            },
            error: function(jqxhr,textStatus) {
				   $('#loader').hide();
                        console.log(jqxhr);
						console.log(textStatus);
                }
          });
        }
      }
      
      if (!selectedDays) {
        alert('Please Select The Days On The Calendar.');
        return false;
      }
    });	
  });
  </script>