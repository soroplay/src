<h1>講師概要入力</h1>
<div class="createproposal div">
 <?=$this->Form->button('戻る', ['onclick' => 'history.back()', 'type' => 'button'])?>
</div>

<?=$this->Form->create($entity,['url'=>['action'=>'createProposal']]) ?>
<fieldset>
セミナー名：    <?=$this->Form->text("seminarTitle",['id'=>'textform']) ?>
概要:           <?=$this->Form->textarea("outline",['id'=>'textform']) ?>
上限人数:       <?=$this->Form->text("capacity",['id'=>'textform']) ?>
会場:           <?=$this->Form->text("venue",['id'=>'textform']) ?>
備考：          <?=$this->Form->textarea("remarks",['id'=>'textform']) ?>
募集期限：      <?=$this->Form->date("dueDate",['id'=>'textform',
				'minYear'=>date('Y'),
				'dateFormat'=>'YMD',
				'monthNames'=>false,
				'empty'=>['year'=>'年','month'=>'月','day'=>'日']]) ?>

</fieldset>
<?=$this->Form->button("登録", array(
  'type' => 'submit',
  'name' => 'proposal_confirm',
  'value' => 'proposal_confirm'
)) ?>
<?=$this->Form->end()?>