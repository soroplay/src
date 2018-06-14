<h1>サイト名</h1>
<fieldset>
<p class="teacherId">ID：<?= $teacher->teacherId ?></p>
<p class="teacherName">名前：<?=$teacher->teacherName ?></p>
<p class="rate">評価：
<?php
	for($i=0; $i<$teacher->rate; $i++){
		echo "★";
	}
	for($i=0; $i<5-$teacher->rate; $i++){
		echo "☆";
	}
?>
</p>
<?php if($teacher->photograph == null): ?>
<p class="photographNull">画像なし</p>
<?php else : ?>
<p class="photograph"><?php $img = base64_encode(stream_get_contents($teacher->photograph)); ?></p>
<img src="data:image/png;base64,<?=$img ?>" width="200px">
<?php endif; ?>
<p class="mailAdress">メールアドレス：<?=$teacher->mailAdress ?></p>
<p class="phoneNumber">電話番号：<?=$teacher->phoneNumber ?></p>
<p class="password">パスワード：<?=$teacher->password ?></p>
<p class="accountNumber">口座番号：<?=$teacher->accountNumber ?></p>
</fieldset>

<div class="achievement div">
<?=$this->Form->button('実績', ['onclick' => '/achievement.php', 'type' => 'button'])?>
</div>
<div class="editProfile div">
<?=$this->Form->button('編集', ['onclick' => '/teacherProfileEdit.php', 'type' => 'button'])?>
</div>

<div class="teacherSeminar">
<?=$this->Form->create(null,['type'=>'post','url'=>['action'=>'teacherSeminar']]) ?>
<?=$this->Form->select('category',array(
				'1'=>'TI')); ?>
<?=$this->Form->end()?>

<table id="sheet1" class="sheet">
<tbody>
<?php foreach($seminarId as $obj): ?>
<tr>
<td><?=$obj->seminarTitle ?></td>
<td><?=h($obj->capacity) ?></td>
<td><?=h($obj->dueDate) ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

<div class="teacherDateHeld">
<?=$this->Form->create(null,['url'=>['action'=>'dateHeld']]) ?>
<?=$this->Form->select('category',array(
				'1'=>'TI')); ?>
<?=$this->Form->end()?>

<table id="sheet1" class="sheet">
<tbody>
<?php foreach($seminarId as $obj): ?>
<tr>
<td><?=$obj->seminarTitle ?></td>
<td><?=h($obj->dueDate) ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>