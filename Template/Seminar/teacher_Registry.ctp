<h1>受講者登録</h1>             
<div class="addbtndiv">
	<?=$this->Form->button('戻る', ['onclick' => 'history.back()', 'type' => 'button'])?>
</div>

<?=$this->Form->create($entity,['url'=>['action'=>'teacherRegistry']]) ?>
<fieldset>
ID：             <?=$this->Form->input('teacherId',['type'=>'text','label'=>false]) ?>
パスワード:       <?=$this->Form->input('password',['type'=>'text','label'=>false]) ?>
パスワード確認:   <?=$this->Form->input('chk_pass',['type'=>'text','label'=>false]) ?>
名前:            <?=$this->Form->input('teacherName',['type'=>'text','label'=>false]) ?>
メールアドレス：  <?=$this->Form->input('mailAddress',['type'=>'text','label'=>false]) ?>
電話番号：        <?=$this->Form->input('phoneNumber',['type'=>'text','label'=>false]) ?>
口座番号：        <?=$this->Form->input('accountNumber',['type'=>'text','label'=>false]) ?>
   
</fieldset>
<?=$this->Form->button("確認する", array(
		'type' => 'submit',
		'name' => 'confirm',
		'value' => 'confirm'
)) ?>
<?=$this->Form->end()?>