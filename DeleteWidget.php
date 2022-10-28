<html>
<body>
<?php
	$qr = $_SERVER['QUERY_STRING'];
	echo $qr . "<br />";
        $d = str_replace("RecID=","",$qr);
        echo $d . "<br />";       
    	// Create and connect to SQLite database file.
	$db_file = new PDO('sqlite:Translate.s3db');
	// Prepare INSERT statement.
	$select = "Delete From Translations Where RecID = '" . $d . "'";
	$stmt = $db_file->prepare($select);
	
	// Execute statement.
	$stmt->execute();
	echo "<script>window.close();</script>Complete. Window should close now. <br />Query Executed: " . $select;
?>

</body>

</html>