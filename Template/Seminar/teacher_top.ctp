<p><?=$this->Html->link('ログアウト',['action'=>'logout']);?></p>
<p><?=$this->Html->link('マイページ',['action'=>'teacherMyPage']);?></p>
<?=$this->Form->create($entity,['url'=>['action'=>'teacherTop']]) ?> 
<?=$this->Form->select("category", ['options'=>$category], ['empty'=>'カテゴリー'], ['default'=>'*']) ?> 
<?=$this->Form->button("検索") ?> 
<?=$this->Form->end() ?> 
	
   
<table>
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