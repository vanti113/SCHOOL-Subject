<?php


print <<<_html_
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Enshu21_pj2_21_01</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<header class="header center">
<div class="center">
<span class="header__title">図書データ一覧</span>
</div>
</header>
<main class="main">
<div class="count"><span>総件数：<?= $count;?>件</span></div>
<br />
<section class="grid">
_html_;

foreach ($arr as $num => $temp){
	$setNum = $num+1;
	print <<<_html_
	<div class="content">
	<div class="book-image">
	<span class="book-number">{$setNum}</span>
	<img src="{$temp['img_url']}"/>
	</div>
	<div class="book-contents">
	<span>図書名：<span class="book-contents__title">{$temp['b_name']}
	</span></span>
	<span>著者名：{$temp['b_author']}</span>
	<span>出版社：{$temp['b_pub']}</span>
	<span>購入日：{$temp['b_buydate']}</span>
	<span>出版日：{$temp['b_pubdate']}</span>
	<span>価格：{$temp['b_price']}円</span>
	<span>ISBN：{$temp['b_isbn']}</span>
	</div>
	</div>
	_html_;
}

print <<<_html_
</section>
</main>
<script src="noimg.js"></script>
</body>
</html>
_html_;

?>

