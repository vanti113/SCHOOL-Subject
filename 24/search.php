<?php

function paintToHtml($arr, $words, $e_words)
{
    if (!$arr) {
        $count = 0;
    } else {
        $count = count($arr);
    }
    
    $title = ["Search page", "図書検索データ"];
    require_once 'paintToHtml.php';
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
        $arr = pg_fetch_all($result);
    }
    return $arr;
}

function makeQuery($keyword, $e_words = array())
{

    $query = "SELECT img_url, b_isbn, b_name, b_author, b_pub, b_price, b_pubdate, b_buydate FROM zenglab2008 LEFT JOIN book_image ON b_isbn = isbn WHERE ";
    $count = count($keyword);

    foreach ($keyword as $key => $value) {

        $term = "'%" . pg_escape_string($value) . "%'";
        $query .= "((lower(b_isbn) LIKE {$term} or lower(b_Name) LIKE {$term} or lower(b_author) LIKE {$term} or lower(b_pub) LIKE {$term})) ";
        if ($e_words) {
            foreach ($e_words as $word) {
                $e_term = "'%" . pg_escape_string($word) . "%'";
                $e_query .= " AND ((lower(b_isbn) NOT LIKE ({$e_term}) and (lower(b_name) NOT LIKE ({$e_term}) and (lower(b_author) NOT LIKE ({$e_term}) and (lower(b_pub) NOT LIKE ({$e_term}))))))";
            }
            $query .= $e_query;
        }
        $query .= ($key !== $count - 1) ? " OR " : "";
    }

    $words = "[" . implode(", ", $keyword) . "]";
    return array($query, $words);
}


function validateForm()
{

    if (strlen(trim($_POST['keyword'])) === 0 || strlen(trim($_POST['keyword'])) === null) {
        print "キーワードを入力してください。";
        exit(1);
    } else {
        //최초에는 '/[-]\w+/' 정규표현식을 썼으나 일본어 단어를 잡아내지 못하는 단점이 있었음
        //그래서 내 나름대로 궁리한 끝에 -가 붙은 일본어와 한자, 영단어까지 모두 잡아내는 표현식을 만듬.
        $pattern = "/[-]+[ぁ-ゔ]+|[-]+[ァ-ヴー]+[々〆〤]+|[-]+[一-龥]+|[-]\w+/";
        $temp = htmlspecialchars(strtolower($_POST['keyword'])); // 미리 대문자를 소문자로 엔코딩
        $convertedKey = mb_convert_kana($temp, 's', 'utf-8'); // 일본어전각스페이스를 반각스페이스로 
        $keyToArr = preg_split("/[\s,]+/", $convertedKey, -1, PREG_SPLIT_NO_EMPTY);
        //$tempArr= preg_replace("/[-]\w+/", "", $keyToArr);
        $tempArr = preg_replace($pattern, "", $keyToArr);
        //preg_match_all('/[-]\w+/', $convertedKey, $except_word, PREG_PATTERN_ORDER);
        preg_match_all($pattern, $convertedKey, $except_word, PREG_PATTERN_ORDER);
        foreach ($except_word as $temp) {
            $exception_array = str_replace("-", "", $temp);
            foreach ($temp as $value) {
                $exception_word .= "[" . $value . "] ";
            }
        }

        $keyword = array_unique($tempArr);
        $unseted = array();
        for ($i = 0; $i < count($keyword); $i++) {

            if ($keyword[$i] === "") {
                unset($keyword[$i]);
            } else {
                $unseted[] = $keyword[$i];
            }
        }

        return array($unseted, $exception_array, $exception_word);
    }
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
    list($keyword, $exception_array, $exception_word) = validateForm();
    list($query, $query_words) = makeQuery($keyword, $exception_array);
    $result = fetchToDb($conn, $query);
    paintToHtml($result, $query_words, $exception_word);
}

init();
