<?php 
// ===================================================================================
// Codenotes -  A place to store code or any other text so you can use it later.
// Copyright ©️ 2023 nebbishOne

// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

// This program is distributed WITHOUT ANY WARRANTY; 
// without even the implied warranty of MERCHANTABILITY or FITNESS FOR 
// A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
// ===================================================================================

require './php/formFunctions.php';
require './php/fileFunctions.php';

    define("VERSION", "1.0");
    defined("FILEPATH") or define("FILEPATH", "./files");

    // TODO remove after development
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);

?><!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">

  <title>Codenotes</title>

  <script type="module">
    document.documentElement.classList.remove('no-js');
    document.documentElement.classList.add('js');
  </script>

  <link rel="stylesheet" href="css/normalize.css">  
  <link rel="stylesheet" href="css/skeleton.css">  
  <link rel="stylesheet" href="css/custom.css">

  <meta name="description" content="Code snippets and other notes">
  <meta property="og:title" content="Codenotes">
  <meta property="og:description" content="Code snippets and other notes">
  <meta property="og:locale" content="en_US">
  <meta property="og:type" content="website">
  <link rel="icon" href="/favicon.ico">
  <link rel="icon" href="/favicon.svg" type="image/svg+xml">
  <meta name="theme-color" content="#FF00FF">
</head>

<body>
  <header>
    <h1><a id="headerh1" href="./index.php">Codenotes</a></h1>
  </header>
  <section class="container">
    <div class="row">
        <div class="four columns">
            <h4>My Codenotes</h4>
            <form method="POST">
                <input id="search" name="search" type="text" placeholder="Filter the list...">
            </form>
            <br /><br /><br />
            <ul class="codelist">
                <form method="POST">
                <?php
                    $files = getListOfFiles();
                    if ($files && sizeof($files) <> 0) {
                        foreach ($files as $a_file) {
                            $filenm = $a_file['filename'] . " (" . $a_file['language'] . ")";
                            $fullpath = str_replace(".", "^^^", $a_file['fullpath']);
                            if (isset($searchString) && (!str_contains(strtoupper($fullpath), strtoupper($searchString)))) {
                                echo '<li><button name="' . $fullpath . '" class="button-codenote hide">' . $filenm . '</button></li>';
                            } else {
                                echo '<li><button name="' . $fullpath . '" class="button-codenote">' . $filenm . '</button></li>';
                            }
                        }
                    } else {
                        echo "<li>No files saved yet</li>";
                    }
                ?>
                </form>
            </ul>
        </div>
        <div class="eight columns">
            <form method="POST" enctype="multipart/form-data">
                <div class="anote">
                    <div class="row">
                        <div class="twelve columns">
                            <label for="name">Name*</label>
                        </div>
                    </div>
                    <div class="row">    
                        <div class="twelve columns">
                            <input type="text" id="name" name="name" required maxlength="60" size="48"  
                                <?php 
                                    if(isset($filename) && isset($language)) { echo "value=\"" . $filename . "\"";
                                    } else {
                                        echo "value=\"\"";
                                    }
                                ?> 
                            >
                        </div>
                    </div>
                    <div class="row">
                        <div class="eight columns">
                            <label for="tags">Tags*</label>
                        </div>
                        <div class="four columns">
                            <label for="language">Language</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="eight columns">                        
                            <input type="text" id="tags" name="tags" required name="tags" size="30"
                                <?php 
                                    if(isset($tags)) { echo "value=\"" . $tags . "\""; 
                                    } else {
                                        echo "value=\"\"";
                                    }
                                ?>
                            >
                        </div>
                        <div class="four columns">
                            <select name="language">
                                <?php $lang = ""; if (isset($language)) { $lang = $language; } ?>
                                <option value="" <?php if ($lang == "") { echo "selected"; } ?>>Select one...</option>
                                <option value="C" <?php if ($lang == "C") { echo "selected"; } ?>>C</option>
                                <option value="C++" <?php if ($lang == "C++") { echo "selected"; } ?>>C++</option>
                                <option value="C#" <?php if ($lang == "C#") { echo "selected"; } ?>>C#</option>
                                <option value="CSS" <?php if ($lang == "CSS") { echo "selected"; } ?>>CSS</option>
                                <option value="CSV" <?php if ($lang == "CSV") { echo "selected"; } ?>>CSV</option>
                                <option value="HTML" <?php if ($lang == "HTML") { echo "selected"; } ?>>HTML</option>
                                <option value="Java" <?php if ($lang == "Java") { echo "selected"; } ?>>Java</option>
                                <option value="JavaScript" <?php if ($lang == "JavaScript") { echo "selected"; } ?>>JavaScript</option>
                                <option value="PHP" <?php if ($lang == "PHP") { echo "selected"; } ?>>PHP</option>
                                <option value="Python" <?php if ($lang == "Python") { echo "selected"; } ?>>Python</option>
                                <option value="Shell" <?php if ($lang == "Shell") { echo "selected"; } ?>>Shell</option>
                                <option value="Text" <?php if ($lang == "Text") { echo "selected"; } ?>>Text</option>
                                <option value="TypeScript" <?php if ($lang == "TypeScript") { echo "selected"; } ?>>TypeScript</option>
                                <option value="XML" <?php if ($lang == "XML") { echo "selected"; } ?>>XML</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="twelve columns">
                            <label for="selectedfile">File</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="twelve columns">
                            <input class="button-file" type="file" id="selectedfile" name="selectedfile" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="twelve columns">
                            <label for="code">Code</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="twelve columns">
                            <textarea id="code" name="code" ondblclick="this.select();" placeholder="
                                <?php 
                                    if (isset($code)) { 
                                        echo ""; 
                                    } else {echo "Code goes here...";}
                                ?>" spellcheck="false"><?php if (isset($code)) { echo trim($code); } else { echo ""; } ?></textarea>
                        </div>
                    </div>
                    <div class="buttonsrow">
                        <div class="row">
                            <div class="four columns">
                                <button name="savebutton" id="save" class="button-primary">Save</button>
                            </div>
                            <div class="four columns">
                                <button name="resetbutton" id="reset" >Reset</button>
                            </div>
                            <div class="four columns">
                                <button name="deletebutton" id="delete" class="button-delete">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>  
  </section>
  <div id="footer">
    Version <?php echo VERSION; ?>
    <br /><br />
  </div>
  <script src="./js/script.js"></script>
</body>
</html>