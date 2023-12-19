if (localStorage.getItem("translations") == null) {
    window.location.href = 'downloaddb_manual.php';
} else {
    $translations = JSON.parse(localStorage.getItem("translations"));

    function loadtranslation() {

    $selectedtrans = $translations.translations[Math.floor(Math.random() * $translations.translations.length)];
//    document.getElementById("content").innerHTML = JSON.stringify($selectedtrans);
    $content = "<div class='Translations'>English: <a target='_blank' href='https://translate.google.com/?sl=en&tl=es&text=" + encodeURI($selectedtrans.English) + "&op=translate'>" +
    $selectedtrans.English + "</a><br />Spanish: <a target='_blank' href='https://translate.google.com/?sl=en&tl=es&text=" + encodeURI($selectedtrans.English) + "&op=translate'>" +
    $selectedtrans.Spanish + "</a><br />French: <a target='_blank' href='https://translate.google.com/?sl=en&tl=fr&text=" + encodeURI($selectedtrans.English) + "&op=translate'>" + 
    $selectedtrans.French + "</a><br /></div>" + 
    "<br /> <a target='_blank' href='DeleteWidget.php?RecID=" + $selectedtrans.RecID + "'>Delete Entry</a><a target='_blank' style='margin-left: 15px;' href='EditExistingItem.php?RecID=" + $selectedtrans.RecID + "'>Edit Entry</a><br /> <a target='_blank' style='margin-left: 15px;' href='ManageEntries.php' >Manage Entries</a> <a href='.'>Refresh</a>";
    document.getElementById("content").innerHTML = $content;
    } loadtranslation();setInterval(loadtranslation,6500);}