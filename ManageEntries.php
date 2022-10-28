<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
    <style>
        table{
border-collapse:collapse;
border:1px solid #FF0000;
}

table td, th{
border:1px solid #FF0000;
}
td {
	text-align: center;
}
th {
	width: 20%;
	}
	.highlight {
                border-color: black;
                border: 2px dashed;
                background-color: lightgreen;
            }
            .black_overlay{
	            display: none;
	            position: absolute;
	            top: 0%;
	            left: 0%;
	            width: 100%;
	            height: 100%;
	            background-color: black;
	            z-index:1001;
	            -moz-opacity: 0.8;
	            opacity:.80;
	            filter: alpha(opacity=80);
            }
            .white_content {
	            display: none;
	            position: absolute;
	            width: auto;
	            height: 35%;
	            padding: 20px;
	            border: 1px solid black;
	            background-color: white;
	            z-index:1002;
	            overflow: auto;
                bottom: 0;
                right: 0;
                border-radius: 25px;
            }
    </style>
</head>
<body>
<script>
async function getTranslations() {
text = document.getElementById('txtEnglish').value;
spanish = await myFunction(text,"en","es");
console.log(spanish);
document.getElementById('txtSpanish').value = spanish;

french = await myFunction(text,"en","fr");
console.log(french);
document.getElementById('txtFrench').value = french;

//hindi = await myFunction(text,"en","hi");
//console.log(hindi);
//document.getElementById('txtHindi').value = hindi;

};
async function myFunction(prompt,first,second) {

const res = await fetch("https://libretranslate.de/translate", {
	method: "POST",
	body: JSON.stringify({
		q: prompt,
		source: first,
		target: second,
		format: "text"
	}),
	headers: { "Content-Type": "application/json" }
});

data = await res.json();
var translated = data.translatedText;

return translated;
}
</script>
    
        <div>
        
        <form id="form1" method="POST" action="NewWidget.php" >
        <div id="light" class="white_content">
                    <button type="button" style="float: left !important;" onclick="document.getElementById('light').style.display='none';">Close</button>
                    <button type="button" onclick="getTranslations()">Translate</button>
                    <button id="btnSubmitNewItem">Submit</button>
                    <br />
                    
                    <div id="columnc" class="column" style="width: 85% !important; clear: both; margin: 0 auto;">
                        <header >New Translation Entry<hr /></header>
                        
                        <br />
                        <label>English: </label><input ID="txtEnglish" name="English"></input>
                        <br /><label>Spanish: </label><input ID="txtSpanish" name="Spanish"></input>
                        <br /><label>French: </label><input ID="txtFrench" name="French"></input>
                        <br /><label>Hindi: </label><input ID="txtHindi" name="Hindi"></input>
                        
                    </div>
        </div>
        </form>
        <div>
        <!--float: left !important;-->
        <button type="button" style="" onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">New Entry</button>
        <br /><br />
        </div>
        
        
        
        <table>
        <tr><th>English</th><th>Spanish</th><th>French</th><th>Hindi</th><th>Actions</th></tr>
            <?php

                // Create and connect to SQLite database file.
                $db_file = new PDO('sqlite:Translate.s3db');
                // Prepare SELECT statement.
                $select = "SELECT English,Spanish,French,Hindi,RecID FROM Translations";
                $stmt = $db_file->prepare($select);
                
                // Execute statement.
                $stmt->execute();
                
                // Get the results.
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($results as $row) {
                    
                    echo "<tr><td>" . $row["English"] . "</td><td>" . $row["Spanish"] . "</td><td>" . $row["French"] . "</td><td>" . $row["Hindi"]  . "</td><td><a target='_blank' href='EditExistingItem.php?RecID=" . $row["RecID"] . "'>Edit</a><a target='_blank' style='margin-left: 15px;' href='DeleteWidget.php?RecID=" . $row["RecID"] . "'>Delete</a></tr>";
                }

            ?>
            
            </table>
        </div>

</body>
</html>