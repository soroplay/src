<h1>プロフィール編集</h1>

<?=$this->Form->create($entity,['url'=>['action'=>'teacherProfileEdit'],'enctype'=>'multipart/form-data']) ?>
<fieldset>
名前：              <?=$this->Form->input('teacherName',['type'=>'text','label'=>false]) ?>
					<?=$this->Form->input('photograph',['type'=>'file','label'=>false]) ?>
メールアドレス:     <?=$this->Form->input('mailAdress',['type'=>'email','label'=>false]) ?>
電話番号:           <?=$this->Form->input('phoneNumber',['type'=>'tel','label'=>false]) ?>
パスワード:         <?=$this->Form->input('password',['type'=>'password','label'=>false]) ?>
パスワード確認：    <?=$this->Form->input('password_confirm',['type'=>'password','label'=>false]) ?>
口座番号：          <?=$this->Form->input('accountNumber',['type'=>'text','label'=>false]) ?>

</fieldset>
<?=$this->Form->button("完了", array(
  'type' => 'submit',
  'name' => 'edit',
  'value' => 'edit'
)) ?>
<?=$this->Form->end()?>