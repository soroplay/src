<h1>受講者登録</h1>             

<?=$this->Form->create($entity,['url'=>['action'=>'studentRegistry']]) ?>
<div id="main">
	<div id="list">
 		<tr>
			<td><p>ID：</p><?=$this->Form->input('studentId',['type'=>'text','label'=>false,'class'=>'list']) ?></td>
			<td><p>パスワード:</p><?=$this->Form->input('password',['type'=>'text','label'=>false,'class'=>'list']) ?></td>
			<td><p>パスワード確認:</p><?=$this->Form->input('chk_pass',['type'=>'text','label'=>false,'class'=>'list']) ?></td>
			<td><p>名前:</p><?=$this->Form->input('studentName',['type'=>'text','label'=>false,'class'=>'list']) ?></td>
			<td><p>メールアドレス：</p><?=$this->Form->input('mailAddress',['type'=>'text','label'=>false,'class'=>'list']) ?></td>
			<td><p>電話番号：</p><?=$this->Form->input('phoneNumber',['type'=>'text','label'=>false,'class'=>'list']) ?></td>
			<td><p>クレジットカード：</p><?=$this->Form->input('creditInfo',['type'=>'text','label'=>false,'class'=>'list']) ?></td>
 		</tr>
	</div>
</div>
<?=$this->Form->button("確認する", array(
		'class'=>'btn',
		'type' => 'submit',
		'name' => 'confirm',
		'value' => 'confirm'
)) ?>
<?=$this->Form->end()?>