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
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
//$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('styles.css');
		echo $this->Html->css('bootstrap.min.css');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>

	
  	<?= $this->Html->css('bootstrap.min.css') ?>
  	<?= $this->Html->css('home.css') ?>     

	<!--- <?= $this->Html->script('bootstrap.min.js') ?> --->

  	<!--- Full Calender IO --->
  	<?= $this->Html->script('jquery-3.4.1.min.js') ?>
  	<?= $this->Html->script('jquery-ui.min.js') ?>
	<?= $this->Html->script('jquery.redirect.js') ?>
  	<?= $this->Html->css('fullcalendar.min.css') ?>
</head>
<body>
	<div id="main">
		<div id="header">
			<div class="container logo-container">
			<?php echo $this->Html->link(
					$this->Html->image('hopevillage-logo.png', array('alt' => $cakeDescription, 'border' => '0')),
					'/',
					array('escape' => false, 'id' => 'logo')
				);
			?>
			</div>
		</div>
		<div id="content">
			<div class="container">
			<?php echo $this->Flash->render(); ?>

			<?php echo $this->fetch('content'); ?>
			</div>
		</div>
		<?php
	echo $this->element('footer');
?>
	</div>
	<?php	
		//echo $this->element('sql_dump'); 
	?>
</body>
</html>
