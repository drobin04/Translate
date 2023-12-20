![image](https://i.imgur.com/WSGpr09.png)

# Translate
This tiny applet serves as a vocab building tool.

It cycles between flashcards in different languages to help you remember and practice languages. 

Most importantly, this tool can be embedded as part of other pages! 

There are also links on each of the phrases that take you to Google Translate, where you can hear them pronounced audibly.

## Live Demo

You can access a live demo of this tool [here](https://douglasrobinson.me/Translate_Demo/index.html).

# Features 

## Multiple Storage / Editing Options

For ease of config, you have the following options for maintaining your Translation database: 
* Google Drive Spreadsheet
    * This has the benefit of using the translate() function directly on cells, making entry easier
* SQLite DB
* CSV Entry

# Setup

![setupimage](https://i.imgur.com/nPvxVVJ.png)

## Requirements

WAMP / LAMP stack needed - Apache and PHP. 

If you want to use the SQLite option, you'll need to have sqlite extensions enabled in your PHP environment. 

## Configuration

Set the /db/DB_Provider.txt file to one of the following values: 
* googledrive
* csv
* sqlite
* manual

# Data Entry

## Google Spreadsheet Entry

Either create a copy of the existing spreadsheet [Here](https://docs.google.com/spreadsheets/d/1VFSmZgTInTIyNbycXI2MESVk8l1zNWg8K5uJyxmmGHA/), or create a google sheet of your own.

**Note:** For your own spreadsheet, you need to go to file -> Share, and change the visibility from 'restricted' to 'anyone with the link', that way the app can access it. 

The important part is that you have column headings for English, Spanish, French, and Hindi (these will be looked for by the javascript code).
You do not need to have values in these columns, but the column headers should exist. 

To remove these extra languages / headers, edit the references to them in [index.js](index.js).

## CSV

This one is relatively straightforward, you can just edit the CSV file under the db folder. 

If you are on a machine without MS Office installed, you can download [LibreOffice](https://libreoffice.org) for free (handy on servers) or just use notepad. 

## SQLite

If for some reason you want to use a SQLite database for this, one is included, and there is a ManageEntries.php page that will facilitate viewing the items in the db and adding / editing and removing existing items. There's also a function for automatically translating an entered piece of text from english to other languages using a free API.

## Manual Entry

If you need some other way of generating translations, you can manually enter them into the file [db/translations.txt](db/translations.txt) in JSON format (See example). As long as you have the DB_Provider.txt set to 'manual', they will get loaded from this file without issue. 

This is handy if you're on a webhost that can't connect to the google doc spreadsheet and you want to copy the output from somewhere else, or if you want to have some other functionality accomplish the generation.

