<div class="actions">
	<h3><?php echo __('Quick Links'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(
   '<i class="fa fa-home"></i>Home',
    array(
        'controller'=>'pages',
        'action'=>'display'
    ),
    array(
        'escape'              => false  //NOTICE THIS LINE ***************
    )
); ?></li>
 	</ul>
</div>
