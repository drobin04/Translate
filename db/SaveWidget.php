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
	$select = "Update Translations Set English = '" . $English . "', Spanish = '" . $Spanish . "', French = '" . $French . "', Hindi = '" . $Hindi . "' Where RecID = " . $_POST["RecID"];
	$stmt = $db_file->prepare($select);
	echo "<br /><br /> SQL: " . $select;
	// Execute statement.
	$stmt->execute();
	echo "<br />Insert Complete. Check results.<script>window.close();</script>"
?>


</body>

</html>