<?php

function paintToHtml($arr)
{
	if (!$arr) {
		$count = 0;
	} else {
		$count = count($arr);
	}
	$title = ["Main page", "全図書データ"];
	require_once 'paintToHtml.php';
}

function fetchToDb($conn)
{
	$query = "SELECT img_url, b_isbn, b_name, b_author, b_pub, b_price, b_pubdate, b_buydate FROM zenglab2008 LEFT JOIN book_image ON b_isbn = isbn";
	$result = pg_query($conn, $query);
	if (!$result) {
		print "--------------------";
		print "データの取得に失敗しました。Query文にエラーがあります。";
		print "--------------------";
		exit(1);
	} else {
		$arr = pg_fetch_all($result);
	}
	pg_close($conn);
	return $arr;
}


function connectToDb()
{
	require 'db.php';
	$temp = new Db;
	$conn = $temp->connectDb();
	if (!$conn) {
		print "<hr>\n";
		print "bookdbデータベースの接続に失敗しました。";
		print preg_last_error($conn);
		print "<hr>\n";
		exit(1);
	}
	return $conn;
}

function init()
{
	$conn = connectToDb();
	$arr = fetchToDb($conn);
	paintToHtml($arr);
}

init();
