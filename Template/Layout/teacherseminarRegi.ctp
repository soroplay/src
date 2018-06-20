<!DOCTYPE html>
<html lang="ja">

<head>
<?php
echo $this->Html->css('teachsemiRegi.css');
echo $this->Html->script('jquery-3.3.1.min.js');
echo $this->Html->script('teachsemiRegi.js');
echo $this->fetch('meta');
echo $this->fetch('css');
?>
<?=$this->Html->charset(); ?>
<title>
	<?=$this->fetch('title') ?>
</title>



</head>


<body>
	 <div id="container">
		<div id="header"><div id="logo"><?=$this->Html->image("/img/mypagelogo.png",['alt'=>'ロゴ'])?>
		</div></div>
		<div id="content">	
			<?=$this->fetch('content') ?>
		</div>
		<div id="footer"></div>
	</div>

</body>

</html>
