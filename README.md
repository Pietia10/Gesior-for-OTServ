Changes from 1.0.0:
Credits goes to gesior and some fixes to make it work with otserv to me.

IF you want to develop it msg me on otland.net nick Pietia10.

- Fixed PayPal script. Now it works. Instruction how to use is at end of that post.
- Fixed guild image in 'Top Guilds' on 'latest news' page. Now it shows logo of guild.
- Version for OTServ 0.6.3 all versions.

GESIOR 2012 for OTServ 0.6.3/0.6.4 branch legacy.
Version 1.0.2

This is old version of Gesior acc. maker, but:
- POT replaced to my classes
- all bugs fixed (all possible XSS/SQL-injection attacks blocked), only account 1 (admin: page_access = 3 in table 'accounts' in database) can modify content of site [write news with HTML]
- ALL SQL queries rewritten
- works with MySQL and SQLite databases (you can also try PgSQL, but I did not test that version)
- forum integrated with news (only admin can create thread on forum on board 'News', threads content is visible on 'latestnews')
- it shows skull, flag and outfit of players
- it auto-detect flag by IP of player (doesn't have to select when create account/can't lie)
- installation script is available only to IP which is in file 'install.txt' - you can install it on dedic and players can't change password to account 1

- installed payments systems:
- - - ZayPay - international SMS and phone calls (my script uses 'ZayPay Payalogues', not like old 'zaypay' system available on otland, you must search in google how it works and how to config)
- - - PayPal - credit cards
- - - DotPay - polish sms and bank transfers
I will not write how to config it. If you don't understand, you don't deserve money!
Config of payment systems is in folder 'custom_scripts' and in file 'pages/buypoints.php'.
Remember to set folders in 'custom_scripts' writeable to make these systems work fine!
[ABOUT PAYPAL YOU CAN READ MORE AT END OF THAT POST]

To turn on/off installation create/remove file 'install.txt' in main folder (with your IP inside it).

Links:
Gesior ACC for OTserv 0.6.3 and older:
Download attachment at the bottom.

Additional Scripts:
(download all files in .zip, press ZIP at top of site)
https://github.com/gesior/Gesior2012_Additional_Scripts - some extra scripts which will let you host items/outfits/flags images on your own server, links to folders with outfits, items and flags images you set in config/config.php, by default acc. maker use by server ots.me

What is what in file config/config.php (for TFS 0.2.X versions you must ignore 'multiworld' things, use BRAIN to compare your config.php with examples):
http://otland.net/f479/configuration-gesior2012-config-php-file-description-172012/

How to install shop script on your TFS [for 0.3.6/0.4] and HOW TO ENABLE SHOP ON WEBSITE:
http://otland.net/f479/gesior2012-items-shop-installation-administration-170654/

If you host it on linux remember to set rights to acc. maker folder that allow PHP to write/delete files of account maker!

----------------------------------------------------------
Old scripts (from old 'gesior') are almost compatible with new version. One of changes are class names. In old it was (ex.): 'OTS_Account', now it's 'Account', so 'new OTS_Account()' must be 'new Account()' for new version.
----------------------------------------------------------
Old LAYOUTS are also compatible (~90% of them). Message me if your old layout doesn't work. I can fix it in one minute.
----------------------------------------------------------
'pages' from 0.3.6 and 0.4 branches are compatible. Versions 0.2.x have less pages [houses page not ready yet, top fraggers removed, top guilds in news removed etc.] and 'pages' are not compatible with other versions, because there is no 'multiworld' in TFS 0.2.
----------------------------------------------------------

Report bugs / problems with old not working scripts (and layouts) to me by OTland private message:
[OTLAND]SEND PRIVATE MESSAGE TO Pietia :cool:

About PayPal
1. Config of payments (amount of money, points, your paypal e-mail) is in:
custom_scripts/paypal/config.php
2. There is:
Code:
$paypal_report_url = 'http://anderion.net/paypal_report.php';
Change anderion.net to your domain (+folder if acc. maker is in some folder) and leave /paypal_report.php, don't change to /pages/paypal_report.php
3. Remember to make 'reported_ids' folder writeable to make acc. maker add points for payments (on linux: chmod -R 777 /var/www/custom_scripts [if acc. maker is in /var/www/):
custom_scripts/paypal/reported_id/
4. DO NOT EDIT/CONFIGURE ANYTHING ON PAYPAL.COM, acc. maker 'tells' PayPal how to report payment. You can't turn on IPN on paypal.com - it blocks script. You just need registered account and good config of script in acc. maker to make PayPal donations work.
