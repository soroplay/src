<!DOCTYPE html>
<html lang="ja">

<head>
<?php
echo $this->Html->css('cake.Login2');
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
		<a href="http://localhost/cake3app/seminar/studentRegistry" id="student">受講者新規登録</a>
		<a href="http://localhost/cake3app/seminar/teacherRegistry" id="teacher">講師新規登録</a>
		</div></div>
		<div id="content">	
			<?=$this->fetch('content') ?>
		</div>
		<div id="footer"></div>
	</div>

</body>

</html>
