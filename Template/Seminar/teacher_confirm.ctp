<h1>受講者登録確認</h1>             
<div class="addbtndiv">
	<?=$this->Form->button('戻る', ['onclick' => 'history.back()', 'type' => 'button'])?>
</div>

<fieldset>
ID：				<?=$this->request->data('teacherId') ?><br>
パスワード:		<?=$this->request->data('password') ?><br>
パスワード確認: 	<?=$this->request->data('chk_pass') ?><br>
名前:				<?=$this->request->data('teacherName') ?><br>
メールアドレス：	<?=$this->request->data('mailAddress') ?><br>
電話番号：		<?=$this->request->data('phoneNumber') ?><br>
クレジットカード：	<?=$this->request->data('accountNumber') ?><br>
</fieldset>

<?php 
echo $this->Form->create($entity,['url'=>['action'=>'teacherRegistry']]);

echo $this->Form->hidden('teacherId', ['value'=>$this->request->data('teacherId')]);
echo $this->Form->hidden('password', ['value'=>$this->request->data('password')]);
echo $this->Form->hidden('chk_pass', ['value'=>$this->request->data('chk_pass')]);
echo $this->Form->hidden('teacherName', ['value'=>$this->request->data('teacherName')]);
echo $this->Form->hidden('mailAddress', ['value'=>$this->request->data('mailAddress')]);
echo $this->Form->hidden('phoneNumber', ['value'=>$this->request->data('phoneNumber')]);
echo $this->Form->hidden('accountNumber', ['value'=>$this->request->data('accountNumber')]);
?>
 
<?=$this->Form->button("登録", array(
		'type' => 'submit',
		'name' => 'confirm',
		'value' => 'registry'
)) ?>
<?=$this->Form->end()?>