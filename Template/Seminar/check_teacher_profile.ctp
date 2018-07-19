<div id ="header-logo">
<div id ="logo">
　　<?php $this->Html->image('img/mypagelogo.png', array('alt' => 'CakePHP'));?>
    <div id="logout"><?=$this->Html->link('ログアウト',array('style'=>'text-decoration:none'),['action'=>'logout']);?></div>
    <div id="mypage"><?=$this->Html->link('マイページ',['action'=>'studentMyPage']);?></div>
</div>
</div>

<div id="main-contens">
    <div class="teachre-prof"><?php $img = base64_encode(stream_get_contents($photograph)); ?>
<img src="data:image/png;base64,<?=$img ?>" width="130px"><br></div>
    <div id="teach-name"><p><?=$teacherName ?></p></div>
    <div id="teach-evalu"><p>評価</p><p id="evalu-star"><?php
	for($i=0; $i<$rate; $i++){
		echo "★";
	}
	for($i=0; $i<5-$rate; $i++){
		echo "☆";
	}
?></p></div>
    <p id="carrear">実績</p>
        <div id="genre-sel">
    <select name="genre">
            <option value="">ジャンル選択
            <option value="サンプル1">サンプル1</option>
            <option value="サンプル2">サンプル2</option>
            <option value="サンプル3">サンプル3</option>
    </select>
        </div>
        