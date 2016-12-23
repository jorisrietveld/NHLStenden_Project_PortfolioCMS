# installing the CMS
This guide will help you to setup the CMS. It will show the requirements
and some basic configuration for the webserver.
<!-- START doctoc generated TOC please keep comment here to allow auto update -->
<!-- DON'T EDIT THIS SECTION, INSTEAD RE-RUN doctoc TO UPDATE -->
**Table of Contents** 

- [Requirements: <a name="requirements"></a>](#requirements-a-namerequirementsa)
- [Setting up the webserver <a name="settingUpTheWebserver"></a>](#setting-up-the-webserver-a-namesettingupthewebservera)
  - [Nginx <a name="nginx"></a>](#nginx-a-namenginxa)
  - [Apache <a name="apache"></a>](#apache-a-nameapachea)
- [Setting up the database <a name="database"></a>](#setting-up-the-database-a-namedatabasea)

<!-- END doctoc generated TOC please keep comment here to allow auto update -->

## Requirements: <a name="requirements"></a>
* PHP >= 7 _The minimum PHP version required, the project is written with PHP 7 for speed and to experiment with the new scalar type hints_
* PHP driver PDO MySQL _PHP php data objects driver for communicating with MySQL databases._
* PHP module mcrypt _PHP module for encryption, hashing and other security related stuff._
* PHP module curl _PHP module for making HTTP requests._
* PECL Extension libsodium _PHP C Extension for advanced encryption and hashing._
* NGINX or Apache _The web servers for handling the requests and passing it to the PHP engine._
* Mysql Server >= 5.6.5 _Database software for data storage, database uses DEFAULT CURRENT_TIMESTAMP that was implemented above version 5.6.5_
* *(optional)* Composer _PHP Library for dependency management of external libraries like PHP Unit, DebugBar and others._ 
* *(optional)* PHPUnit _PHP Library For unit testing code._
* *(optional)* Brower _NodeJS Library for javascript and css asset management._

## Setting up the webserver <a name="settingUpTheWebserver"></a>

### Nginx <a name="nginx"></a>
If you use Nginx as webserver you have to setup url rewriting for the urls otherwise you will always get an 404 route.
Below is the minimal Nginx virtual host configuration you should replace the {path_to_project_root} with the absolute
path to the PortfolioCMS root directory and {the_hostname_of_your_server} with the your domain name.

```Nginx
server {
	listen 80;

	root {path_to_project_root}/web;
	index index.php;

	server_name {the_hostname_of_your_webserver};

	location / {
		try_files $uri /index.php$is_args$args;
	}

	location ~ \.php$ {
            fastcgi_param  QUERY_STRING       $query_string;
            fastcgi_param  REQUEST_METHOD     $request_method;
            fastcgi_param  CONTENT_TYPE       $content_type;
            fastcgi_param  CONTENT_LENGTH     $content_length;
            
            fastcgi_param  SCRIPT_NAME        $fastcgi_script_name;
            fastcgi_param  REQUEST_URI        $request_uri;
            fastcgi_param  DOCUMENT_URI       $document_uri;
            fastcgi_param  DOCUMENT_ROOT      $document_root;
            fastcgi_param  SERVER_PROTOCOL    $server_protocol;
            fastcgi_param  REQUEST_SCHEME     $scheme;
            fastcgi_param  HTTPS              $https if_not_empty;
            
            fastcgi_param  GATEWAY_INTERFACE  CGI/1.1;
            fastcgi_param  SERVER_SOFTWARE    nginx/$nginx_version;
            
            fastcgi_param  REMOTE_ADDR        $remote_addr;
            fastcgi_param  REMOTE_PORT        $remote_port;
            fastcgi_param  SERVER_ADDR        $server_addr;
            fastcgi_param  SERVER_PORT        $server_port;
            fastcgi_param  SERVER_NAME        $server_name;
            
            fastcgi_pass unix:/run/php/php7.0-fpm.sock;
	}
	error_log /var/log/nginx/portfoliocms_error.log;
    access_log /var/log/nginx/portfoliocms_access.log;
}
```

### Apache <a name="apache"></a>
If you use Apache as webserver you have to setup url rewriting for the urls otherwise you will always get an 404 route.
Below is the minimal Apache virtual host configuration you should replace the {path_to_project_root} with the absolute
path to the PortfolioCMS root directory and {the_hostname_of_your_server} with the your domain name.

```ApacheConf
<VirtualHost *:80>
    ServerName {the_hostname_of_your_webserver}
    ServerAlias {the_hostname_of_your_webserver}

    DocumentRoot {path_to_project_root}/web;
    <Directory {path_to_project_root}/web>;
        AllowOverride All
        Order Allow,Deny
        Allow from All
        
        # This is for rewriting the URL's so they are more readable.
        # The /web folder also includes an .htaccess that rewrites the urls.
        <IfModule mod_rewrite.c>
            Options +FollowSymlinks
            RewriteEngine On
             RewriteCond %{REQUEST_FILENAME} !-f
             RewriteRule ^(.*)$ index.php [QSA,L]
        </IfModule>
    </Directory>

    ErrorLog /var/log/apache2/portfoliocms_error.log
</VirtualHost>
```

## Setting up the database <a name="database"></a>
The directory Install contains an SQL script `CreateDatabase.sql` that you can import into your database with the MySQL workbench, PHPMyAdmin or some 
other database client
Also you should edit the database connection configuration in config/config.xml