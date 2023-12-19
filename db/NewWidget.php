<html>
<head></head>
<body>

<?php
	
        $post_data = file_get_contents('php://input');
        print_r($_POST);       
    	// Create and connect to SQLite database file.
	$db_file = new PDO('sqlite:Translate.s3db');
	// Prepare INSERT statement.
	$English = str_replace("'","''",$_POST["English"]);
	$Spanish = str_replace("'","''",$_POST["Spanish"]);
	$French = str_replace("'","''",$_POST["French"]);
	$Hindi = str_replace("'","''",$_POST["Hindi"]);
	$select = "INSERT INTO Translations (English,Spanish,French,Hindi) VALUES ('" . $English . "','" . $Spanish . "','" . $French . "','" . $Hindi . "')";
	$stmt = $db_file->prepare($select);
	echo "<br /><br /> SQL: " . $select;
	// Execute statement.
	$stmt->execute();
	echo "Insert Complete. Check results.";
	header("Location: index.php");
?>
<br /><br />
<hr />
<a href="ManageEntries.php">Return To Management Page</a>
</body>

</html>