<div class="main-contents">
<div class="form-space">
	<?=$this->Form->create($entity,['url'=>['action'=>'teacherRegistry']]) ?>
		<ul>
			<li class="li id"><label for="id">ID</label>
			<?=$this->Form->input('teacherId',['type'=>'text','label'=>false,'class'=>'input']) ?>
			</li>
			<li class="li name"><label for="name">名前</label>
			<?=$this->Form->input('teacherName',['type'=>'text','label'=>false,'class'=>'input']) ?>
			</li>
			<li class="li password"><label for="password">パスワード</label>
			<?=$this->Form->input('password',['type'=>'text','label'=>false,'class'=>'input']) ?>
			</li>
			<li class="li pascheck"><label for="pascheck">パスワード確認</label>
			<?=$this->Form->input('chk_pass',['type'=>'text','label'=>false,'class'=>'input']) ?>
			</li>
			<li class="li mail"><label for="mail">メールアドレス</label>
			<?=$this->Form->input('mailAddress',['type'=>'text','label'=>false,'class'=>'input']) ?>
			</li>
			<li class="li phonenum"><label for="phonenum">電話番号</label>
			<?=$this->Form->input('phoneNumber',['type'=>'text','label'=>false,'class'=>'input']) ?>
			</li>
			<li class="li banknum"><label for="banknum">クレジットカード</label>
			<?=$this->Form->input('accountNumber',['type'=>'text','label'=>false,'class'=>'input']) ?>
			</li>
		</ul>

	<?=$this->Form->button("確認する",array(
'type' => 'submit',
'name' => 'confirm',
'value' => 'confirm'
)) ?>
<?=$this->Form->end()?>
</div>
</div>
<a href="http://cityhunter-movie.com/">←HOMEに戻る</a>     

