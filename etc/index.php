<?php

try{
	$db = new PDO('pgsql:host=localhost; port=5432; dbname=bookdb_1981117','postgres','angels');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch (PDOException $e){
	print "다음과 같은 에러가 발생했습니다." . $e->getMessage();
}

function test($db){
	$temp = $db->query("select * from zenglab2008");
	$data = $temp->fetchAll(PDO::FETCH_ASSOC);
	
	echo count($data);
}

test($db);

?>