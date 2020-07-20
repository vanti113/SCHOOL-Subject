<?php
print <<<_html_

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>{$title[0]}</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.1/css/all.css" 
integrity="sha384-xxzQGERXS00kBmZW/6qxqJPyxW3UR0BPsL4c8ILaIWXva5kFi7TxkIIaMiKtqV1Q"
crossorigin="anonymous"/>
<link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@400;800&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="src/style.css" />
</head>
<body>
<header class="header">
<div class="header__title center">
<i class="fas fa-bars BAR"></i>
<span class="header__title_title">Web図書管理システム</span>
</div>
<form action="http://localhost:81/school/24/search.php" method="POST" class="header__form center">
<input class="header__search" type="text" name="keyword" pattern="^[^<>]+$" placeholder="キーワード検索" required />
<input class="header__search__button" type="submit" value="Search" />
</form>
<a href="http://localhost:81/school/24/main.php"><i class="fas fa-home"></i></a>
</header>
<main>
<section class="sideBar">
<div class="sidebar__top">
<div class="sidebar__top__icon center">
<i class="fas fa-book-reader"></i>
</div>
<span>管理 Page</span>
</div>
<div class="sideBar__link">
<a href="http://localhost:81/school/24/main.php"><i class="fas fa-book"></i><span>All Books</span></a>
<a href="http://localhost:81/school/24/add.php"><i class="fas fa-file-alt"></i><span>Add Book</span></a>
</div>
</section>
<section class="bookTable">
<div class="bookTable__title">
<span><i class="fas fa-chevron-right">{$title[1]}</i></span>
</div>
<div class="bookTable__add">
<form action="{$URL}" method="POST">
<div class="bookTable__add__form">
<ul class="bookTable__add__form__ul">
<li><label>ISBN</label><input type="text" name="isbn" id="isbn" maxlength="13" title="数字10桁又は数字9桁とX, 13桁の数字だけで入力可能"
pattern="^([0-9]{9}[0-9xX]|[0-9]{13})$" class="" value="{$arr['b_isbn']}" required /></li>
<li><label>図書名</label><input type="text" name="name" pattern="^[^<>]+$" value="{$arr['b_name']}" required /></li>
<li><label>著者名</label><input type="text" name="author" pattern="^[^<>]+$" value="{$arr['b_author']}" required /></li>
<li><label>出版社</label><input type="text" name="pub"  pattern="^[^<>]+$" value="{$arr['b_pub']}" required /></li>
</ul>
<ul class="bookTable__add__form__ul">
<li><label>価格</label><input type="number" name="price" value="{$arr['b_price']}" title="数字だけを入力してください" required /></li>
<li><label>出版日</label><input type="date" name="pubdate" value="{$arr['b_pubdate']}" required /></li>
<li><label>購入日</label><input type="date" name="buydate" value="{$arr['b_buydate']}" required /></li>
<li><label>画像URL</label><input type="text" name="url" value="{$arr['img_url']}" pattern="^[^<>]+$" /></li>
</ul>
</div>
<div class="bookTable__add__buttons">
<input type="submit" value="登録" />
<input type="reset" value="RESET" />
</div>
</form>
</div>
</section>
</main>
<script src="./js/sidebar.js"></script>
<script src="./js/preventIsbn.js"></script>
</body>
</html>

_html_;
