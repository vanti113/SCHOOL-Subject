<?php

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
$conn = connectToDb();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    function goToHome()
    {
        print "<script>alert('本データのが変更されました')</script>";
        //이부분은 서버로 이동시 반드시 학교 서버에 맞춰서 바꿀것.
        print "<script>window.location.assign('http://localhost:81/school/24/main.php');</script>";

        exit(1);
    }

    function updateToDb($conn, $bookStatus, $bookImage)
    {
        $result1 = pg_query($conn, $bookStatus);
        if (!$result1) {
            print "Query文かDBの接続にエラーがあります。";
            exit(1);
        } else {
            sleep(1);
        }

        $result2 = pg_query($conn, $bookImage);
        if (!$result2) {
            print "Query文かDBの接続にエラーがあります。";
            exit(1);
        } else {

            goToHome();
        }
    }

    function makeQuery($keywords)
    {
        $isbn = $keywords['isbn'];
        $name = $keywords['name'];
        $author = $keywords['author'];
        $pub = $keywords['pub'];
        $price = $keywords['price'];
        $pubdate = $keywords['pubdate'];
        $buydate = $keywords['buydate'];
        $url = $keywords['url'];

        $bookStatus = "UPDATE zenglab2008 SET b_isbn='{$isbn}', b_name='{$name}', b_author='{$author}', b_pub='{$pub}', b_price={$price}, b_pubdate='{$pubdate}', b_buydate='{$buydate}' WHERE b_isbn = '{$isbn}'";
        $bookImage = "UPDATE book_image SET isbn='{$isbn}', img_url='{$url}' WHERE isbn = '{$isbn}'";
        return array($bookStatus, $bookImage);
    }

    function validate_form($data)
    {
        $confirmed_data = array();
        foreach ($data as $key => $value) {
            $value = mb_convert_kana($value, 's', "UTF-8");
            $value = htmlentities(trim($value), ENT_DISALLOWED, "UTF-8");
            if ($key === "price") {
                $value = intval($value);
            }
            $confirmed_data[$key] = $value;
        }
        return $confirmed_data;
    }

    function init()
    {
        global $conn;
        $data = validate_form($_POST);
        list($bookStatus, $bookImage) = makeQuery($data);
        updateToDb($conn, $bookStatus, $bookImage);
        pg_close($conn);
    }
    init();
} else {

    function paintToHtml($arr)
    {
        $title = ["Update page", "図書データ変更"];
        $URL = "http://localhost:81/school/24/update.php";
        require_once "paintToHtml2.php";
        // var_dump($arr);
    }


    function fetchToDb($conn, $query)
    {
        $result = pg_query($conn, $query);
        if (!$result) {
            print "--------------------";
            print "データの取得に失敗しました。Query文にエラーがあります。";
            print "--------------------";
            exit(1);
        } else {
            $arr = pg_fetch_assoc($result);
        }
        pg_close($conn);
        return $arr;
    }

    function makeQuery()
    {
        $targetNum = $_GET['update'];
        $query = "SELECT img_url, b_isbn, b_name, b_author, b_pub, b_price, b_pubdate, b_buydate FROM zenglab2008 LEFT JOIN book_image ON b_isbn = isbn WHERE b_isbn='{$targetNum}'";
        return $query;
    }

    function init()
    {
        global $conn;
        $query = makeQuery();
        $arr = fetchToDb($conn, $query);
        paintToHtml($arr);
    }
    init();
}
