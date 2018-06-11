
<?= $this->Form->create($entity,['url'=>['action'=>'login']])?>

<?=$this->Form->create() ?>
<tr>
    <td>ID：</td>
    <td><?=$this->Form->input('id',['type'=>'text','label'=>false]) ?> </td>
<tr>        
<td>パスワード：</td>
    <?=$this->Form->input('password',['type'=>'text','label'=>false]) ?>
    

   
<?=$this->Form->button("ログイン") ?>
<a href="http://localhost/cake3app/seminar/studentRegistry">受講者新規登録</a>
<a href="http://localhost/cake3app/seminar/teacherRegistry">講師新規登録</a>
<?=$this->Form->end() ?>

