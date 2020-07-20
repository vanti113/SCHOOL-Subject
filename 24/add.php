<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    function goToHome()
    {
        print "<script>alert('本データが追加されました')</script>";
        //이부분은 서버로 이동시 반드시 학교 서버에 맞춰서 바꿀것.
        print "<script>window.location.assign('http://localhost:81/school/24/main.php');</script>";
        exit(1);
    }

    function addToDb($conn, $bookStatus, $bookImage)
    {
        var_dump($bookStatus);
        $result1 = pg_query($conn, $bookStatus);
        if (!$result1) {
            print "Query文かDBの接続にエラーがあります。";
            var_dump($result1);
            exit(1);
        } else {
            sleep(1);
        }

        $result2 = pg_query($conn, $bookImage);
        if (!$result2) {
            print "Query文かDBの接続にエラーがあります";
            //var_dump($result2);
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

        $bookStatus = "INSERT INTO zenglab2008(b_isbn, b_name, b_author, b_pub, b_price, b_pubdate, b_buydate) VALUES('{$isbn}', '{$name}', '{$author}', '{$pub}', {$price}, '{$pubdate}', '{$buydate}')";
        $bookImage = "INSERT INTO book_image(isbn, img_url) VALUES('{$isbn}', '{$url}')";
        return array($bookStatus, $bookImage);
    }

    function validate_form($data)
    {
        $confirmed_data = array();
        foreach ($data as $key => $value) {
            $value = mb_convert_kana($value, 's', "UTF-8");
            $value = htmlentities(trim($value), ENT_QUOTES, "UTF-8");

            if ($key !== "url") {
                //이번에는 책의 이미지가 필요해서 url이미지의 필터링을 헤제하지만, 이건 굉장히 위험한 방법이다.
                $value = preg_replace("/[\s\t\'\;\=]+/", "", $value); // 탭이나 특수문자 제거
                $value = preg_replace("/\s{1,}1\=(.*)+/", "", $value); //공백뒤에 1=1 등 을 제거
                $value = preg_replace("/\s{1,}(or|and|null|where|limit)/i", "", $value); //공백이후 and or null where등 sql명령어 제거 
            }

            if ($key === "price") {
                $value = intval($value);
            }
            $confirmed_data[$key] = $value;
        }
        return $confirmed_data;
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
        $data = validate_form($_POST);
        list($bookStatus, $bookImage) = makeQuery($data);
        addToDb($conn, $bookStatus, $bookImage);
        pg_close($conn);
    }
    init();
} else {
    function paintToHtml()
    {
        $title = ["Add page", "図書データ登録"];
        $URL = "http://localhost:81/school/24/add.php";
        require_once "paintToHtml2.php";
    }
    paintToHtml();
}
