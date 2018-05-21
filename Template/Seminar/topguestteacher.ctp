<body>
<div class = "head">
    <?=$this->Html->link('タイトル', ['action'=>'index']);?>
    <?=$this->Html->link('ログイン', ['action'=>'login']);?>
</div>

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
        <p>test1</p>
    </div>
    <div id = "idea2" class = "tab-pane">
        <p>test2</p>
    </div>
</div>

</body>
