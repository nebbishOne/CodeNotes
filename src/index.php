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

    define("VERSION", "0.01-alpha");

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
    <h1>Codenotes</h1>
  </header>
  <section class="container">
    <div class="row">
        <div class="four columns">
            <h4>My codenotes</h4>
            <input id="search" type="text" placeholder="Filter the list..." onsubmit="handleSearch()">
            <br /><br /><br />
            <ul class="codelist">
                <?php
                    $files = getListOfFiles();
                    if ($files && sizeof($files) <> 0) {
                        foreach ($files as $file) {
                            $filename = $file['filename'] . " (" . $file['language'] . ")";
                            $filepath = $file['fullpath'];
                            echo "<li><a href=\"./\">$filename</a></li>";
                        }
                    } else {
                        echo "<li>No files saved yet</li>";
                    }
                ?>
            </ul>
        </div>
        <div class="eight columns">
            <form method="POST">
                <div class="anote">
                    <div class="row">
                        <div class="twelve columns">
                            <label for="name">Name*</label>
                        </div>
                    </div>
                    <div class="row">    
                        <div class="twelve columns">
                            <input type="text" id="name" name="name" required maxlength="60" size="48">
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
                            <input type="text" id="tags" name="tags" required name="tags" size="30">
                        </div>
                        <div class="four columns">
                            <select name="language">
                                <option value="" selected>Select one...</option>
                                <option value="C">C</option>
                                <option value="C++">C++</option>
                                <option value="C#">C#</option>
                                <option value="CSS">CSS</option>
                                <option value="CSV">CSV</option>
                                <option value="HTML">HTML</option>
                                <option value="Java">Java</option>
                                <option value="JavaScript">JavaScript</option>
                                <option value="PHP">PHP</option>
                                <option value="Python">Python</option>
                                <option value="Shell">Shell</option>
                                <option value="Text">Text</option>
                                <option value="TypeScript">TypeScript</option>
                                <option value="XML">XML</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="twelve columns">
                            <label for="code">Code*</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="twelve columns">
                            <textarea required id="code" name="code" placeholder="Code goes here..." spellcheck="false"></textarea>
                        </div>
                    </div>
                </div>
                <div class="buttonsrow">
                    <div class="row">
                        <div class="four columns">
                            <button>Add a file</button>
                        </div>
                        <div class="six columns">
                            <button name="savebutton" id="save" class="button-primary">Save</button>
                        </div>
                        <div class="two columns">
                            <button name="cancelbutton" id="cancel">Cancel</button>
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