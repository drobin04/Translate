function loadSQLjs() {

  const scriptCode = localStorage.getItem('SQLjs');
  
  eval(scriptCode);
  
  }
  
  
  
  if (localStorage.getItem("translations") == null) {
      window.location.href = 'downloaddb_manual.php';
  } else {
      var db = new SQL.Database();
      var $translations = JSON.parse(localStorage.getItem("translations"));
  
      var table_create_query = "CREATE TABLE IF NOT EXISTS translations (English TEXT, Spanish TEXT, French TEXT, Hindi TEXT, viewcount INTEGER DEFAULT 0);";
      db.run(table_create_query);
  
      for (var i = 0; i < $translations.translations.length; i++) {
          var translation = $translations.translations[i];
          var insert_query = "INSERT INTO translations (English, Spanish, French, Hindi, viewcount) VALUES (?, ?, ?, ?, ?);";
          db.run(insert_query, [translation.English, translation.Spanish, translation.French, translation.Hindi, translation.viewcount || 0]);
      }
  
      function loadtranslation() {
          // Select a random translation from the database
          let select_query = "SELECT English, Spanish, French, Hindi, viewcount FROM translations ORDER BY RANDOM() LIMIT 1";
          let results = db.exec(select_query);
          if (results.length > 0) {
              //console.log(results);
            let row = results[0].values[0];
            //console.log(row);
            // Update the view count for the selected translation
            let viewcount = row[4] || 0;
            viewcount++;
            let update_query = "UPDATE translations SET viewcount = ? WHERE English = ?";
            db.run(update_query, [viewcount, row[0]]);
            
            // Display the selected translation on the screen
            let content = `
    <div class='Translations'>
      English: <a target='_blank' href='https://translate.google.com/?sl=en&tl=es&text=${encodeURI(row[0])}&op=translate'>${row[0]}</a><br />
      Spanish: <a target='_blank' href='https://translate.google.com/?sl=en&tl=es&text=${encodeURI(row[0])}&op=translate'>${row[1]}</a><br />
      French: <a target='_blank' href='https://translate.google.com/?sl=en&tl=fr&text=${encodeURI(row[0])}&op=translate'>${row[2]}</a>
    </div>
    <br />
    <a href="#" id="refresh-link">Refresh</a>
    <a href="downloaddb_manual.php">Update DB</a>
    <a target="_blank" href="https://docs.google.com/spreadsheets/d/1CKgSmeCu5zLx4VHbxm0jGZ4EXzAo8GrjXjpknMakIH0/edit#gid=0">Edit Translations</a>
    <br />Viewed ${row[4]} times.
  `;
  document.getElementById("content").innerHTML = content;
  document.getElementById("refresh-link").addEventListener("click", function(event) {
    event.preventDefault();
    loadtranslation();
  });
  saveTranslations();
  }
  };
  function saveTranslations() {
      let select_query = "SELECT English, Spanish, French, Hindi, viewcount FROM translations";
      let results = db.exec(select_query);
      let translations = results[0].values.map((value) => {
        return {
          "English": value[0],
          "Spanish": value[1],
          "French": value[2],
          "Hindi": value[3],
          "viewcount": value[4]
        };
      });
  //  console.log(JSON.stringify({"translations": translations}));
      localStorage.setItem("translations", JSON.stringify({"translations": translations}));
    }
    
  function getSQLjs() {
  
  const url = 'https://cdnjs.cloudflare.com/ajax/libs/sql.js/0.5.0/js/sql.js';
  const key = 'SQLjs';
  
  const scriptCode = localStorage.getItem(key);
  
  if (scriptCode) {
    const scriptBlob = new Blob([scriptCode], { type: 'text/javascript' });
    const scriptURL = URL.createObjectURL(scriptBlob);
    const scriptElement = document.createElement('script');
    scriptElement.src = scriptURL;
    document.head.appendChild(scriptElement);
  } else {
    fetch(url)
      .then(response => response.text())
      .then(scriptCode => {
        localStorage.setItem(key, scriptCode);
        console.log('JavaScript code stored in LocalStorage');
        const scriptBlob = new Blob([scriptCode], { type: 'text/javascript' });
        const scriptURL = URL.createObjectURL(scriptBlob);
        const scriptElement = document.createElement('script');
        scriptElement.src = scriptURL;
        document.head.appendChild(scriptElement);
      })
      .catch(error => console.error(error));
  }
  
  }
  
  
  
  }
  
  
  loadtranslation();
  setInterval(loadtranslation, 8000);