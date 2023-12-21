<?php
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);    

    define("FILEPATH", "./files/");

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        # dsplay the page normally
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nme = $_POST['name'];
        $tags = $_POST['tags'];
        $language = $_POST['language'];
        if (!isset($nme) || !isset($tags) || !isset($language)) {
            echo "Missing information. Please complete required fields and save again.";
            return;
        }
        $code = $_POST['code'];
        if (isset($code)) {
            $filename = $nme . "." . $language;
            $f = fopen(FILEPATH . $filename, "w+") or die("fopen failed");
            fwrite($f, $code);
            fclose($f);
            chmod(FILEPATH . $filename, 0777);
            touch(FILEPATH . $filename);
        } else {
            echo "NoCode";
        }
    } else {
        echo "no code in post";
    }
?>