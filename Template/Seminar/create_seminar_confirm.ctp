<h1>発案登録確認</h1>             
<div class="addbtndiv">
	<?=$this->Form->button('戻る', ['onclick' => 'history.back()', 'type' => 'button'])?>
</div>

<fieldset>
タイトル：	<?=$this->request->data('title') ?><br>
開催日時:	<?=$this->request->data('eventDate') ?><br>
参加費: 	<?=$this->request->data('entryFee') ?><br>
要求詳細:	<?=$this->request->data('requirementDetail') ?><br>
分類：	    <?=$category[$this->request->data('category')] ?><br>
</fieldset>

<?php 
echo $this->Form->create($entity,['url'=>['action'=>'createSeminar']]);

echo $this->Form->hidden('title', ['value'=>$this->request->data('title')]);
echo $this->Form->hidden('eventDate', ['value'=>$this->request->data('eventDate')]);
echo $this->Form->hidden('entryFee', ['value'=>$this->request->data('entryFee')]);
echo $this->Form->hidden('requirementDetail', ['value'=>$this->request->data('requirementDetail')]);
echo $this->Form->hidden('category', ['value'=>$this->request->data('category')]);

?>
 
<?=$this->Form->button("募集", array(
		'type' => 'submit',
		'name' => 'confirm',
		'value' => 'registry'
)) ?>
<?=$this->Form->end()?>