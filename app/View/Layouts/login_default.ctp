<!DOCTYPE html>
<html>	
<head>
<title>Inicio de Sesión</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--web-fonts-->
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!--/web-fonts-->
<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(array('style',
                    'http://fonts.googleapis.com/css?family=Montserrat:400,700'
                    ));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
<!--User-Login-->

<div class="avtar">
        <?php echo $this->Html->image('logo-large.png', array('alt' => 'logo'));?>    
</div>
	<?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
<!--/User-Login-->
<!--start-copyright-->
<div class="copy-right">
	<p>Sistema de Información Gerencial, Agencia de Viajes Escamilla, 2015</p> 
</div>
<!--//end-copyright-->	
</body>
</html>