<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>演習２０(作成者：ベキゴン)</title>
</head>
<body>
    <h2>図書データ一覧</h2>
    <h3>データベースの全てのデータを表示するPHPプログラム。データベースのデータを一行づつ取り出し、デーブルにして表示する</h3>
    
    <?php
    //$con = pg_connect("host=localhost user=zeng dbname=bookdb_1981117"); //you must change this part instead of own yours
    $con = pg_connect('host=localhost port=5432 dbname=bookdb_1981117 user=postgres password=angels');
    if(!$con){
        print "<hr>\n";
        print "bookdbデータベースへの接続に失敗しました。<br/>\n";
        echo pg_last_error($con);
        print "<hr>\n";
        exit(1);
    }

    $isbnToImgUrl = array();
    $img_sql = "select isbn, img_url from book_image";
    $img_result = pg_query($con, $img_sql);
    if(!$img_result){
        print "<hr>\n";
        print "book_imageへの問い合わせ文「".$img_sql."」の実行(データの検索)が失敗しました。<br>\n";
        print pg_last_error($con);
        print "<hr>\n";
        exit(1);
    }
    $img_rows = pg_num_rows($img_result);

    for($i = 0; $i < $img_rows; $i++){
        $img_row = pg_fetch_array($img_result, $i);
        $isbnToImgUrl[$img_row['isbn']] = $img_row['img_url'];
     }

     $sql = "select * from zenglab2008";
     $result = pg_query($con, $sql);
     if(!$result){
         print "<hr>\n";
         print "bookdbへ問い合わせ文「".$sql."」の実行（データの選択）が失敗しました。<br>\n";
         print pg_last_error($con);
         print "<hr>\n";
         exit(1);
     }

     $rows= pg_num_rows($result);
    ?>
<table border="1" style="vertical-align : top; background-color:white;font-size:16px;width:100%;">
<tr align="left"><td colspan="2"> <?php print $rows;?> 件</td></tr>
<tr style="text-align:center; background-color:#cccccc;"><td style="width:150px;">図書画像</td><td>図書データ</td></tr>

<?php
 for($i = 0; $i < $rows; $i++){
     $row = pg_fetch_array($result, $i);
     $book_img = isset($isbnToImgUrl[$row['b_isbn']]) ? $isbnToImgUrl[$row['b_isbn']] : "noimg.jpg";
     print '<tr valign="middle">' . "\n";
     print '<td style="text-align:center;"><img style="height:150px;" src="'.$book_img.'"></td>'."\n";
     print "<td><ul>";
     print "<li>ISBN: ".$row['b_isbn']."</li>\n";
     print "<li>図書名：".$row['b_name']."</li>\n";
     print "<li>著者：".$row['b_author']."</li>\n";
     print "<li>出版社：".$row['b_pub']."</li>\n";
     print "<li>価格：＆yen;".number_format($row['b_price'])."</li>\n";
     print "<li>出版日付：".$row['b_pubdate'].str_repeat("&nbsp;", 40-strlen($row['b_pubdate']))."購入日付：".$row['b_buydate']."</li>\n";
     print "</ul></td>\n";
     print "</tr>\n";
}
print "</table>\n";
pg_close($con);
?>
</body>
</html>