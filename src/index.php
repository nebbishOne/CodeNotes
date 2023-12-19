<!DOCTYPE html>
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
        <div class="four columns codelist">
            <h4>My codenotes</h4>
            <input id="search" type="text" placeholder="Enter a note or language name" onsubmit="handleSearch()">
            <br /><br /><br />
            <ul>
                <li>First</li>
                <li>First</li>
                <li>First</li>
                <li>First</li>
            </ul>
        </div>
        <div class="eight columns">
            
            <div class="anote">
                <div class="row">
                    <div class="eight columns">
                        <label for="name">Name*</label>
                    </div>
                    <div class="four columns">
                        <label for="date">Date</label>
                    </div>
                </div>
                <div class="row">    
                    <div class="eight columns">
                        <input type="text" name="name" required maxlength="30" size="30">
                    </div>
                    <div class="four columns">
                        <input type="date" name="date">
                    </div>
                </div>
                <div class="row">
                    <div class="eight columns">
                        <label for="tags">Tags*</label>
                    </div>
                    <div class="four columns">
                        <label for="tags">Language</label>
                    </div>
                </div>
                <div class="row">
                    <div class="eight columns">                        
                        <input type="text" name="tags" required name="tags" size="30">
                    </div>
                    <div class="four columns">
                        <select name="language">
                            <option value="">...Please choose an option</option>
                            <option value="css">CSS</option>
                            <option value="html">HTML</option>
                            <option value="javascript" selected>Javascript</option>
                            <option value="typescript">Typescript</option>
                            <option value="xml">XML</option>
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
                        <textarea required name="code" placeholder="Code goes here..."></textarea>
                    </div>
                </div>
            </div>
            <div class="buttonsrow">
                <div class="row">
                    <div class="four columns">
                        <button>Add a file</button>
                    </div>
                    <div class="six columns">
                        <button name="savebutton" id="save" class="button-primary" disabled="true">Save</button>
                    </div>
                    <div class="two columns">
                        <button name="cancelbutton" id="cancel">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>  
  </section>
  <div id="footer">
    Version 0.01
  </div>
  <script src="./js/script.js"></script>
</body>
</html>