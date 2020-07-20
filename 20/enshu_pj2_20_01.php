<?php

//$connect_query = 'host=localhost user=zeng dbname=bookdb_1981117'; //you must put in this part instead of your own codes
$connect_query = 'host=localhost port=5432 dbname=bookdb_1981117 user=postgres password=angels';
$conn = pg_connect($connect_query);
$query = "SELECT img_url, b_isbn, b_name, b_author, b_pub, b_price, b_pubdate, b_buydate FROM zenglab2008 LEFT JOIN book_image ON b_isbn = isbn WHERE b_price >= 3000";

if(!$conn){
        print "<hr>\n";
        print "bookdbデータベースへの接続に失敗しました。<br/>\n";
        echo pg_last_error($conn);
        print "<hr>\n";
        exit(1);
}

$result = pg_query($conn, $query);
$arr = pg_fetch_all($result);
$count = count($arr);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Enshu20_pj2_01</title>
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

<?php

function paintToHtml($arr){
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
}
//this function is ensurance for fucking situations
/*function paintToHtml($arr){
	foreach ($arr as $num => $temp){
		$setNum = $num+1;
		print "<div class='content'>";
		print "<div class='book-image'>";
		print "<span class='book-number'>{$setNum}</span>";
		print "<img src='".$temp['img_url']."'/></div>";
		print "<div class='book-contents'>"; 	
		print "<span>図書名：<span class='book-contents__title'>".$temp['b_name']."</span></span>";
		print "<span>著者名：{$temp['b_author']}</span>"; 	
		print "<span>出版社：{$temp['b_pub']}</span>"; 	
		print "<span>購入日：{$temp['b_buydate']}</span>"; 	
		print "<span>出版日：{$temp['b_pubdate']}</span>"; 	
		print "<span>価格：{$temp['b_price']}円</span>"; 	
		print "<span>ISBN：{$temp['b_isbn']}</span></div></div>";
	}
}*/

paintToHtml($arr);
pg_close($conn);
?>
	 </section>
    </main>
	<script src="noimg.js"></script>
  </body>
</html>
