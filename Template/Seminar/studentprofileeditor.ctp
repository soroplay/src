<?=$this->Form->create($entity,['url'=>['action'=>'studentprofileeditor'],'type'=>'file']) ?>
    <p>アバター:<?=$this->Form->file("photograph") ?></p>
    <p>ニックネーム:<?=$this->Form->text('studentName') ?></p>
    <p>メールアドレス:<?=$this->Form->txte('mail') ?></p>
    <p>電話番号:<?=$this->Form->text('phone') ?></p>
    <p>パスワード:<?=$this->Form->password('pass')?></p>
    <p>パスワード確認:<?=$this->Form->password('passVerification')?></p>
    <p>クレジット番号:<?=$this->Form->text('creditInfo')?></p>
    <?=$this->Form->hidden('editor',['value'=>'OK'])?>
    <?=$this->Form->button("完了") ?>
<?=$this->Form->end() ?>