<?php
//데이터베이스 접속 클래스.

class Db
{
	function connectDb()
	{	
		//You must replace your own code belog one;
		//$connect_query = 'host=localhost user=zeng dbname=bookdb_1981117';
		$conn = pg_connect('host=localhost port=5432 dbname=bookdb_1981117 user=postgres password=angels');
		if ($error = pg_last_error($conn)) {

			print $error;
		};

		return $conn;
	}
}
