<?php

//필요한건 접속 데이터 취득 html화


function paintToHtml($array = array()){
	

}

function fetchFromDb($conn, $query){
	$temp = pg_query($conn, $query);
	if(!$temp){
		print "query文にエラーがあります";
		echo pg_last_error($temp);
	}else{
		$result = pg_fetch_all($temp);
		return $result;
	}
}

function connectToDb(){
	
	$connect_query = 'host=localhost port=5432 dbname=bookdb_1981117 user=postgres password=angels';
	$conn = pg_connect($connect_query);
	if(!$conn){
		print "bookdbデータベースへの接続に失敗しました。<br/>";
        echo pg_last_error($conn);
        exit(1);
	}else{
		return $conn;	
	}
}

function init(){
	$conn = connectToDb();
	$query = "SELECT img_url, b_isbn, b_name, b_author, b_pub, b_price, b_pubdate, b_buydate FROM zenglab2008 LEFT JOIN book_image ON b_isbn = isbn WHERE b_price >= 3000";
	$result = fetchFromDb($conn, $query);
	paintToHtml($result);
}
init();



?>