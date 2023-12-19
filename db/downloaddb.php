<?php

function getDBProvider() {
    $DBP = file_get_contents("DB_Provider.txt");
    
    switch ($DBP) {
        case "googledrive":
            echo "googledrive";
            header("Location: downloaddb_googledrive.php");
        break;  
        case "manual":
            echo "manual";
            header("Location: downloaddb_manual.php");
        break;
        case "sqlite":
            echo "sqlite";
            header("Location: downloaddb_sqlite.php");
        break; 
        case "csv":
            echo "csv";
            header("Location: downloaddb_csv.php");
    }
}

getDBProvider();
?>