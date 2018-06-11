<h1>セミナー参加確認</h1>             
<div class="addbtndiv">
	<?=$this->Form->button('戻る', ['onclick' => 'history.back()', 'type' => 'button'])?>
</div>

<fieldset>
セミナー名：	<?=$this->request->data('seminarTitle') ?><br>
講師:		<?=$this->request->data('teacherName') ?><br>
概要: 	<?=$this->request->data('outline') ?><br>
会場:		<?=$this->request->data('venue') ?><br>
参加費：	<?=$this->request->data('entryFee') ?><br>
備考：		<?=$this->request->data('remarks') ?><br>
</fieldset>

<?php 
echo $this->Form->create($entity,['url'=>['action'=>'seminar_student_registry']]);

echo $this->Form->hidden('seminarId', ['value'=>$this->request->data('seminarId')]);

?>
 
<?=$this->Form->button("確定", array(
		'type' => 'submit',
		'name' => 'confirm',
		'value' => 'registry'
)) ?>
<?=$this->Form->end()?>