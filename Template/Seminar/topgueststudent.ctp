<h1 class="siteTitle">サイト名</h1>
<p><?=$this->Html->link('ログイン',['action'=>'login']);?></p>
<div id="main">
<?php 
    function day($day){
        $today = strtotime(date("Y-m-d"));
        $afterday = strtotime($day);
        $daysLeft = ($afterday - $today) / (60 * 60 * 24);
        return $daysLeft;
    }
?>
<table>
<tbody>
<?php foreach($data as $obj): ?>
<?php $days = day($obj->dueDate); ?>
<tr>
<td><?=$obj->seminarTitle ?></td>
<td><?=$obj->capacity ?></td>
<td>残り:<?=$days ?></td>
<td><?=$this->Html->link('参加', ['action' => 'seminar_student_registry']);?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>