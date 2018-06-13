<?php 
    function day($day){
        $today = strtotime(date("Y-m-d"));
        $afterday = strtotime($day);
        $daysLeft = ($afterday - $today) / (60 * 60 * 24);
        return $daysLeft;
    }
?>

<body>


<ul class = "nav nav-tabs">
    <li class = "nav-item">
        <a href = "#idea1" class = "nav-link" data-toggle = "tab">受講者</a>
    </li>
    <li class = "nav nav-tabs">
        <a href = "#idea2" class = "nav-link" data-toggle = "tab">講師</a>
    </li>
</ul>
<div class = "tab-content">
    <div id = "idea1" class = "tab-pane active">
        
    </div>
    <div id = "idea2" class = "tab-pane">
        <table>
        <?php foreach($data as $obj): ?>
            <?php $days = day($obj->eventDate); ?>
                <tr>
                    <td><?= $obj->title ?></td>
                    <td>残り:<?=$days ?></td>
                    <td><?= $obj->requirementDetail ?></td>
                    <td><?=$this->Html->link('募集', ['action'=>'login']);?></td>
                </tr>
        <?php endforeach; ?>
        </table>

    </div>
</div>

</body>
