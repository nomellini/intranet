
ooooooooooooooo
O = SYMPOLL = O
ooooooooooooooo

Sympoll is a voting package written in PHP that utilizes MySQL.  
Written by David Raeman (Ralusp), ralusp@mail.com, http://www.ralusp.net

Security system used in administration was originally written by John Donagher
(john@webmeta.com, http://phpminiauth.webmeta.com) and has been modified by 
Robert "Longwalker" Brim (longwlkr@maxgaming.net, http://www.maxgaming.net) 
and David Raeman.  Heavily modified and used here with permission.


********************************************************************************
*** BE SURE TO AT LEAST READ THE IMPORTANT NOTES AT THE BOTTOM OF THIS FILE! ***
********************************************************************************

INSTALL PROCESS:

Step 0)
Be sure you have PHP3 or PHP4 (http://www.php.net) installed and working 
correctly.  Also, have access to a MySQL database (http://www.mysql.com) 
somewhere.

Step 1)
Set up the necessary MySQL database that is used to store poll information.
A file is included, sympoll.mysql, to help with this.  An example of how to 
use this file is below.  Replace <user> with your MySQL user name.  Keep in
mind that this may be different than your login for the operating system.
This assumes you are in the same directory as the sympoll.mysql file:

mysqladmin -u<user> -p create sympoll
mysql -u<user> -p sympoll < sympoll.mysql


Step 2)
Make sure you have a mysql user set up that will work with this script.
these are the minimum privileges needed:  SELECT, INSERT, UPDATE, and DELETE.
To simplify upgrading in the future, it's also highly recommened to grant
ALTER privileges to this user as well.  If you do not grant ALTER privileges,
you may not be able to upgrade to future versions of Sympoll.

Step 3)
Place the entire Sympoll directory somewhere in your web path. 

Step 4)
Edit the config file, which can be found in the includes/ directory.
Comments should help guide you through the options.  Optionally, you
may also edit the files header.php3 and footer.php3 in the includes/
directory to suit your needs.  header.php3 will be included at the top
of the results page and the poll list page, and footer.php3 will be
included at the bottom of those two pages.  It is not recommended that
you remove any of the existing default lines, since most of them are there
for a reason.  It's best to only add to these two files.  Of course, you 
are free to do whatever you wish with them.

Step 5)
You may rename admin.php3 to ANY valid filename with a php3 extension
if you wish.  It is recommended as an extra security measure, but it
is not required.  Load that page in your web browser.  It will ask you to 
login.  If this is your first time loading this page, simply click the 
button without entering anything in the text fields.  Sympoll will detect 
that an admin account does not exist and it will prompt you to create one.
Once this account is created you can log in using it.  Note that once you 
create your admin account, clicking the authenticate button will generate 
an Invalid Login error unless the correct information is specified. 

Step 6)
From here, you can create/delete/modify/reset polls. Toggling 
the visibility will turn a poll on and off.  When a poll is off, the booth
cannot be displayed, votes cannot be tallied, and it doesn't show up on
the poll list.  But it stays in the database, and can be turned on again. 
When polls are created, they default to being OFF.


********************
IMPORTANT NOTES!!
********************

Note 1)
Upon putting Sympoll in your web path, be sure to browse to the admin page
before leaving it alone.  The first time you visit the admin page you will
be able to create your admin account.  If somebody else visits it first
before you, they will get to create the admin account.  =P

Note 2)
polllist.php3 is the only file included that is intended to be directly
linked to.  It is a list of all polls that are turned on, and allows
users to vote in any of them.  All other files will not work correctly
when linked to with an <A HREF> tag, and are used internally by Sympoll.

Note 3)
After creating or editing a poll, you'll notice that it gives instructions
on how to embed that particular poll in a web page.  Note that you do not 
HAVE to embed polls in webpages.  That's only if you want them to show up 
mixed in with your other pages, like your opening page or something.  All 
polls toggled on will automagically show up in polllist.php3 regardless.

Note 4)
When you are logged into the admin page, if somebody else logs in it will
unauthenticate you and return you to the login screen.  Then, when you try
to log back in, it will unauthenticate them.  This is because of the strict
authentication that Sympoll uses.  In future a release multiple admin accounts
with various levels of permissions will be supported.

Note 5)
In addition to embedding a specific poll in a web page (instructions
will be provided after modifying a poll in the admin page), it is also
possible to display a RANDOM poll or to have it always display the LATEST
poll, with it always showing the poll with the most recent timestamp.  To 
do so, insert the appropriate code snippet from below.  Also, be sure that 
you always have at least one poll created and visible (toggled ON) is you 
plan on using either of these:

<?php require '/path/given/by/admin/booth.php3';
random_booth(); ?>


<?php require '/path/given/by/admin/booth.php3';
newest_booth(); ?>

</a>