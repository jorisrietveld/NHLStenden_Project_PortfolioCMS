# installing the CMS
This guide will help you to setup the CMS. It will show the requirements
and some basic configuration for the webserver.

## Requirements:
* PHP >= 7
* PHP driver PDO MySQL
* PHP module mcrypt
* PHP module curl
* NGINX or Apache
* Mysql Server >= 5.5
* Composer
* *(optional)* PHPUnit for unit testing.
* *(optional)* Brower for asset management.

## Setting up the webserver

### Nginx
If you use Nginx as webserver you have to setup url rewriting for the urls otherwise you will always get an 404 route.
Below is the minimal Nginx virtual host configuration you should replace the {path_to_project_root} with the absolute
path to the PortefolioCMS root directory and {the_hostname_of_your_server} with the your domain name.

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
}
```

### Apache
todo write documentaion for configuring apache.

## Setting up the database
The directory Install contains an SQL script that you should import into your database.
Also you should edit the database connection configuration in config/config.xml