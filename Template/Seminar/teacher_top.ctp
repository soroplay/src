<div id="logout"><?=$this->Html->link('ログアウト',['action'=>'logout']);?></div>
<div id="mypage"><?=$this->Html->link('マイページ',['action'=>'teacherMyPage']);?></div>
<div id ="search">
<?=$this->Form->create($entity,['url'=>['action'=>'teacherTop']]) ?> 
<?=$this->Form->select("category", $category, ['empty'=>'すべてのカテゴリー'], ['default'=>'*']) ?> 
<?=$this->Form->button("検索",['id'=>'search-btn']) ?> 
<?=$this->Form->end() ?> 
</div>	
   
<table>
	<tr id="koumoku">
		<th id="seminar-title">セミナー名</th><th>開催日</th><th>参加費</th><th>上限人数</th>
	</tr>	
<?php  foreach($data as $obj):  ?>
	<tr>
		<td><?=$obj->title ?></td>

		<?php if(in_array($obj->ideaId, $joinedId)): ?>
					<?=$this->Form->create($entity,['url'=>['action'=>'seminar_student_cancel']]) ?>
					<td><?=$this->Form->submit("取消", ['name'=>'confirm', 'value'=>'cancel']) ?></td>
					<?=$this->Form->end() ?>
		<?php else: ?>
					<?=$this->Form->create($entity,['url'=>['action'=>'seminar_student_registry']]) ?>
					<td><?=$this->Form->submit("参加", ['name'=>'confirm', 'value'=>'confirm']) ?></td>
					<?=$this->Form->end() ?>
		<?php endif;?>
		
	</tr>
<?php  endforeach;  ?>


<?php  foreach($allData as $obj):  ?>
<tr id="list-tr">
<td id="title"><?=$obj->title ?></td>
<td id="eventDate"><?=$obj->eventDate->i18nFormat("yyyy年MM月dd日")?></td>
<td id="entryFee"><?=$obj->entryFee?></td>
<td id="category"><?=$category[$obj->categoryId]?> </td>
<td id="requirementDetail"><?=$obj->requirementDetail?></td>

		<?php if(in_array($obj->ideaId, $joinedId)): ?>
					<?=$this->Form->create($entity,['url'=>['action'=>'seminar_student_cancel']]) ?>
					<td><?=$this->Form->submit("取消", ['name'=>'confirm', 'value'=>'cancel']) ?></td>
					<?=$this->Form->end() ?>
		<?php else: ?>
					<?=$this->Form->create($entity,['url'=>['action'=>'seminar_student_registry']]) ?>
					<td><?=$this->Form->submit("参加", ['name'=>'confirm', 'value'=>'confirm']) ?></td>
					<?=$this->Form->end() ?>
		<?php endif;?>
		
		<!--<a href>もっと見る</a>-->
	</tr>
<?php  endforeach;  ?>
</table>
   
   <div class="paginator"> 
	<ul class="pagination"> 
	 <?= $this->Paginator->first('<<') ?> 
	 <?= $this->Paginator->prev('<') ?> 
	 <?= $this->Paginator->numbers() ?> 
	 <?= $this->Paginator->next('>') ?> 
	 <?= $this->Paginator->last('>>') ?> 
	</ul> 
   </div>