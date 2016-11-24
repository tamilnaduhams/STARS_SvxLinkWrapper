STARS_SvxLinkWrapper - wrapper for SvxLink on Raspberry PI3 Model B
====================================================================
By STARS (Space and Terrenstrial Amateur Radio Society)<tamilnaduhams at gmail dot com>

Features
--------

* Autoconnect to stations on startup, and keep-alive option
* QSO Echolink logger in sqlite3 and a simple web viewer for it
* Send DTMF preset commands from echolink chat

Requirements
------------
1. python
2. python modules:     importlib python-sqlite3
3. Svxlink (1.5.0) ready to run and configured

How to Install all requirements except svxlink
-----------------------------------------------
::
    sudo apt-get install python-sqlite
    sudo apt-get install apache2

How to configure and run SvxLinkWrapper
---------------------------------------
1. sudo nano /home/pi/SVXLinkWrapper/config.ini
   change the following variables as needed in config.ini
   
   #SVXLink path
   SVXLINK_CMD=/usr/local/bin/svxlink
   
   #Your Echolink Callsign and Node
   STATIONS={"VU2POC-R": "764117"}


How to configure SQlite
-------------------------
1. set DATABASE_PATH to the location of EcholinkQsoLog.sqlite
   change the following variables as needed in config.ini
   
   sudo nano /home/pi/SVXLinkWrapper/config.ini

DATABASE_PATH=./EcholinkQsoLog.sqlite
   
2. Make sure the folder that EcholinkQsoLog.sqlite has read/write permissions, as well as the file
3. If you want to view qsos log from a browser you can create virtual directory to `www` in apache2)

