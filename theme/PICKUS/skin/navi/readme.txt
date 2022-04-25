기존 그누보드 메뉴를 펼침 메뉴로 바꾸기

1. head.php
1.1 127 ~ 146번 소스 삭제하기
1.2 158번 라인에 navigation.php 소스 넣기
1.3 head.sub.php
80번 라인에 
<script src="<?php echo G5_URL ?>/navi/navigation.js"></script>
<link href="<?php echo G5_URL ?>/navi/navigation.css" rel="stylesheet">
위 소스 넣기