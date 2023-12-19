<DOCTYPE HTML>
<html>
<head></head>

<body>

<div id='db'>
<?php
// URL of the Google Sheet in CSV format
// NOTE - THE SHEET MUST BE MADE PUBLICLY AVAILABLE. 
// OTHERWISE THE DATA SENT BACK FROM THIS URL WILL BE A GOOGLE SIGN IN PAGE AND WILL BE VERY CONFUSING TO TROUBLESHOOT.
// THIS FILE DOESNT SEEM TO RUN WHEN HOSTED FROM FREESHOTIA.
// GOING TO HAVE TO RUN IT ON LOCAL PHP SERVER, THEN JUST UPDATE THE FILE. WILL MAKE THINGS EASIER TO MANAGE OVERALL. 
$sheetid = file_get_contents("google_sheet_id.txt");
$sheetUrl = "https://docs.google.com/spreadsheets/d/" . $sheetid . "/export?format=csv";
$csvfile = "translate.csv";

// Fetch the CSV data from the Google Sheet
$csvData = file_get_contents($sheetUrl);
//echo $csvData;
// Convert the CSV data into a 2D array
$lines = explode("\n", $csvData);
$header = str_getcsv(array_shift($lines));
$data = [];
foreach ($lines as $line) {
    $row = array_combine($header, str_getcsv($line));
    if ($row) {
        $data[] = $row;
    }
}

// Convert the 2D array into a JSON object
$jsonData = json_encode(["translations" => $data], JSON_PRETTY_PRINT);

// Print the JSON object on the screen
echo $jsonData;
?>


</div>
<script>
localStorage.setItem("translations",document.getElementById('db').innerHTML);
window.location.href = '../index.html';
</script>

</body>


</html>