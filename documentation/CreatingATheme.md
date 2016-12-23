# Creating a new theme
This guide explains how to create a new theme in PortfolioCMS for your portfolio.
<!-- START doctoc generated TOC please keep comment here to allow auto update -->
<!-- DON'T EDIT THIS SECTION, INSTEAD RE-RUN doctoc TO UPDATE -->
**Table of Contents**

- [Creating an theme folder](#creating-an-theme-folder)
- [Creating pages](#creating-pages)
- [Rendering portfolio data](#rendering-portfolio-data)
  - [Portfolio object](#portfolio-object)
  - [Request object](#request-object)
  - [TODO create much more documentation](#todo-create-much-more-documentation)
  - [$portfolio data](#portfolio-data)
  - [Using portfolio data](#using-portfolio-data)

<!-- END doctoc generated TOC please keep comment here to allow auto update -->

## Creating an theme folder
To create a new theme you first have to create a new theme folder located in `src/PortfolioCMS/Themes/{name of your theme}`.  
Inside this folder you can add the folders css, js and images for your assets. 

## Creating pages
In an theme you can add your theme pages. The pages need to be `.php` pages and the pages also need to be registered in the database
so the template engine knows what to render for your portfolio. Its advised to use CDN networks for your external asset libraries like
bootstrap, jquery etc. 

On every page you have access to data from the database through the `Portfolio()` object. this object has a few methods for receiving data
from the database. The framework will handle the communication to the database and fetches the database entities into PHP objects.

## Rendering portfolio data
To render portfolio data in your theme you use the `Portfolio()` object to fetch data, the `Portfolio()` object is stored in the variable
`$portfolio` witch will be accessible in your theme when the template engine renders the templates (theme files).

### Portfolio object
The list below shows an list of methods the `Portfolio()` object has. It also shows the return types of the methods. notice that
when you use the methods in your portfolio you don't type `: string ` or `: array` behind the method call, this is just for clarification
of the return type of the method.
* `$portfolio->getTitle() : string` This method returns an string containing the page title from the `Portfolio( title )` database entity.
* `$portfolio->getBaseUrl() : string` This method returns an string containing the current base url like: `http://146.185.141.142/portfoliocms/web/`.
* `$portfolio->getUrl() : string` This method returns an string containing the full current url the like: `http://146.185.141.142/portfoliocms/web/portfolio/joris`.
* `$portfolio->getPortfolioPath() : string` This method returns an string containing the path to the portfolio like `/portfolio/joris`. 
* `$portfolio->getPagePath() : string` This method returns an string containing the path to the page like: `/portfolio/joris` or `/portfolio/joris/slbo_prachten`.
* `$portfolio->getRequest() : HttpRequest` This method returns the current `HttpRequest()` object, scroll down for more information about the `HttpRequest()` object.
* `$portfolio->getGetGrade() : string` This method returns an string containing the grade from the `Portfolio( grade )` database entity.
* `$portfolio->getGetStudent() : Student()` This method returns an `Student()` object containing the data about the user, scroll down for information about the `Student()` object.
* `$portfolio->getGetJobExperiences() : array` This method returns an array containing `JobExperience()` objects, scroll down for information about the `JobExperience()` object.
* `$portfolio->getGetLanguages() : array` This method returns an array containing `Language()` objects, scroll down for information about the `Language()` object.
* `$portfolio->getTrainings() : array` This method returns an array containing `Training()` objects, scroll down for information about the `Training()` object.
* `$portfolio->getSLBAssignments() : array` This method returns an array containing `SLBAssignment()` objects, scroll down for information about the `SLBAssignment()` object.
* `$portfolio->getGalleryPictures() : array` This method returns an array containing `Image()` objects, scroll down for more information about the `Image()` object.
* `$portfolio->getSkills() : array` This method returns an array containing `Skill()` objects, scroll down for more information about the `Skill()` object.
* `$portfolio->getHobbies() : array` This method returns an array containing `Hobby()` objects, scroll down for more information about the `Hobby()` object.

### Request object
This list below shows an list of the methods the `HttpRequest()` object has.It also shows the return types of the methods. notice that
when you use the methods in your portfolio you don't type `: string ` or `: array` behind the method call, this is just for clarification
of the return type of the method. you can get data from the request from either saving the request an in variable and then accessing its 
methods like:
```php
<?php 
$request = $portfolio->getRequest();
echo $request->getSomeProperty();
?>
```
Or by accessing it it directly from the portfolio object like:
```php
<?php
echo $request = $portfolio->getRequest()->getSomeProperty();
?>
// Or for the php shorthand echo, which is more elegant when outputting data inline:
<?= $portfolio->getRequest()->getSomeProperty() ?>
// The short hand is the exact eqelevan of the code above just shorter.
```
I wont type `$portfolio->getRequest()` in front of every method for convenience just `$r` but in your template you should first receive the request or use it 
like described above.
* `$r->getQueryParams() : ParameterContainer` This method returns an `ParameterContainer()` containing the `$_GET` parameters, scroll down for more information about the `ParameterContainer()` object. 
* `$r->getPostParams(): ParameterContainer` This method returns an `ParameterContainer()` containing the `$_POST` parameters, scroll down for more information about the `ParameterContainer()` object. 
* `$r->getFiles(): FilesContainer` This method returns an `FilesContainer()` containing the `$_FILES` parameters, scroll down for more information about the `FilesContainer()` object. 
* `$r->getServer(): ParameterContainer` This method returns an `ParameterContainer()` containing the `$_SERVER` parameters, scroll down for more information about the `ParameterContainer()` object. 
* `$r->getHeaders(): ParameterContainer` This method returns an `ParameterContainer()` containing the headers from the request, scroll down for more information about the `ParameterContainer()` object. 
* `$r->getCookies(): ParameterContainer` This method returns an `ParameterContainer()` containing the `$_COOKIE` parameters, scroll down for more information about the `ParameterContainer()` object. 
* `$r->getSession(): Session` This method returns an `Session()` object, scroll down for more information about the `Session()` object. 
* `$r->hasSession(): bool` This method returns an `boolean` for checking if the request has an session. 
* `$r->getContent(): string` This method returns an `string` containing the requests body. 
* `$r->getRequestUri(): string` This method returns an `string` containing the request uri like: `/portfolio/joris?bringAn=towel&answerToEverything=42`.
* `$r->getUri(): string` This method returns an `string` containing the full uri like: `http://hostname.nl/portfolio/joris?bringAn=towel&answerToEverything=42`. 
* `$r->getScheme(): string` This method returns an `string` containing the requests scheme like: `http` or `https`.
* `$r->getBasePath(): string` This method returns an `string` containing the base path of the request like: `/portfolio/joris`.
* `$r->getBaseUri(): string` This method returns an `string` containing the base uri like: `http://hostname.nl`.
* `$r->getScriptName(): string` This method returns an `string` containing the name of the script executing the request like: `index.php`.
* `$r->getClientIp(): string` This method returns an `string` containing the clients ip address like: `192.168.1.10`.
* `$r->getServerIp(): string` This method returns an `string` containing the servers ip address like: `141.185.141.142`.
* `$r->getQueryString(): string` This method returns an `string` containing the query string like: `bringAn=towel&answerToEverything=42`.
* `$r->getHostname(): string` This method returns an `string` containing the hostname of the server like: `www.hostname.nl` without the requests scheme and path.
* `$r->getMethod(): string` This method returns an `string` containing the HTTP request method like `GET`, `POST`, `PUT`, `DELETE`, `HEAD`, `TRACE` or `CONNECT`.
* `$r->getUriForPath( $path ): string` This method returns an `string` containing the uri for an path that can be passed as argument, the path `/portfolio/joris` will return something like: `hhttp://hostname.nl/portfolio/joris`.

### TODO create much more documentation

### $portfolio data
Below are the data structures that can be received with the $portfolio variable.

```php
$title = portfolio - joris rietveld

$link = http://146.185.141.142/portfolio/web/portfolio/joris-rietveld

$student [
    firstname,
    lastname,
    email,
    dateOfBirth,
    street,
    address,
    place,
    zipCode,
    place,
]


$JobExperiences [
    0 => JobExperience(
            isInternship() : bool,
            getLocation() :string,
            getStartedAt() : DateTime(),
            getEndedAt() : DateTime(),
            getDescription() : string
    ),
]

$Languages [
    0 => Language(
            getLanguage() : string,
            isNative() : bool,
            getLevel() : int,
    ),
]

$Trainings [
    0 => Training(
            getTitle() : string,
            getInstitution() : string,
            getLocation() : string,
            getStartedAt() : Datetime(),
            getFinishedAt() : DateTime(),
            getDescription() : string,
            getObtainedCertificate() : bool,
            getIsCurrentTraining() : bool,
    )
]

$SlbAssignment [
    0 => SLBAssignment(
            getName() : string,
            getFeedback() : string,
            getFileName() : string,
            getFilePath() : string,
            getMimeType() : string,
    ),
]

$profileImage = Image(
            getFileName() : string,
            getFilePath() : string,
            getMimeType() : string,
            getName() : string,
            getDescription() : string,
);

$galleryImages [
    0 => Image(
            getFileName() : string,
            getFilePath() : string,
            getMimeType() : string,
            getName() : string,
            getDescription() : string,
            getOrder() : int,
    );
]

$Skills [
    0 => Skill(
            getName() : string,
            getLevelOfExperience() : int,
    ),
]

$Hobbies [
    0 => Hobby(
            getName() : string,
    ),
]
```

### Using portfolio data
To use the portfolio data from the database you access the $portfolio variable and call an method to receive data.
So if you want to get the page title use the following code:
```php
<!DOCTYPE html>
<html>
<head>
    <title><?= $portfolio->getTitle() ?></title>
</head>
<body>
</body>
</html>
```
Notice that I used the shorthand php tags <?= 'some string' ?> these tags are the equivalent of typing <?php echo 'some string' ?> just a bit shorter.<br>
To render the languages that the student speaks you can use an foreach loop to output the data. Below an example of rendering all languages.

```php
<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <div id='language-wrapper'>
        <h>I speak the following languages</h>
        <?php
            foreach( $portfolio->getLanguages() as $language )
            {
                echo $language->getLanguage() . '<br>';
                echo 'On level:' . $language->getLevel() . '<br>';
            }
        ?>
    </div>
</body>
</html>
```
