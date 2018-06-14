<h1>講師概要入力確認</h1>
<div class="addbtndiv">
<?=$this->Form->button('戻る', ['onclick' => 'history.back()', 'type' => 'button'])?>
</div>

<fieldset> 
セミナー名：	<?=$this->request->data('seminarTitle') ?><br>
概要：			<?=$this->request->data('outline') ?><br>
上限人数：		<?=$this->request->data('capacity') ?><br>
会場：			<?=$this->request->data('venue') ?><br>
備考：			<?=$this->request->data('remarks') ?><br>
募集期限：		<?php echo $this->Form->create('$entity', ['url' => 'index']);
					echo $this->Form->hidden('dueDate.year');
					echo $this->Form->hidden('dueDate.month');
					echo $this->Form->hidden('dueDate.day');
					$dueDate = $this->request->data['dueDate'];
					echo $dueDate['year'] . "年" . $dueDate['month'] . "月" . $dueDate['day'] . "日";
					echo $this->Form->end();
				?>
</fieldset>

<?php
echo $this->Form->create($entity,['url'=>['action'=>'createProposal']]); 

echo $this->Form->hidden('seminarTitle', ['value'=>$this->request->data('seminarTitle')]);
echo $this->Form->hidden('outline', ['value'=>$this->request->data('outline')]);
echo $this->Form->hidden('capacity', ['value'=>$this->request->data('capacity')]);
echo $this->Form->hidden('venue', ['value'=>$this->request->data('venue')]);
echo $this->Form->hidden('remarks', ['value'=>$this->request->data('remarks')]);
echo $this->Form->hidden('dueDate', ['value'=>$this->request->data('dueDate')]);
?>

<?=$this->Form->button("送信", array(
	'type' => 'submit',
	'name' => 'proposal_confirm',
	'value' => 'proposal'
)) ?>
<?=$this->Form->end()?>