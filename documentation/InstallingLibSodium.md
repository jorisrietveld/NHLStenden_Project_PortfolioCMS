# Installing libsodium-dev
This guide explanes how to install the php libsodium extention for secure encryption and hasing and other security relating stuff.
<!-- START doctoc generated TOC please keep comment here to allow auto update -->
<!-- DON'T EDIT THIS SECTION, INSTEAD RE-RUN doctoc TO UPDATE -->
**Table of Contents**

- [What is libsodium?](#what-is-libsodium)
- [Installing on Ubuntu](#installing-on-ubuntu)
- [Installing on Windows](#installing-on-windows)
- [More info](#more-info)

<!-- END doctoc generated TOC please keep comment here to allow auto update -->

## What is libsodium?
The Sodium crypto library (libsodium) is a modern, easy-to-use software library for encryption, decryption, signatures, password hashing and more.
It is a portable, cross-compilable, installable, packageable fork of NaCl, with a compatible API, and an extended API to improve usability even further.
Its goal is to provide all of the core operations needed to build higher-level cryptographic tools.
Sodium supports a variety of compilers and operating systems, including Windows (with MinGW or Visual Studio, x86 and x64), iOS and Android.
The design choices emphasize security, and "magic constants" have clear rationales.
And despite the emphasis on high security, primitives are faster across-the-board than most implementations of the NIST standards.
copied from there website: [source](https://paragonie.com/book/pecl-libsodium/read/00-intro.md)


## Installing on Ubuntu
On ubuntu >= 15.04 you can use the command:
```bash
apt-get install libsodium-dev
```
For Ubuntu < 15.04
```bash
sudo add-apt-repository ppa:chris-lea/libsodium
sudo apt-get update
sudo apt-get install libsodium-dev
```
After you installed libsodium you have to install the PHP PECL extension to use it in PHP.
To install the PHP PECL extension you need to have the PECL package manager. If you don't have it
search on the internet for an tutorial on installing it.
To install the extension run the following command:
```bash
pecl install libsodium
```
It will install the extension for you now the only thing you have to do is enable it in your php.ini, so add the following line:
```bash
extension=libsodium.so
```
And restart PHP for Ubuntu > 15.04
```bash
systemclt restart service.php7.0-fpm
```
For Ubuntu < 15.04
```bash
service php7.0-fpm restart
```
To check if the extention is loaded you can create an simple php script containing:
```PHP
<?php
 var_dump([
     \Sodium\library_version_major(),
     \Sodium\library_version_minor(),
     \Sodium\version_string()
 ]);
```

## Installing on Windows
To install libsodium on windows you have first to get the appropriate binary. You can get them from [here](http://windows.php.net/downloads/pecl/releases/libsodium/1.0.2/). 
If you don't know what link to choose try: [php_libsodium-1.0.2-7.0-ts-vc14-x64.zip](http://windows.php.net/downloads/pecl/releases/libsodium/1.0.2/php_libsodium-1.0.2-7.0-ts-vc14-x64.zip) its the thread safe 64 bit PHP7 version. <br>
For libsodium for PHP7 Thread safe 32 bit version get the link: [php_libsodium-1.0.2-7.0-ts-vc14-x86.zip](http://windows.php.net/downloads/pecl/releases/libsodium/1.0.2/php_libsodium-1.0.2-7.0-ts-vc14-x86.zip)<br>
For libsodium for PHP7 Non thread safe 32 bit version get the link: [php_libsodium-1.0.2-7.0-nts-vc14-x86.zip](http://windows.php.net/downloads/pecl/releases/libsodium/1.0.2/php_libsodium-1.0.2-7.0-nts-vc14-x86.zip)<br>
For libsodium for PHP7 Non thread safe 64 bit version get the link: [php_libsodium-1.0.2-7.0-nts-vc14-x64.zip](http://windows.php.net/downloads/pecl/releases/libsodium/1.0.2/php_libsodium-1.0.2-7.0-nts-vc14-x64.zip)<br>
After you downloaded the zip extract and copy the php_libsodium.dll to PHP's extension directory. 
Now the only thing you have to do is enable it in your php.ini, so add the following line:
```bash
extension=php_libsodium.dll
```
To check if the extention is loaded you can create an simple php script containing:
```PHP
<?php
 var_dump([
     \Sodium\library_version_major(),
     \Sodium\library_version_minor(),
     \Sodium\version_string()
 ]);
```

## More info
Look at the libsodium site for more info about installing libsodium [here](https://paragonie.com/book/pecl-libsodium/read/00-intro.md)