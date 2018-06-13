
<?=$this->Form->create($entity,['url'=>['action'=>'teachertop']]) ?>  
<?=$this->Form->select("category", ['options'=>$category], ['empty'=>'カテゴリー'], ['default'=>'*']) ?>  
<?=$this->Form->button("検索") ?>  
<?=$this->Form->end() ?>  
  
    
  <table>  
    
      <?php  foreach($Date  as  $obj):  ?>  
        <tr>  
          <td><?=$obj->title ?></td>  
          <td><?=$obj->evenDate ?></td>  
          <td><?=$this->Form->button("参加", ['action' => 'join']) ?></td>  
  <!--<a href>もっと見る</a>-->  
        </tr>  
      <?php  endforeach;  ?>  
  </tale>  
    
  <div class="paginator">  
      <ul class="pagination">  
          <?= $this->Paginator->first('<<') ?>  
          <?= $this->Paginator->prev('<') ?>  
          <?= $this->Paginator->numbers() ?>  
          <?= $this->Paginator->next('>') ?>  
          <?= $this->Paginator->last('>>') ?>  
      </ul>  
  </div>