<?php

$dbhost = "127.0.0.1";   // mysql server -- maybe change this
$dbuser = "root";        // mysql user -- change this
$dbpass = "marcia";      // mysql password -- change this
$dbname = "sympoll";     // mysql database (this is the default) 

// sympoll will attempt to discover the web url to its directory.
// if for some reason the path it discovers is incorrect (which
// will happen under certain web server configurations) simply
// uncomment the line below and fill in the complete url path
// to the sympoll directory, WITH AN ENDING SLASH. to uncomment
// the line, simply delete the two slashes to the very left of the.
// line.  i recommend keeping this line commented unless you are
// having problems with this.
// $urlpath = "http://www.mydomain.com/sympoll/";


// background, text and link colors used in the <BODY> tag
// can now be customized in the file:  includes/header.php3

// the text and background colors in tables.
// inner_bg is used mainly in the results page.
$symp_table_tx = "#000000";
$symp_table_bg = "#dddddd";
$symp_table_inner_bg = "#bbbbbb";
$symp_table_border = "#000000";

// customizations for the header in voting booth <TABLE>
// as well as booth width and font size.
$booth_htx = "#ffffaa";
$booth_hbg = "#000066";
$booth_fontsize = 2;

// width of the voting booth (minimum of 100)
$booth_width = 250;


// the image to use for the bars, and the scaled width of the image.
// there are several included bars in the images/ directory
$bar_image = "images/orange.jpg";
$bar_width = 12;


// in admin.php3, max number of options when addeding/editing a poll
$max_options = 15; 


// cookies are used to keep track of which polls a users has already 
// voted in.  this value is used to set how many days the cookie will 
// last, measured in DAYS.  it's good to not set this to a huge number
$cookie_expire = 30;



// RESERVED FOR INTERNAL USE.  PLEASE DO *NOT* EDIT ANYTHING BELOW THIS LINE
$version = "0.1.99";

?>
