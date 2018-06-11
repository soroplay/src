<div id="inputdiv">
	<!--<? /*=$this->Html->image('biglogo.png', array('alt'=>'logo'))*/?>-->
	<?=$this->Form->create($entity,['url'=>['action'=>'createSeminar']]) ?>
	<table class="inputtable" style="width: 100%" cellspacing="10">
	<div class="addbtndiv">
		<?=$this->Form->button('戻る', ['onclick' => 'history.back()', 'type' => 'button'])?>
	</div>

		<tr>
			<td colspan="2">発案登録</td>
		</tr>
		<tr>
			<td style="width: 68px">タイトル</td>
			<td>	
				<?=$this->Form->text("title",['id'=>'textform']) ?>
				
			</td>
		</tr>
		<tr>
			<td style="width: 68px">開催日時</td>
			<td><?=$this->Form->date("eventDate",[
				'id'=>'textform',
				'minYear'=>date('Y'),
				'dateFormat'=>'YMD',
				'monthNames'=>false,
				'empty'=>['year'=>'年', 'month'=>'月', 'day'=>'日']
				]) ?></td>
		</tr>
		<tr>
			<td style="width: 68px">参加費</td>
			<td><?=$this->Form->text("entryFee",['id'=>'textform']) ?></td>
		</tr>
		<tr>
		<tr>
			<td style="width: 68px">要求詳細</td>
			<td><?=$this->Form->textarea("requirementDetail",['id'=>'textform']) ?></td>
		</tr>
		<tr>
			<td style="width: 68px">分類</td>
			<td><?=$this->Form->select("category", $category, ['empty'=>'選択してください']) ?></td>
		</tr>
		<tr>

		<tr>

			<td colspan="2">
					<?=$this->Form->button("確認する", [
								'type' => 'submit',
								'name' => 'confirm',
								'value' => 'confirm'
					]) ?>
					
			</td>
		</tr>
	</table>
	<?=$this->Form->end() ?>
	</div>
