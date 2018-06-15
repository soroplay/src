<div id="logout"><?=$this->Html->link('ログアウト',array('style'=>'text-decoration:none'),['action'=>'logout']);?></div>
<div id="mypage"><?=$this->Html->link('マイページ',['action'=>'studentMyPage']);?></div>


	<input type="button" value="発案" id="sug-link" onClick="location.href='create_seminar'">
	

	<div id ="search">
		<?=$this->Form->create($entity,['url'=>['action'=>'student_top']]) ?>
		<?=$this->Form->text("search", ['size'=>'15', 'placeholder'=>'講師IDで検索','id'=>'search-wid'], ['default'=>'*']) ?>
		<?=$this->Form->select("category", $category, ['empty'=>'すべてのカテゴリー'], ['default'=>'*']) ?>
		<?=$this->Form->button("検索",['id'=>'search-btn']) ?>
		<?=$this->Form->end() ?>
    </div>
</div>

<table>	
	<tr id="koumoku">
		<th id="seminar-title">セミナー名</th><th>講師名</th><th>残り日数</th><th>上限人数</th>
	</tr>
<?php  foreach($data  as  $obj):  ?>
	<?php if(($obj->capacity > $cnt[$obj->seminarId])&&(strtotime($obj->dueDate) > strtotime(date('Y/m/d')))): ?>
	<tr id="list-tr">
		<td id="title"><?=$obj->seminarTitle ?></td>
		<td id="detail">詳細を見る</td>
		<td id="teach-name"><?=$this->Html->link($teacher[$obj->teacherId], ['action'=>'check_teacher_profile']); ?></td>
		<td id="day"><?=(strtotime($obj->dueDate) - strtotime(date('Y/m/d'))) / (60 * 60 * 24) ?></td>
		<td id="capa"><?=$obj->capacity - $cnt[$obj->seminarId] ?></td>

		<div id="modal-wrapper">
        </div>
        <div id="modal">
            <div id="modal-content">
            <ul id="list-left">
                <li>開催日</li>
                <li>概要</li>
                <li>備考</li>
                <li>参加費</li>
				<li>開催場所</li>
            </ul>
            <ul id="list-right">
                <li><?=$eventDate[$obj->ideaId]?></li>
                <li><?=$obj->outline ?></li>
                <li><?=$obj->remarks ?></li>
                <li><?=$entryFee[$obj->ideaId]?></li>
				<li><?=$obj->venue ?></li>
            </ul>
            </div>
        </div>


		
		<?php if(in_array($obj->seminarId, $joinedId)): ?>
					<?=$this->Form->create($entity,['url'=>['action'=>'seminar_student_cancel']]) ?>
					<?=$this->Form->hidden('seminarId', ['value'=>$obj->seminarId]) ?>
					<?=$this->Form->hidden('seminarTitle', ['value'=>$obj->seminarTitle]) ?>
					<?=$this->Form->hidden('teacherName', ['value'=>$teacher[$obj->teacherId]]) ?>
					<?=$this->Form->hidden('outline', ['value'=>$obj->outline]) ?>
					<?=$this->Form->hidden('venue', ['value'=>$obj->venue]) ?>
					<?=$this->Form->hidden('entryFee', ['value'=>$entryFee[$obj->ideaId]]) ?>
					<?=$this->Form->hidden('remarks', ['value'=>$obj->remarks]) ?>
					<td><?=$this->Form->submit("取消", ['name'=>'confirm', 'value'=>'cancel','class'=>'sub-btn']) ?></td>
					<?=$this->Form->end() ?>
		<?php else: ?>
					<?=$this->Form->create($entity,['url'=>['action'=>'seminar_student_registry']]) ?>
					<?=$this->Form->hidden('seminarId', ['value'=>$obj->seminarId]) ?>
					<?=$this->Form->hidden('seminarTitle', ['value'=>$obj->seminarTitle]) ?>
					<?=$this->Form->hidden('teacherName', ['value'=>$teacher[$obj->teacherId]]) ?>
					<?=$this->Form->hidden('outline', ['value'=>$obj->outline]) ?>
					<?=$this->Form->hidden('venue', ['value'=>$obj->venue]) ?>
					<?=$this->Form->hidden('entryFee', ['value'=>$entryFee[$obj->ideaId]]) ?>
					<?=$this->Form->hidden('remarks', ['value'=>$obj->remarks]) ?>
					<td><?=$this->Form->submit("参加", ['name'=>'confirm', 'value'=>'confirm','class'=>'sub-btn']) ?></td>
					<?=$this->Form->end() ?>
		<?php endif;?>		
	</tr>
	<?php endif; ?>
<?php  endforeach;  ?>
</table>



<div class="paginator">
	<ul class="pagination">
		<div id="first"><?= $this->Paginator->first('<<') ?></div>
		<div id="first-s"><?= $this->Paginator->prev('<') ?></div>
		<?= $this->Paginator->numbers() ?>
		<div id="last"><?= $this->Paginator->next('>') ?></div>
		<div id="last-s"><?= $this->Paginator->last('>>') ?></div>
	</ul>
</div>
