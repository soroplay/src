<h1>講師セミナー確認</h1>             
<div class="addbtndiv">
	<?=$this->Form->button('戻る', ['onclick' => 'history.back()', 'type' => 'button'])?>
</div>

<?php foreach($seminarList as $obj): ?>
<fieldset>
セミナー名：		<?=$obj['title'] ?><br>
開催日:		<?=$obj['eventDate']->i18nFormat('yyyy年MM月dd日') ?><br>
応募人数: 	    <?=$obj['count'] ?><br>
金額:			<?=$obj['reward'] ?><br>
</fieldset>

<?=$this->Form->create(null, ['url'=>['action'=>'flagup']]) ?>
<?=$this->Form->hidden('seminarId', ['value'=>$obj['id']]) ?>

<?=$this->Form->button("開催する", array(
		'type' => 'submit',
		'name' => 'confirm',
		'value' => 'confirm'
)) ?>
<?=$this->Form->end()?>

<?=$this->Form->postButton('取消', ['action' => 'teacherSeminarCancel', $obj['id']]) ?>

<?php endforeach; ?>
