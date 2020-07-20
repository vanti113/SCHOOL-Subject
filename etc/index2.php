<?php


try {
	$con = pg_connect('host=localhost port=543 dbname=bookdb_1981117 user=postgres password=angels');	
	// $fetch = pg_query($con, "select count(*) from zenglab2008");
	// $temp = pg_fetch_array($fetch);
	// var_dump($temp);
}catch (Exception $e){
	// echo "다음과 같은 오류가 발생했습니다".$e->getMessage();
	// echo pg_last_error($con);
}



?>