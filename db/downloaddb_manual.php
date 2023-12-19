<DOCTYPE HTML>
<html>
<head></head>

<body>

<div id='db'>
<?php
$Data = file_get_contents("translations.txt");


// Print the JSON object on the screen
echo $Data;
?>


</div>
<script>
localStorage.setItem("translations",document.getElementById('db').innerHTML);
window.location.href = '../index.html';
</script>

</body>


</html>