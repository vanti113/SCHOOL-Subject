<?php

function paintToHtml($arr, $query, $words){
	$count = count($arr);
	require_once 'paintToHtml.php';
}


function fetchToDb($conn, $query){

	$result = pg_query($conn, $query);
	if(!$result){
		print "--------------------";
		print "データの取得に失敗しました。Query文にエラーがあります。";
		print "--------------------";
		exit(1);
	}else{
		$arr = pg_fetch_all($result);
	}
	return $arr;
}


function makeQuery($keyword){
	
	$query = "SELECT img_url, b_isbn, b_name, b_author, b_pub, b_price, b_pubdate, b_buydate FROM zenglab2008 LEFT JOIN book_image ON b_isbn = isbn WHERE ";
	$count = count($keyword);
	foreach ($keyword as $key => $value){
		$term = "'%".pg_escape_string($value)."%'";
		$query .= "((lower(b_isbn) LIKE {$term} or lower(b_Name) LIKE {$term} or lower(b_author) LIKE {$term} or lower(b_pub) LIKE {$term}))";
		$query .= ($key !== $count-1)?" OR " : ""; 
	 
	}
	$words = "[".implode(", ", $keyword)."]";
	return array($query, $words);
}

function validateForm(){
	
	if(strlen(trim($_POST['keyword'])) === 0 || strlen(trim($_POST['keyword']))=== null){
		print "キーワードを入力してください。";
		exit(1);
	}
	else
	{
		$temp = htmlspecialchars(strtolower($_POST['keyword'])); // 미리 대문자를 소문자로 엔코딩
		$convertedKey = mb_convert_kana($temp, 's', 'utf-8'); // 일본어전각스페이스를 반각스페이스로 
		$keyToArr = preg_split("/[\s,]+/", $convertedKey, -1, PREG_SPLIT_NO_EMPTY);
	
		return $keyword = array_unique($keyToArr);
	}
}



function connectToDb(){
	//You must replace your own code belog one;
	//$connect_query = 'host=localhost user=zeng dbname=bookdb_1981117';
	$connect_query = 'host=localhost port=5432 dbname=bookdb_1981117 user=postgres password=angels';
	$conn = pg_connect($connect_query);
	if(!$conn){
		print "<hr>\n";
		print "bookdbデータベースの接続に失敗しました。";
		print preg_last_error($conn);
		print "<hr>\n";
		exit(1);
	}
	return $conn;
}


function init(){
	$conn = connectToDb();
	$keyword = validateForm();
 	list($query, $words) = makeQuery($keyword);
	$result = fetchToDb($conn, $query);
	paintToHtml($result, $query, $words);
	pg_close($conn);	
}

init();

?>