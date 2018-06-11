<h1>受講者登録確認</h1>             
<div class="addbtndiv">
	<?=$this->Form->button('戻る', ['onclick' => 'history.back()', 'type' => 'button'])?>
</div>

<fieldset>
ID：				<?=$this->request->data('studentId') ?><br>
パスワード:		<?=$this->request->data('password') ?><br>
パスワード確認: 	<?=$this->request->data('chk_pass') ?><br>
名前:				<?=$this->request->data('studentName') ?><br>
メールアドレス：	<?=$this->request->data('mailAddress') ?><br>
電話番号：		<?=$this->request->data('phoneNumber') ?><br>
クレジットカード：	<?=$this->request->data('creditInfo') ?><br>
</fieldset>

<?php 
echo $this->Form->create($entity,['url'=>['action'=>'studentRegistry']]);

echo $this->Form->hidden('studentId', ['value'=>$this->request->data('studentId')]);
echo $this->Form->hidden('password', ['value'=>$this->request->data('password')]);
echo $this->Form->hidden('chk_pass', ['value'=>$this->request->data('chk_pass')]);
echo $this->Form->hidden('studentName', ['value'=>$this->request->data('studentName')]);
echo $this->Form->hidden('mailAddress', ['value'=>$this->request->data('mailAddress')]);
echo $this->Form->hidden('phoneNumber', ['value'=>$this->request->data('phoneNumber')]);
echo $this->Form->hidden('creditInfo', ['value'=>$this->request->data('creditInfo')]);


/*foreach((array)$this->request->data['confirm'] as $name => $val){
	echo $this->Form->hidden($name, array('value'=>$val));
}*/
?>
 
<?=$this->Form->button("登録", array(
		'type' => 'submit',
		'name' => 'confirm',
		'value' => 'registry'
)) ?>
<?=$this->Form->end()?>