Installation Notes
============


#Encrypted Cookies#

Need to install mcrypt which is 2 steps. 1 is to apt-get it so PHP can have it, the other is to php5enmod enable it so apache sees it also.

<pre>

sudo apt-get install php5-mcrypt
sudo service apache2 restart

mv /etc/php5/conf.d/mcrypt.ini /etc/php5/mods-available/

sudo php5enmod mcrypt
sudo service apache2 restart


#install node:
http://www.hostingadvice.com/how-to/install-nodejs-ubuntu-14-04/

</pre>