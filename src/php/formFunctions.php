<?php
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);

    defined("FILEPATH") or define("FILEPATH", "./files");

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        unset($name, $tags, $filename, $code, $language);
        // then display the page normally

    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['search'])) {
            $searchString = $_POST['search'];
            return;
        }

        if (isset($_POST['deletebutton'])) { 
            $nme = $_POST['name'];
            $language = $_POST['language'];
            $filenme = "/" . $nme . "." . $language;
            if (file_exists(FILEPATH . $filenme)) {
                try {
                    unlink(FILEPATH . $filenme);
                }
                catch(Exception $err) {
                   //
                }
            }                
            unset($name, $tags, $filename, $code, $language); // clear the form
            return;
        }

        if (isset($_POST['name']) && isset($_FILES['selectedfile']) && $_FILES['selectedfile']["name"] !== "") {
            // look for an attached file instead of code
            $name = $_POST['name'];
            $tags = $_POST['tags'];
            $language = $_POST['language'];
            $the_file = $_FILES['selectedfile'];
            if (!isset($name) || !isset($tags) || !isset($language) || !isset($the_file)) {
                echo "Missing information. Please complete required fields and save again.";
                return;
            }            
            $tmp_name = $the_file["tmp_name"];
            $temppath = "./tempfiles/" . $name;
            $filename = $name . "." . $language;
            $newpath = FILEPATH . "/" . $filename;
            move_uploaded_file($tmp_name, $temppath);
            try {
                // read in temp file
                $f1 = fopen($temppath, "r") or die("fopen failed");
                $code = fread($f1, filesize($temppath));
                fclose($f1);
                // write out new file
                $f2 = fopen($newpath, "w+") or die("fopen failed");                
                fwrite($f2, trim($code));
                fwrite($f2, "TAGSTAGSTAGS" . $tags);
                fclose($f2);
                touch($newpath);
            }
            catch(Exception $err) {
                echo $err;
            }
            return;
        }

        if (isset($_POST['name']) && isset($_POST['code'])) {
            $nme = $_POST['name'];
            $tags = $_POST['tags'];
            $language = $_POST['language'];
            if (!isset($nme) || !isset($tags) || !isset($language)) {
                echo "Missing information. Please complete required fields and save again.";
                return;
            }
            if (isset($_POST['resetbutton'])) { 
                unset($name, $tags, $filenme, $filenm, $filename, $code, $language); // clear the form
                return;
            }

            // else process SAVE button
            $code = $_POST['code'];
            $filename = $nme;
            $filenme = "/" . $nme . "." . $language;
            $f = fopen(FILEPATH . $filenme, "w+") or die("fopen failed");
            fwrite($f, trim($code));
            fwrite($f, "TAGSTAGSTAGS" . $tags);
            fclose($f);
            touch(FILEPATH . $filenme);

        } else {
            foreach ($_POST as $key => $value) {
                // echo "The Field name " . $key . " is " . $value . "<br />";
                $filename = "";
                $language = "";
                $code = "";
                $fullpath = str_replace("___", " ", $key);
                $fullpath = str_replace("^^^", ".", $fullpath);
                // $fullpath = str_replace("_", ".", $fullpath);
                $slashpos = strrpos($fullpath, "/");
                if ($slashpos && $slashpos > 0) {
                    $filename = substr($fullpath, $slashpos + 1);
                }
                $dotpos = strrpos($filename, ".");
                if ($dotpos && $dotpos > 0) {
                    $language = substr($filename, $dotpos +1);
                }
                $filename = substr($filename, 0, $dotpos);
                // echo "Filename is " . $filename;
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