# Creating a new theme
This guide explains how to create a new theme in PortfolioCMS for your portfolio.
<!-- START doctoc generated TOC please keep comment here to allow auto update -->
<!-- DON'T EDIT THIS SECTION, INSTEAD RE-RUN doctoc TO UPDATE -->
**Table of Contents**

- [Creating an theme folder](#creating-an-theme-folder)
- [Creating pages](#creating-pages)
- [Rendering portfolio data](#rendering-portfolio-data)
  - [Portfolio object](#portfolio-object)
  - [Student](#student)
  - [JobExperience](#jobexperience)
  - [Language](#language)
  - [Training](#training)
  - [SLBAssignment](#slbassignment)
  - [Image](#image)
  - [Skill](#skill)
  - [Hobby](#hobby)
  - [Request object](#request-object)
  - [ParameterContainer](#parametercontainer)
  - [Session](#session)
  - [FilesContainer](#filescontainer)
  - [$portfolio data](#portfolio-data)

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
of the return type of the method. To echo data stored in the `$portfolio` that are objects or arrays, scroll down and look for the exlanation from 
that object. To output string data you can use: 
```php
<!DOCTYPE html>
<html>
    <head>
        <!-- Getting the page title from the $portfolio. -->
        <title><?php echo $portfolio->getTitle(); ?></title>
        
        <!-- Optionally you can use the php shorthand tags, this code is the exact equivalent of the line above. -->
        <title><?= $portfolio->getTitle() ?></title>
    </head>
    <body>

    </body>
</html>
```
* `$portfolio->getTitle() : string` Returns the page title from the `Portfolio( title )` database entity.
* `$portfolio->getBaseUrl() : string` Returns the current base url like: `http://146.185.141.142/portfoliocms/web/`.
* `$portfolio->getUrl() : string` Returns the full current url the like: `http://146.185.141.142/portfoliocms/web/portfolio/joris`.
* `$portfolio->getPortfolioPath() : string` Returns the path to the portfolio like `/portfolio/joris`. 
* `$portfolio->getPagePath() : string` Returns  the path to the page like: `/portfolio/joris` or `/portfolio/joris/slbo_prachten`.
* `$portfolio->getRequest() : HttpRequest` Returns the current `HttpRequest()` object, scroll down for more information about the `HttpRequest()` object.
* `$portfolio->getGetGrade() : string` Returns the grade from the `Portfolio( grade )` database entity.
* `$portfolio->getGetStudent() : Student()` Returns an `Student()` object containing the data about the user, scroll down for info about the `Student()` object.
* `$portfolio->getGetJobExperiences() : array` Returns an array containing `JobExperience()` objects, scroll down for info about the `JobExperience()` object.

* `$portfolio->getGetLanguages() : array` Returns an array containing `Language()` objects, scroll down for info about the `Language()` object.
* `$portfolio->getTrainings() : array` Returns an array containing `Training()` objects, scroll down for info about the `Training()` object.
* `$portfolio->getSLBAssignments() : array` Returns an array containing `SLBAssignment()` objects, scroll down for info about the `SLBAssignment()` object.
* `$portfolio->getGalleryImages() : array` Returns an array containing `Image()` objects, scroll down for more info about the `Image()` object.
* `$portfolio->getSkills() : array` Returns an array containing `Skill()` objects, scroll down for more info about the `Skill()` object.
* `$portfolio->getHobbies() : array` Returns an array containing `Hobby()` objects, scroll down for more info about the `Hobby()` object.
* `$portfolio->getUser() : User` Returns the current authenticated user object, scroll down for more info about the `User()` object.

### Student
This list below shows an list of the methods the `Student()` object has.It also shows the return types of the methods. notice that
when you use the methods in your portfolio you don't type `: string ` or `: array` behind the method call, this is just for clarification
of the return type of the method. you can get data from the student from either saving the student an in variable and then accessing its 
methods like:
```php
<?php 
$student = $portfolio->getStudent();
echo $student->getSomeProperty();
?>
```
Or by accessing it it directly from the portfolio object like:
```php
<?php
echo $portfolio->getStudent()->getSomeProperty();
?>
// Or for the php shorthand echo, which is more elegant when outputting data inline:
<?= $portfolio->getStudent()->getSomeProperty() ?>
// The short hand is the exact eqelevan of the code above just shorter.
```
I wont type `$portfolio->getStudent()` in front of every method for convenience just `$s` but in your template you should first receive the request or use it 
like described above.
* `$s->getFirstName(): string` Returns the first name of the student.
* `$s->getLastName: string` Returns the last name of the student.
* `$s->getEmail(): string` Returns the email address of the student.
* `$s->getDateOfBirth(): DateTime()` Returns the date of birh of the student in an `Datetime` object. 
* `$s->getStreet(): string` Returns the street where the student lives.
* `$s->getAddress(): string` Returns the house number where the student lives.
* `$s->getPlace: string` Returns the city where the student lives.
* `$s->getZipCode: string` Returns the zip code from the student.
* `$s->getPhoneNumber(): string` Returns the phone number of the student.
* `$s->getStudentCode(): string` Returns the Stenden student code from the student.

### JobExperience
This list below shows an list of the methods the `JobExperience()` object has.It also shows the return types of the methods. notice that
when you use the methods in your portfolio you don't type `: string ` or `: array` behind the method call, this is just for clarification
of the return methods type. Also notice that the method returns an array with the JobExperiences objects. you can get data from the 
JobExperience from either saving the job experiences an in variable and then accessing its methods like:
```php
<?php 
$jobExperiences = $portfolio->getJobExperiences();

// Its an array so you can loop through it and access the JobExperience poreperties.
foreach( $jobExperiences as $jobExperience )
{
    echo $jobExperience->getSomeProperty();
}
?>
```
Or by accessing it it directly from the portfolio object like:
```php
<?php
// Its an array so you need to use [] brackets with an index key to access it directly. 
echo $portfolio->getjobExperiences()[0]->getSomeProperty();
?>
// Or for the php shorthand echo, which is more elegant when outputting data inline:
<?= $portfolio->getLanguages()[0]->getSomeProperty() ?>
// The short hand is the exact eqelevan of the code above just shorter.
```
I wont type `$portfolio->getJobExperiences()[0]` in front of every method for convenience just `$j` but in your template you should first receive the request or use it 
like described above.
`$j->getId(): int` returns the id given by the database.
`$j->getStartedAt(): DateTime` Returns an `DateTime()` object with the start date or `NULL`.
`$j->getEndedAt(): DateTime` Returns an `DateTime()` object with the end date or `NULL`.
`$j->description(): string` Returns an description about the job experience.
`$j->isInternship(): bool`
### Language
This list below shows an list of the methods the `Language()` object has.It also shows the return types of the methods. notice that
when you use the methods in your portfolio you don't type `: string ` or `: array` behind the method call, this is just for clarification
of the return methods type. Also notice that the method returns an array with the Language objects. you can get data from the 
Language from either saving the languages an in variable and then accessing its methods like:
```php
<?php 
$languages = $portfolio->getLanguages();

// Its an array so you can loop through it and access the Language poreperties.
foreach( $languages as $language )
{
    echo $language->getSomeProperty();
}
?>
```
Or by accessing it it directly from the portfolio object like:
```php
<?php
// Its an array so you need to use [] brackets with an index key to access it directly. 
echo $portfolio->getLanguages()[0]->getSomeProperty();
?>
// Or for the php shorthand echo, which is more elegant when outputting data inline:
<?= $portfolio->getLanguages()[0]->getSomeProperty() ?>
// The short hand is the exact eqelevan of the code above just shorter.
```
I wont type `$portfolio->getLanguages()[0]` in front of every method for convenience just `$l` but in your template you should first receive the request or use it 
like described above.

### Training
This list below shows an list of the methods the `Training()` object has.It also shows the return types of the methods. notice that
when you use the methods in your portfolio you don't type `: string ` or `: array` behind the method call, this is just for clarification
of the return methods type. Also notice that the method returns an array with the Training objects. you can get data from the 
Training from either saving the trainings an in variable and then accessing its methods like:
```php
<?php 
$trainings = $portfolio->getTrainings();

// Its an array so you can loop through it and access the Training poreperties.
foreach( $trainings as $training )
{
    echo $training->getSomeProperty();
}
?>
```
Or by accessing it it directly from the portfolio object like:
```php
<?php
// Its an array so you need to use [] brackets with an index key to access it directly. 
echo $portfolio->getTrainings()[0]->getSomeProperty();
?>
// Or for the php shorthand echo, which is more elegant when outputting data inline:
<?= $portfolio->getTrainings()[0]->getSomeProperty() ?>
// The short hand is the exact eqelevan of the code above just shorter.
```
I wont type `$portfolio->getTrainings()[0]` in front of every method for convenience just `$t` but in your template you should first receive the request or use it 
like described above.

### SLBAssignment
This list below shows an list of the methods the `SLBAssignment()` object has.It also shows the return types of the methods. notice that
when you use the methods in your portfolio you don't type `: string ` or `: array` behind the method call, this is just for clarification
of the return methods type. Also notice that the method returns an array with the SLBAssignments objects. you can get data from the 
SLBAssignment from either saving the SLB assignments an in variable and then accessing its methods like:
```php
<?php 
$slbAssignments = $portfolio->getSLBAssignments();

// Its an array so you can loop through it and access the SLBAssignment poreperties.
foreach( $slbAssignments as $slbAssignment )
{
    echo $slbAssignment->getSomeProperty();
}
?>
```
Or by accessing it it directly from the portfolio object like:
```php
<?php
// Its an array so you need to use [] brackets with an index key to access it directly. 
echo $portfolio->getSLBAssignments()[0]->getSomeProperty();
?>
// Or for the php shorthand echo, which is more elegant when outputting data inline:
<?= $portfolio->getSLBAssignments()[0]->getSomeProperty() ?>
// The short hand is the exact eqelevan of the code above just shorter.
```
I wont type `$portfolio->getSLBAssignments()[0]` in front of every method for convenience just `$s` but in your template you should first receive the request or use it 
like described above.

### Image
This list below shows an list of the methods the `Image()` object has.It also shows the return types of the methods. notice that
when you use the methods in your portfolio you don't type `: string ` or `: array` behind the method call, this is just for clarification
of the return methods type. Also notice that the method returns an array with the Images objects. you can get data from the 
Image from either saving the skill an in variable and then accessing its methods like:
```php
<?php 
$images = $portfolio->getGalleryImages();

// Its an array so you can loop through it and access the Image poreperties.
foreach( $images as $image )
{
    echo $image->getSomeProperty();
}
?>
```
Or by accessing it it directly from the portfolio object like:
```php
<?php
// Its an array so you need to use [] brackets with an index key to access it directly. 
echo $portfolio->getGalleryImages()[0]->getSomeProperty();
?>
// Or for the php shorthand echo, which is more elegant when outputting data inline:
<?= $portfolio->getGalleryImages()[0]->getSomeProperty() ?>
// The short hand is the exact eqelevan of the code above just shorter.
```
I wont type `$portfolio->getGalleryImages()[0]` in front of every method for convenience just `$i` but in your template you should first receive the request or use it 
like described above.

### Skill
This list below shows an list of the methods the `Skill()` object has.It also shows the return types of the methods. notice that
when you use the methods in your portfolio you don't type `: string ` or `: array` behind the method call, this is just for clarification
of the return methods type. Also notice that the method returns an array with the Skill objects. you can get data from the 
Skill from either saving the skill an in variable and then accessing its methods like:
```php
<?php 
$skills = $portfolio->getSkills();

// Its an array so you can loop through it and access the Skill poreperties.
foreach( $skills as $skill )
{
    echo $skill->getSomeProperty();
}
?>
```
Or by accessing it it directly from the portfolio object like:
```php
<?php
// Its an array so you need to use [] brackets with an index key to access it directly. 
echo $portfolio->getSkills()[0]->getSomeProperty();
?>
// Or for the php shorthand echo, which is more elegant when outputting data inline:
<?= $portfolio->getSkills()[0]->getSomeProperty() ?>
// The short hand is the exact eqelevan of the code above just shorter.
```
I wont type `$portfolio->getSkills()[0]` in front of every method for convenience just `$s` but in your template you should first receive the request or use it 
like described above.

### Hobby
This list below shows an list of the methods the `Hobby()` object has.It also shows the return types of the methods. notice that
when you use the methods in your portfolio you don't type `: string ` or `: array` behind the method call, this is just for clarification
of the return methods type. Also notice that the method returns an array with the Hobby objects. you can get data from the 
Hobby from either saving the hobby an in variable and then accessing its methods like:
```php
<?php 
$hobby = $portfolio->getHobbies();

// Its an array so you can loop through it and access the Hobby poreperties.
foreach( $hobbys as $hobby )
{
    echo $hobby->getSomeProperty();
}
?>
```
Or by accessing it it directly from the portfolio object like:
```php
<?php
// Its an array so you need to use [] brackets with an index key to access it directly. 
echo $portfolio->getHobbies()[0]->getSomeProperty();
?>
// Or for the php shorthand echo, which is more elegant when outputting data inline:
<?= $portfolio->getHobbies()[0]->getSomeProperty() ?>
// The short hand is the exact eqelevan of the code above just shorter.
```
I wont type `$portfolio->getHobbies()[0]` in front of every method for convenience just `$h` but in your template you should first receive the request or use it 
like described above.

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

### ParameterContainer
This list below shows an list of the methods the `ParameterContainer()` object has.It also shows the return types of the methods. notice that
when you use the methods in your portfolio you don't type `: string ` or `: array` behind the method call, this is just for clarification
of the return type of the method. you can get data from the ParameterContainer from either saving the parameter container an in variable and then 
accessing its methods like:
```php
<?php 
// The request has manny methods that return an ParameterContainer so this applies to all of the methods that return one.
$parameterContainer = $portfolio->getRequest->getSomethingThatReturnsParameterContainer();

echo $parameterContainer->get( $keyOfParameter, $defaultReturnType = NULL );
// Notice that the $defaultReturnType is an optional parameter so you don't have to supplly it so you can also use:
echo $parameterContainer->get( $keyOfParameter );

// A parameter container implements the \ArrayAccess interface so you can use it like an array:
echo $parameterContainer[ $keyOfParameter ];

// Also because it implements the \Iterator interface you can use it in foreach loop like:
foreach( $portfolio->getRequest->getSomethingThatReturnsParameterContainer() as $parameterKey => $parameterValue )
{
    echo "The key: " . $parameterKey . " Holds the value: " . $parameterValue;
}
?>
```
Or by accessing it it directly from the portfolio object like:
```php
<?php
echo $portfolio->getRequest()->getSomethingThatReturnsParameterContainer()->get( $keyOfParameter );
?>

// Or for the php shorthand echo, which is more elegant when outputting data inline:
<?= $portfolio->getRequest()->getSomethingThatReturnsParameterContainer()->get( $keyOfParameter ); ?>
// The short hand is the exact eqelevan of the code above just shorter.
```
I wont type `$portfolio->getRequest()->getSomethingThatReturnsParameterContainer();` in front of every method for convenience just `$p` but in your template you should first receive the request or use it 
like described above.
