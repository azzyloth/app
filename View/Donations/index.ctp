<?php $paginator = $this->Paginator; ?>
<h1>Donations</h1>
<?php if($donations): ?>
<table class="table striped">
    <tr>
        <th><?php echo $paginator->sort('id', 'ID'); ?></th>
        <th><?php echo $paginator->sort('firstname', 'Firstname'); ?></th>
        <th><?php echo $paginator->sort('lastname', 'lastname'); ?></th>
        <th><?php echo $paginator->sort('start_date', 'Date'); ?></th>
        <th><?php echo $paginator->sort('amount', 'Amount'); ?></th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($donations as $donation): ?>
    <tr>
        <td><?php echo $donation['Donation']['id']; ?></td>
        <td><?php echo $donation['Donation']['firstname']; ?></td>
        <td><?php echo $donation['Donation']['lastname']; ?></td>
        <td><?php echo $donation['Donation']['start_date']; ?> - <?php echo $donation['Donation']['end_date']; ?></td>
        <td><?php echo $donation['Donation']['amount']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($donations); ?>
</table>
<?php 
    // pagination section
    echo "<div class='paging'>";
 
        // the 'first' page button
        echo $paginator->first("First");
         
        // 'prev' page button, 
        // we can check using the paginator hasPrev() method if there's a previous page
        // save with the 'next' page button
        if($paginator->hasPrev()){
            echo $paginator->prev("Prev");
        }
         
        // the 'number' page buttons
        echo $paginator->numbers(array('modulus' => 2));
         
        // for the 'next' button
        if($paginator->hasNext()){
            echo $paginator->next("Next");
        }
         
        // the 'last' page button
        echo $paginator->last("Last");
     
    echo "</div>";
    
?>

<?php endif; ?>

