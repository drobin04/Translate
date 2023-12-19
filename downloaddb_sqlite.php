<DOCTYPE HTML>
<html>
<head></head>

<body>

<div id='db'><?php

$db_file = new PDO('sqlite:Translate.s3db');
                $select = "SELECT English,Spanish,French,Hindi, RecID FROM Translations";
                $stmt = $db_file->prepare($select);
                $stmt->execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo "{\"translations\": ["; //begin array
                
                $widgetsarray = "";

                foreach($results as $row) {
                    if ($widgetsarray <> "") { $widgetsarray = $widgetsarray . ",";}
                    $widgetsarray = $widgetsarray . "{\"English\": \"" . $row["English"] . "\"," .
                        "\"Spanish\": \"" . $row["Spanish"] .
                        "\", \"French\": \"" . $row["French"] . 
                        "\", \"Hindi\": \"". $row["Hindi"] . "\", \"RecID\": \"" . $row["RecID"] . "\"}";
                }
                
$widgetsarray = $widgetsarray . "]}";

echo $widgetsarray;

?></div>
<script>
localStorage.setItem("translations",document.getElementById('db').innerHTML);
window.location.href = 'index.html';
</script>

</body>


</html>