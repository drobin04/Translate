<html>
    <head>
        <style>
            body {
            background-color: lightblue;
            }
            .MainPanel {
                max-width: 800px !important;
                margin: 40px auto;
                border-color: black;
                border: 1px solid black;
                background-color: white;
                padding: 30px;
                border-radius: 25px;
                overflow: auto;
                height: auto;
                width: auto;
            }
        

        .MainPanel input, .MainPanel textarea, .MainPanel select {
            border-left-width: inherit;
        }
        
        .inputs {width: 100%;}

        .translations {height: 600px;}
        </style>
        
    </head>
    <body>
        <div class="MainPanel">

<h1>Setup page for <a href="index.html">Translate</a></h1>

<?php



if (isset($_GET["action"])) {

    $action = $_GET["action"];
    switch ($action) {
        case "settings":
            file_put_contents("db/DB_Provider.txt",$_POST["dbprovider"]);
            file_put_contents("db/google_sheet_id.txt", $_POST["gsheetid"]);
            break;

        case "translations_csv":
            
            file_put_contents("db/translate.csv",$_POST["translations"]);
            break;
    }


}

$dbprovider = file_get_contents("db/DB_Provider.txt");
$google_sheet_id = file_get_contents("db/google_sheet_id.txt");
$translate_csv = file_get_contents("db/translate.csv");
$readme = file_get_contents("README.md");
?>

<form id="form1" method="POST" action="setup.php?action=settings">
<label>DB Provider: </label>
<select id="dbprovider" name="dbprovider">
    <option value="<?php echo $dbprovider; ?>"><?php echo $dbprovider; ?></option>
    <option value="googledrive">Google Spreadsheet</option>
    <option value="csv">CSV</option>
    <option value="sqlite">SQLite</option>
    <option value="manual">Manual</option>
</select>
<br />
<br />

<label>Google Sheet ID: </label><br />
<input class="inputs" id="gsheetid" name="gsheetid" value="<?php echo $google_sheet_id; ?>"></input>
<br /><br />
<button>Save</button>

</form>
<br /><br /><br /><br />

<form id="form2" method="POST"  action="setup.php?action=translations_csv">
    <label>CSV Translations:</label><br />
    <textarea class="inputs translations" id="translations" name="translations"><?php echo $translate_csv; ?></textarea>
    <br />
    <button>Save</button>

</form>

<br /><br /><br />

<h1>Read Me For Using This App</h1>
<md-block>

<?php echo $readme; ?>

</md-block>

</div><script type="module" src="js/md-block.js"></script>
    </body>

</html>
