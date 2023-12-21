<?php
    function getListOfFiles() {
        try {
            if (FILEPATH === null) {
                define("FILEPATH", "./files");
            }
            $fileList = [];
            foreach (new DirectoryIterator(FILEPATH) as $file) {
                if ($file->isDot()) continue;
                $filename = $file->getFilename();
                $language = "";
                $len = strlen($filename);
                $pos = strpos($filename, ".");
                if ($pos && $pos > 0) {
                    $language = substr($filename, $pos +1);
                    $filename = substr($filename, 0, $pos);                    
                }
                array_push($fileList, 
                    [
                        "filename" => $filename,
                        "language" => $language,
                        "fullpath" => FILEPATH . "/" . $filename
                    ]
                );
            }
            return $fileList;
        } 
        catch(Exception $err) {
            print_r($err);
        }
        return null;
    }

    function saveFile($filename, $language, $tags, $date) {

        return null;
    }
?>