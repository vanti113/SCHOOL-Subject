<?php
print <<<_html_

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Library Project : {$title[0]}</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.1/css/
all.css"integrity="sha384-xxzQGERXS00kBmZW/6qxqJPyxW3UR0BPsL4c8ILaIWXva5kFi7TxkIIaMiKtqV1Q"
crossorigin="anonymous"/>
<link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@400;800&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="src/style.css" />
</head>
<body>
<header class="header">
<div class="header__title center">
<i class="fas fa-bars BAR"></i><span class="header__title_title">Web図書管理システム</span>
</div>
<form action="http://localhost:81/school/24/search.php" method="POST" class="header__form center">
<input class="header__search" name="keyword" type="text" pattern="^[^<>]+$" placeholder="OR検索は半角SPACE, 除外検索は単語の前に半角ーを" required />
<input class="header__search__button" type="submit" value="Search" />
</form>
<a href="http://localhost:81/school/24/main.php"><i class="fas fa-home"></i></a>
</header>
<main>
<section class="sideBar">
<div class="sidebar__top">
<div class="sidebar__top__icon center">
<i class="fas fa-book-reader"></i></div><span>管理 Page</span></div>
<div class="sideBar__link">
<a href="http://localhost:81/school/24/main.php"><i class="fas fa-book"></i><span>All Books</span></a>
<a href="http://localhost:81/school/24/add.php"><i class="fas fa-file-alt"></i><span>Add Book</span></a>
</div>
</section>
<section class="bookTable">
<div class="bookTable__title">
<span class=""><i class="fas fa-chevron-right"> {$title[1]}</i></span>
<span>総 {$count}件</span>
</div>
<div class="bookTable__search">
<span><i class="fas fa-chevron-right">キーワード：
<span id="word1" class="bookTable__keywords">{$words}</span>|| 
<span class="bookTable__keywords">  </span>除外キーワード：
<span id="word2" class="bookTable__keywords">{$e_words}</span>
</i></span></div>
_html_;


foreach ($arr as $key => $temp) {
	$bookNum = $key + 1;

	print <<<_html_

<div class="bookTable__content">
<div class="table1"><span>{$bookNum}</span>
<img src="{$temp['img_url']}" /></div>
<div class="table2">
<ul><li>書籍名：<span>{$temp['b_name']}</span></li>
<li>著者名：<span>{$temp['b_author']}</span></li>
<li>出版社：<span>{$temp['b_pub']}</span></li></ul>
</div>
<div class="table3">
<ul><li>出版日：<span>{$temp['b_pubdate']}</span></li>
<li>購入日：<span>{$temp['b_buydate']}</span></li>
<li>ISBN：<span>{$temp['b_isbn']}</span></li></ul>
</div>
<div class="table4">
<ul><li>価格：<span>{$temp['b_price']}</span>円</li></ul>
</div>
<div class="table5">
<form action="http://localhost:81/school/24/update.php" id="update{$bookNum}" method="GET">
<input type="hidden" name="update" value={$temp['b_isbn']} />
</form>
<button class="bookTable__button__update center" type="submit" form="update{$bookNum}">
<i class="fas fa-edit"></i>
</button>
<form action="http://localhost:81/school/24/delete.php" method="POST" id="delete{$bookNum}">
<input type="hidden" name="delete" value={$temp['b_isbn']} />
</form>
<button class="bookTable__button__delete center" type="submit" form="delete{$bookNum}">
<i class="fas fa-trash-alt"></i>
</button>
</div>
</div>
_html_;
}

print <<< html
</section>
</main>
<script src="./js/noimg.js"></script>
<script src="./js/sidebar.js"></script>
<script src="./js/searchWord.js"></script>
</body>
</html>
html;
