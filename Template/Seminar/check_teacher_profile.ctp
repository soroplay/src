<h1>講師プロフィール</h1>             
<div class="addbtndiv">
	<?=$this->Form->button('戻る', ['onclick' => 'history.back()', 'type' => 'button'])?>
</div>

<fieldset>
<?php $img = base64_encode(stream_get_contents($photograph)); ?>
<img src="data:image/png;base64,<?=$img ?>" width="200px"><br>
名前:	<?=$teacherName ?><br>
評価：	
<?php
	for($i=0; $i<$rate; $i++){
		echo "★";
	}
	for($i=0; $i<5-$rate; $i++){
		echo "☆";
	}
?>
</fieldset>

<h2>実績</h2>
<?php foreach($achievement as $obj): ?>
<tr>
	<td><?=$obj->seminarTitle ?></td>
</tr>
<?php endforeach; ?>
 