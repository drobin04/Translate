<!DOCTYPE html><html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--<link rel="stylesheet" href="button.css">-->
    <meta http-equiv="refresh" content="20">
</head>
<body>
        <div>
            <?php

                $db_file = new PDO('sqlite:Translate.s3db');
                $select = "SELECT English,Spanish,French,Hindi, RecID FROM Translations ORDER BY RANDOM() LIMIT 1";
                $stmt = $db_file->prepare($select);
                $stmt->execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($results as $row) {
                    echo "<div class='Translations'>English: <a target='_blank' href='https://translate.google.com/?sl=en&tl=es&text=" 
                    . urlencode($row[English]) . "&op=translate'>" . $row["English"] 
                    . "</a><br />Spanish: 
                    <a target='_blank' href='https://translate.google.com/?sl=en&tl=es&text=" 
                    . urlencode($row[English]) 
                    . "&op=translate'>" . $row["Spanish"] 
                    . "</a><br />French: 
                    <a target='_blank' href='https://translate.google.com/?sl=en&tl=fr&text=" 
                    . urlencode($row[English]) . "&op=translate'>" 
                    . $row["French"] . "</a><br />Hindi: <a target='_blank' href='https://translate.google.com/?sl=en&tl=hi&text=" 
                    . urlencode($row[English]) . "&op=translate'>" . $row["Hindi"] . "</a></div>";
                }
                echo "<br /> <a target='_blank' href='DeleteWidget.php?RecID=" . $row["RecID"] . "'>Delete Entry</a><a target='_blank' style='margin-left: 15px;' href='EditExistingItem.php?RecID=" . $row["RecID"] . "'>Edit Entry</a><br /> <a target='_blank' style='margin-left: 15px;' href='ManageEntries.php' >Manage Entries</a> <a href='.'>Refresh</a>";
            ?>
        </div>
        
</body>
</html>