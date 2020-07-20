<?php

function query($conn)
{
    $temp = "%PHP%";
    $temp = pg_escape_string($temp);
    $query = "SELECT * FROM zenglab2008 WHERE b_name LIKE" . $temp;


    /*     $temp = pg_query($conn, $query);
    $result = pg_fetch_all($temp);
 */
    var_dump($query);
}


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

function init()
{
    $conn =  connectDb();
    query($conn);
}
init();
