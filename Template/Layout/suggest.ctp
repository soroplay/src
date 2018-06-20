<!DOCTYPE html>
<html lang="ja">

<head>
<?php
echo $this->Html->css('suggest');
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
		<div id="header">
			<div id="logo"><?=$this->Html->image("/img/mypagelogo.png",['alt'=>'ロゴ'])?>
			<div id="logout"><?=$this->Html->link('ログアウト',array('style'=>'text-decoration:none'),['action'=>'logout']);?></div>
			<div id="mypage"><?=$this->Html->link('マイページ',['action'=>'studentMyPage']);?></div>

			</div>
		</div>
	</div>
		<div id="content">	
			<?=$this->fetch('content') ?>
		</div>
		<div id="footer"></div>
	</div>

</body>

</html>
