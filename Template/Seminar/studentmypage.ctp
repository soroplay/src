<!--プロフィール表示-->
<?=$this->Form->create(null,['type'=>'post','url'=>['action'=>'studentprofileeditor']])?>
            <?php if($profile->photograph == null): ?>
                <p>画像なし</p>
            <?php else : ?>
                <?php $img = base64_encode(stream_get_contents($profile->photograph)); ?>
                <img src="data:image/png;base64,<?=$img ?>" width="200px">
            <?php endif; ?>
            <?= $profile->studentId ?>
            <?= $profile->studentName ?>
            <?= $profile->mailAdress ?>
            <?= $profile->phoneNumber ?>
            <?= $profile->creditInfo ?>
            <?=$this->Form->button("編集") ?>
<?=$this->Form->end() ?>


<ul class = "nav nav-tabs">
    <li class = "nav-item">
        <a href = "#idea" class = "nav-link" data-toggle = "tab">発案</a>
    </li>
    <li class = "nav nav-tabs">
        <a href = "#seminar" class = "nav-link" data-toggle = "tab">セミナー</a>
    </li>
    <li class = "nav nav-tabs">
        <a href = "#est" class = "nav-link" data-toggle = "tab">評価</a>
    </li>
</ul>

<div class = "tab-content">
    <div id = "idea" class = "tab-pane active">
        <!-- セレクトボックス表示 -->
        <?=$this->Form->create(null,['type' =>'post','url'=>['action' =>'studentmypage']])?>
            <?=$this->Form->select('ideassearch',[$category],['empty'=>'全て表示']) ?>
            <?=$this->Form->button("検索") ?>
        <?=$this->Form->end() ?>
        <!-- 発案タイトル表示 -->
        <?php foreach($ideas as $ideas): ?>
            <?=$this->Html->link($ideas->title,['action'=>'proposalteacherlist','id'=>$ideas->ideaId,'student'=>$ideas->studentId]) ?></br>
            <?=$this->Form->create(null,['type' =>'post','url'=>['action' =>'ideadelete']])?>
                <?=$this->Form->hidden('ideaId',['value'=>$ideas->ideaId]) ?>
                <?=$this->Form->button("取消") ?>
            <?=$this->Form->end() ?>
        <?php endforeach; ?>
    </div>


    <div id = "seminar" class = "tab-pane">
        <!-- セレクトボックス表示 -->
        <?=$this->Form->create(null,['type' => 'post','url' => ['action' => 'studentmypage']])?>
            <?=$this->Form->select('seminarsearch',[$category],['empty'=>'全て表示']) ?>
            <?=$this->Form->button("検索") ?>
        <?=$this->Form->end() ?>
        <!-- セミナータイトル表示 -->
        <?php foreach($seminars as $seminars): ?>
            <p><?=$seminars->seminar->seminarTitle ?></p>
            <?=$this->Form->create(null,['type' =>'post','url'=>['action' =>'Matchingdelete']])?>
                <?=$this->Form->hidden('seminarId',['value'=>$seminars->seminarId]) ?>
                <?=$this->Form->hidden('studentId',['value'=>$seminars->studentId]) ?>
                <?=$this->Form->button("取消") ?>
            <?=$this->Form->end() ?>

        <?php endforeach; ?>

    </div>


    <div id = "est" class = "tab-pane">
        <!-- セレクトボックス表示 -->
        <?=$this->Form->create(null,['type' => 'post','url' => ['action' => 'studentmypage']])?>
            <!--未評価:0,評価済み:1-->
            <?=$this->Form->select('estimation',['未評価','評価済']) ?>
            <?=$this->Form->button("検索") ?>
        <?=$this->Form->end() ?>
            <?php foreach($ests as $est): ?>
                <p><?=$est->seminar->teacher->teacherName ?></p>
                <p><?=$est->seminar->seminarTitle ?></p>
                <?php foreach(range(1,5) as $rate): ?>
                    <?=$this->Form->create(null,['type' => 'post','url' => ['action' => 'estupdata']])?>
                        <?=$this->Form->hidden('teacherId',['value'=>$est->seminar->teacher->teacherId]) ?>
                        <?=$this->Form->hidden('seminarId',['value'=>$est->seminar->seminarId]) ?>
                        <?=$this->Form->hidden('studentId',['value'=>$est->studentId]) ?>

                        <?=$this->Form->hidden('rate',['value'=>$rate]) ?>
                        <?=$this->Form->button('評価'.$rate) ?>
                    <?=$this->Form->end() ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
    </div>
</div>