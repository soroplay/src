<?php foreach($prsteacher as $prs): ?>
    <?=$this->Form->create(null,['type' => 'post','url' => ['action' => 'flagup'],'onsubmit'=>'return confirm("この講師で決定しますか？");'])?>
        <?php if($prs->teacher->photograph == null): ?>
            <p>画像なし</p>
        <?php else : ?>
            <?php $img = base64_encode(stream_get_contents($prs->teacher->photograph)); ?>
            <img src="data:image/png;base64,<?=$img ?>">
        <?php endif; ?>
        <p>セミナー名:<?=$prs->seminarTitle ?></p>
        <!--hidden追加-->
        <?=$this->Form->hidden('seminarId',['value'=>$prs->seminarId]) ?>
        <?=$this->Form->hidden('ideaId',['value'=>$prs->ideaId]) ?>
        <?=$this->Form->hidden('matchinginput',['value'=>'true']) ?>
        <?=$this->Form->hidden('studentId',['value'=>$studentId]) ?>
        <?=$this->Form->button('決定') ?>
    <?=$this->Form->end() ?>

<?php endforeach; ?>
<?=$this->Form->create(null,['type' => 'post','url' => ['action' => 'studentmypage']])?>
    <?=$this->Form->button('戻る') ?>
<?=$this->Form->end() ?>