<body>
    <img src="../img/whiteKrinuki.svg" id="kirinuki">
    <header>
        <div id="header-logo">
            <a href=""><img src="../img/Untitled8.svg" id="logo-home"></a><p id="logo-home-sent">ホーム</p>
            <a href="login"><img src="../img/Untitled10.svg" id="logo-login"></a><p id="logo-login-sent">ログイン</p>
            <img src="../img/newRegi.svg" id="logo-new" width="30px"><p id="logo-new-sent">新規登録</p>
        </div>
        <div id="link-wrapper"></div>
            <div id="link-modal">
                <ul>
                    <p>×閉じる</p>
                    <a href="student_registry"><li id="stu-link">受講者の新規登録はコチラ</li></a>
                    <a href="teacher_Registry"><li id="teach-link">講師の新規登録はコチラ</li></a>
                </ul>
            </div>
    </header>
    
    <div id="main-content">
        <img src="../img/toplogo.svg" id="logo">
        
        <p id="teach-sent">講師のセミナー</p>
        <p id="student-sent">生徒のセミナー</p>
        <img src="../img/hovlogo.svg" id="hovlogo1">
        <img src="../img/hovlogo.svg" id="hovlogo2">
    </div>


    <footer>
        <?php foreach($guestTeacher as $teacher): ?>
            <p><?=$teacher->title?></p>
        <?php endforeach; ?>

        <?php foreach ($guestStudent as $student): ?>
            <p><?=$student->seminarTitle ?></p>
        <?php endforeach; ?>
    </footer>
</body>