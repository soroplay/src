

<h1>発案登録</h1>
	<?=$this->Form->create($entity,['url'=>['action'=>'createSeminar']]) ?>
	<div class="main-contents">
		<div class="form-space">
			
		
			<ul>	
				<li class="li id"><label for="id">タイトル</label>
				
					<?=$this->Form->input('title',['type'=>'text','label'=>false,'class'=>'input']) ?>
						
				</li>	
			
				<li class="li id"><label for="id">開催日時</label>
				<div class="date">
				<?=$this->Form->date("eventDate",[
					'id'=>'textform',
					'minYear'=>date('Y'),
					'dateFormat'=>'YMD',
					'monthNames'=>false,
					'empty'=>['year'=>'年', 'month'=>'月', 'day'=>'日']
					]) ?>
				</div>	
				</li>
				<li class="li id"><label for="id">参加費</label>
				<?=$this->Form->input("entryFee",['type'=>'text','label'=>false,'class'=>'input']) ?>
				</li>
				<li class="li id"><label for="id">要求詳細</label>
				<?=$this->Form->input("requirementDetail",['type'=>'textarea','label'=>false,'class'=>'input']) ?></td>
				</li>
				<div id = "category">分類</div>
				<div id ="category1">
				<?=$this->Form->select("category", $category, ['empty'=>'選択してください']) ?></td>
				</div>
			</ul>
			
			<?=$this->Form->button("確認する", [
								'type' => 'submit',
								'name' => 'confirm',
								'value' => 'registry',
								'id' => 'btn'
			]) ?>
					
		
	    </div>
	</div>

	<a href="http://cityhunter-movie.com/">←HOMEに戻る</a>   
	<?=$this->Form->end() ?>