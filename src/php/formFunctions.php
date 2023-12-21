<?php
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);

    defined("FILEPATH") or define("FILEPATH", "./files");

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        unset($name, $tags, $filename, $code, $language);
        # then display the page normally

    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['name']) && isset($_POST['code'])) {
            $nme = $_POST['name'];
            $tags = $_POST['tags'];
            $language = $_POST['language'];
            if (!isset($nme) || !isset($tags) || !isset($language)) {
                echo "Missing information. Please complete required fields and save again.";
                return;
            }
            $code = $_POST['code'];
            $filename = "/" . $nme . "." . $language;
            $f = fopen(FILEPATH . $filename, "w+") or die("fopen failed");
            fwrite($f, trim($code));
            fwrite($f, "TAGSTAGSTAGS" . $tags);
            fclose($f);
            chmod(FILEPATH . $filename, 0777);
            touch(FILEPATH . $filename);
        } else {
            foreach ($_POST as $key => $value) {
                # echo "The Field name " . htmlspecialchars($key) . " is " . htmlspecialchars($value) . "<br />";
                $filename = "";
                $language = "";
                $code = "";
                $fullpath = str_replace("___", " ", $key);
                $fullpath = str_replace("_", ".", $fullpath);
                $slashpos = strrpos($fullpath, "/");
                if ($slashpos && $slashpos > 0) {
                    $filename = substr($fullpath, $slashpos);
                }
                $dotpos = strrpos($filename, ".");
                if ($dotpos && $dotpos > 0) {
                    $language = substr($filename, $dotpos +1);
                }
                $filename = substr($filename, 0, $dotpos);
                try {
                    $f = fopen($fullpath, "r") or die("fopen failed");
                    $code = fread($f, filesize($fullpath));
                    fclose($f);
                    $tagpos = strpos($code, "TAGSTAGSTAGS");
                    $tags = substr($code, $tagpos);
                    $tags = substr($tags, 12);
                    $code = trim(substr($code, 0, $tagpos));
                } 
                catch(Exception $err) {
                    echo $err;
                }
            }            
        }
    } else {
        echo "no code in post";
    }
?>