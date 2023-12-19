<DOCTYPE HTML>
<html>
<head></head>

<body>

<div id='db'>
<?php
$csvfile = "translate.csv";

// Fetch the CSV data from the Google Sheet
$csvData = file_get_contents($csvfile);
//echo $csvData; // troubleshooting only, this line shouldn't be printed normally!
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
//window.location.href = 'index.html';
</script>

</body>


</html>