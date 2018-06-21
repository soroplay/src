<!DOCTYPE html>
<html lang="ja">

<head>
<?php
echo $this->Html->css('TeacherProfStudentSide');
echo $this->fetch('meta');
echo $this->fetch('css');
?>
<?=$this->Html->charset(); ?>
<title>
	<?=$this->fetch('title') ?>
</title>



</head>


<body>
	 
		
		<div id="content">	
			<?=$this->fetch('content') ?>
		</div>
		<div id="footer"></div>
	</div>

</body>

</html>
