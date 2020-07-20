<?php




if ($_SERVER['REQUEST_METHOD'] === 'POST') {



    function goToHome()
    {
        print "<script>alert('本データのが削除されました')</script>";
        //이부분은 서버로 이동시 반드시 학교 서버에 맞춰서 바꿀것.
        print "<script>window.location.assign('http://localhost:81/school/24/main.php');</script>";

        exit(1);
    }

    function deleteRow($conn, $bookStatus, $bookImage)
    {
        $result1 = pg_query($conn, $bookImage);
        if (!$result1) {
            print "Query文かDBの接続にエラーがあります。";
            exit(1);
        } else {
            sleep(1);
        }

        $result2 = pg_query($conn, $bookStatus);
        if (!$result2) {
            print "Query文かDBの接続にエラーがあります。";
            exit(1);
        } else {

            goToHome();
        }
        pg_close($conn);
    }
    function makeQuery()
    {
        $target = $_POST['delete'];

        $bookStatus = "DELETE FROM zenglab2008 WHERE b_isbn = '{$target}'";
        $bookImage = "DELETE FROM book_image WHERE isbn = '{$target}'";
        return array($bookStatus, $bookImage);
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
        list($bookStatus, $bookImage) = makeQuery();
        deleteRow($conn, $bookStatus, $bookImage);
    }
    init();
}
