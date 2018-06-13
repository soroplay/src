
   <div class="login-space">
   
   <?= $this->Form->create($entity,['url'=>['action'=>'login']])?>
   
   <?=$this->Form->create() ?>
   
   
   <div id="login-content">
           <p id="sign-up-sent">サインアップ</p>
           <div id="sign-up-modal">
           <form>
               <?=$this->Form->input('id',['type'=>'text','label'=>false ,'placeholder'=>"ID" ,'id'=>"user-wid"]) ?>
               <?=$this->Form->input('password',['type'=>'text','label'=>false ,'placeholder'=>"Password" ,'id'=>"user-wid"]) ?>
              <?=$this->Form->button("ログイン" ,['id'=>"login"])?>
           </form>
           </div>
       </div>
   </div>
   
   <?=$this->Form->end() ?>
   
   