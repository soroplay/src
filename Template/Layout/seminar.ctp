<!DOCTYPE html>
<html lang="ja">
<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
<?= $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', ['block' => true]) ?>
<?= $this->Html->script('//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js', ['block' => true]) ?>
<?= $this->Html->css('//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css') ?>


<?php
echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
//echo $this->Html->css('base.css');
//echo $this->Html->css('home.css');
//echo $this->Html->css('style.css');
echo $this->Html->css('bootstrap/bootstrap.css');
?>


<header>
</header>


<body>

	<?=$this->fetch('content') ?>


</body>

<footer>
</footer>

</html>
