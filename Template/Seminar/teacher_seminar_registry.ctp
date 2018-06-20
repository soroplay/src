<h1>講師セミナー確認</h1>             
<div class="addbtndiv">
	<?=$this->Form->button('戻る', ['onclick' => 'history.back()', 'type' => 'button'])?>
</div>

<?php foreach($seminarList as $obj): ?>
<fieldset>
<ul>
<li>セミナー名：		<?=$obj['title'] ?></li>
<li>開催日:		<?=$obj['eventDate']->i18nFormat('yyyy年MM月dd日') ?></li>
<li>応募人数: 	    <?=$obj['count'] ?></li>
<li>金額:			<?=$obj['reward'] ?></li>
</ul>
</fieldset>

<?=$this->Form->create(null, ['url'=>['action'=>'flagup']]) ?>
<?=$this->Form->hidden('seminarId', ['value'=>$obj['id']]) ?>

<input type="button" value="開催する" id="held-btn">

<div id="modal-wrapper"></div>
<div id="modal-list">
<p id="kettei">開催しますか？</p>
<p id="close" class="colsebtn">✖︎</p>
<?=$this->Form->button("はい", array(
		'type' => 'submit',
		'name' => 'confirm',
		'value' => 'confirm',
		'id'=>'held-sub'
)) ?>
<input type="button" value="いいえ" class="cansel-btn">
</div>
<?=$this->Form->end()?>

<input type="button" value="取消" id="delete-btn">
<div id="delete-modal">
<p id="kettei">取消しますか？</p>
<p id="close" class="colsebtn">✖︎</p>
<div id="torikesi"><?=$this->Form->postButton('取消',['action' => 'teacherSeminarCancel',$obj['id']]) ?></div>
<input type="button" value="いいえ" id="cansel-btn1" class="cansel-btn">
</div>

<?php endforeach; ?>
