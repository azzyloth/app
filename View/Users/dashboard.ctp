
	<?php
//debug($donations);
$array = [];

$events = json_encode($array);
foreach( $donations as $donation ) {
  // $taken = json_encode($donation['Donation']);

  $taken['title'] = 'Taken';
  $taken['firstname'] = $donation['Donation']['firstname'];
  $taken['lastname'] = $donation['Donation']['lastname'];
  $taken['amount'] = $donation['Donation']['amount'];
  $taken['description'] = 'This day is already taken';
  $taken['description'] = 'This day is already taken';
  $taken['day'] = date('d',strtotime($donation['Donation']['start_date']));
  $taken['start'] = $donation['Donation']['start_date'];
  $taken['end'] = $donation['Donation']['end_date'];
  $taken['color'] = '#F1760A';
  $taken['editable'] = false;
  $date1 = new DateTime($donation['Donation']['start_date']);
  $date2 = new DateTime($donation['Donation']['end_date']);
  $diff = $date1->diff($date2)->format("%d");
    if($diff >= 2) {
        for($y = 1; $y <= $diff; $y++) {
            $taken['amount'] = $donation['Donation']['amount']/$diff;
            $array[] = $taken;
            $taken['day'] = $taken['day']+1;
        }
    }else {
        $array[] = $taken;
    }
}

$events = json_encode( $array );
//debug($donations);
//debug($array);
?>
	<div class="main-view">
    <table class="table table-striped">
        <thead>
        <tr>
            <td>Day</td>
            <td>Donor</td>
            <td>Amount</td>
            </tr>
        </thead>
        <tbody>
        <?php
           $month = date("m");
           $year = date("Y");
           $last_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        ?>
        <?php for ($x = 1; $x <= $last_day; $x++) : ?>
               <tr>
                    <td><?= $x; ?></td>
                    
                    <?php
                    $key = array_search($x, array_column($array, 'day'));
                    //echo $key.'<br/>';
                    if(($key != "") || ($key === 0)) {
                        echo '<td>'.($array[$key]['firstname'] != '' ? $array[$key]['firstname'] : 'Anonymous').'</td>';
                        echo '<td>'.$array[$key]['amount'].'</td>';
                    }else {
                        echo '<td>&nbsp;</td>';
                        echo '<td>&nbsp;</td>';
                    }
                    ?>
                    
               </tr>
                <?php endfor; ?>
</tbody>
</table>
	</div>	
		

<script type="text/javascript">

  $(function () {            
     $('#start_date').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: moment().valueOf()
        });
        $('#end_date').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: moment().valueOf(),
            useCurrent: false //Important! See issue #1075
        });
        $("#start_date").on("dp.change", function (e) {
            $('#end_date').data("DateTimePicker").minDate(e.date);
        });
        $("#end_date").on("dp.change", function (e) {
            $('#start_date').data("DateTimePicker").maxDate(e.date);
        });



});

$(document).ready(function() {

       $('#loading-image').hide();

});      
  </script>
	
