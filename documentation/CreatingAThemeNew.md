# Creating a new theme
This guide explains how to create a new theme in PortfolioCMS for your portfolio.
<!-- START doctoc generated TOC please keep comment here to allow auto update -->
<!-- DON'T EDIT THIS SECTION, INSTEAD RE-RUN doctoc TO UPDATE -->
**Table of Contents**

- [Creating an theme folder](#creating-an-theme-folder)
- [Creating pages](#creating-pages)
- [Rendering portfolio data](#rendering-portfolio-data)
- [hint](#hint)
  - [DataProvider implements ParameterContainer](#dataprovider-implements-parametercontainer)
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

<!-- END doctoc generated TOC please keep comment here to allow auto update -->

## Creating an theme folder
To create a new theme you first have to create a new theme folder located in `src/PortfolioCMS/Themes/{name of your theme}`.  
Inside this folder you can add the folders css, js and images for your assets. 

## Creating pages
In an theme you can add your theme pages. The pages need to be `.php` pages and the pages also need to be registered in the database
so the template engine knows what to render for your portfolio. Its advised to use CDN networks for your external asset libraries like
bootstrap, jquery etc. 

On every page you have access to data from the database through the `DataProvider()` object. this object has a few methods for receiving data
from the database. The framework will handle the communication to the database and fetches the database entities into PHP objects.

## Rendering portfolio data
To render portfolio data in your theme you use the `DataProvider()` object to fetch data from the storage, the `DataProvider()` object is stored in the variable
`$dataprovider` witch will be accessible in your theme when the template engine renders the templates (theme files).

## hint
You can always visit the url /raw/{studentName} to get an raw dump of all the data in the portfolio.

### DataProvider implements ParameterContainer
This list below shows the methods that exist in the `DataProvider()` object. It also notice that
when you use the methods in your portfolio you don't type `: string ` or `: array` behind the method call, this is just for clarification
of the return type of the method. you can get data from the dataProvider from either saving the data an in variable and then accessing its 
methods like:
```php
<?php 
$student = $dataProvider->get( 'student' );
echo $student->getSomeProperty();

// OR like:
$url = $dataProvider->getUrl( 'url' );
echo $url;

 // OR like:
echo $dataProvider->get( 'student' )->getSomeProperty();

// Or like ( this is more save than the one above:
echo $dataProvider->call( 'student', 'someProperty' );
?>
```
if you want to output array data inside an html document you can use the foreach loop like:
```php
<!DOCTYPE html>
<html>
    <head>
        <title><?= $dataProvider->get( 'title' ) ?></title>
    </head>
    <body>
        <h1>My job experiences</h1>
        <?php foreach( $dataProvider->get( 'jobExperiences', [] ) as $jobExperience ) : ?>
            
            <div class='display-jobExperience'>
                <h3><?= $jobExperience->getName() ?></h3>
                <p>
                    <?= $jobExperience->getDescription() ?>
                </p>
            </div>
        
        <?php endforeach; ?>
    </body>
</html>
```
* `$dataProvider->get( $itemName, $defaultReturnType = NULL ) : $defaultReturnType` This can be used to get information from the data provider like an student, languages or any other portfolio data.
* `$dataProvider->has( $variableName ) : bool` This checks if an value exists in the data provider.
* `$dataProvider->call( $variableName, $methodName ) : mixed` This calls an method on an value in the data provider if the method exists other wise return null.
* `$dataProvider->isAllowedToViewGrade() : bool` Checks if an user is allowed to view an portfolio grade.
* There are more methods in the data provider inherited from the ParameterContainer se below for more info. also here are some example usages of the data provider 
in an template.
Using the data provider -> has method with alternative php syntax to make it more readable.
```php
<!DOCTYPE html>
<html>
    <head>
        <title><?= $dataProvider->get( 'title' ) ?></title>
    </head>
    <body>
        <nav>
            <?php if( $dataProvider->has( 'username' ): ?>
                <div class='display-username'>
                    hello: <?= $dataProvider->get( 'username' ) ?>
                </div>
            <?php endif; ?>
        </nav>
    </body>
</html>
```
Using the data provider -> call method with shorthand php syntax to make it more readeble.
```php
<!DOCTYPE html>
<html>
    <head>
        <title><?= $dataProvider->get( 'title' ) ?></title>
    </head>
    <body>
        <nav>
            <?= $dataProvider->call( 'student', 'getFirstName' ): ?>
        </nav>
    </body>
</html>
```
Using the data provider -> isAllowedToViewGrade method with alternative php syntax to make it more readable.
```php
<!DOCTYPE html>
<html>
    <head>
        <title><?= $dataProvider->get( 'title' ) ?></title>
    </head>
    <body>
        <div class='portfolio'>
            <?php if( $dataProvider->isAllowedToViewGrade() ): ?>
                <div class='grade'>
                    <?= $dataProvider->get( 'grade' ) ?>
                </div>
            <?php else: ?>
                <div class='grade'>
                    You are not allowed to view the grade.
                </div>
            <?php endif; ?>
        </div>
    </body>
</html>
```

### Student
This list below shows an list of the methods the `Student()` object has.It also shows the return types of the methods. notice that
when you use the methods in your portfolio you don't type `: string ` or `: array` behind the method call, this is just for clarification
of the return type of the method. you can get data from the student from either saving the student an in variable and then accessing its 
methods like:
```php
<?php 
$student = $dataProvider->get( 'student' );
echo $student->getSomeProperty();
?>
```
Or by accessing it it directly from the DataProvider like:
```php
<?php
echo $dataProvider->call( 'student', 'someProperty' );
?>
// Or for the php shorthand echo, which is more elegant when outputting data inline:
<?= $dataProvider->call( 'student', 'someProperty' ) ?>
// The short hand is the exact eqelevan of the code above just shorter.
```
I wont type `$dataProvider->get( 'student' );` in front of every method for convenience just `$s` but in your template you should first receive the request or use it 
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
$jobExperiences = $dataProvider->get( 'jobExperiences' );

// Its an array so you can loop through it and access the JobExperience poreperties.
foreach( $jobExperiences as $jobExperience )
{
    echo $jobExperience->getSomeProperty();
}
?>
```
Or by accessing it it directly from the DataProvider like:
```php
<?php
// Its an entity collection that can be used as an array so you need to use [] brackets with an index key to access it directly. 
echo $dataProvider->get( 'jobExperiences')[0]->getSomeProperty();
?>
// Or for the php shorthand echo, which is more elegant when outputting data inline:
<?= $dataProvider->get( 'jobExperiences')->getSomeProperty() ?>
// The short hand is the exact eqelevan of the code above just shorter.
```
I wont type `$dataProvider->get( 'student' );` in front of every method for convenience just `$j` but in your template you should first receive the request or use it 
like described above.
`$j->getId(): int` returns the id given by the database.
`$j->getLocation(): string` Returns the location of the job experience.
`$j->getStartedAt(): DateTime` Returns an `DateTime()` object with the start date or `NULL`.
`$j->getEndedAt(): DateTime` Returns an `DateTime()` object with the end date or `NULL`.
`$j->getDescription(): string` Returns an description about the job experience.
`$j->getIsInternship(): bool` Retunes an bool to define if the job experience is an intern ship.
To output all job experience data that are internships you can wite some code like this:
```php
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <div class='portfolio'>
            <h2>Here are all my intern ships</h2>
            <?php foreach( $dataProvider->call( 'jobExperiences', 'getEntitiesWith', [ 'IsInternship', TRUE ] ) as $internship ) ?>
                <div class='internship'>
                    <h3 class='title'><?= $internship->getDescription() ?></h3>
                    <span><i class='date-icon'><?= $internship->getStartedAt()->format( 'Y-m-d H:i:s' ) ?></span>
                    <span><i class='date-icon'><?= $internship->getEndedAt()->format( 'Y-m-d H:i:s' ) ?></span>
                    <p>Location: <?= $internship->getLocation() ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </body>
</html>
```
Or to output all job experiences without the check if it is an internship or an normal job experience.
To output all job experience data that are internships you can wite some code like this:
```php
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <div class='portfolio'>
            <h2>Here are all my intern ships</h2>
            <?php foreach( $dataProvider->get( 'jobExperiences', [] ) as $jobExperience ) ?>
                <div class='internship'>
                    <h3 class='title'><?= $jobExperience->getDescription() ?></h3>
                    <span><i class='date-icon'><?= $jobExperience->getStartedAt()->format( 'Y-m-d H:i:s' ) ?></span>
                    <span><i class='date-icon'><?= $jobExperience->getEndedAt()->format( 'Y-m-d H:i:s' ) ?></span>
                    <p>Location: <?= $jobExperience->getLocation() ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </body>
</html>
```

### Language
This list below shows an list of the methods the `Language()` object has.It also shows the return types of the methods. notice that
when you use the methods in your portfolio you don't type `: string ` or `: array` behind the method call, this is just for clarification
of the return methods type. Also notice that the method returns an array with the Language objects. you can get data from the 
Language from either saving the languages an in variable and then accessing its methods like:
```php
<?php 
$languages = $dataProvider->get( 'languages', [] );

// Its an array so you can loop through it and access the Language poreperties.
foreach( $languages as $language )
{
    echo $language->getSomeProperty();
}
?>
```
Or by accessing it it directly from the DataProvider like:
```php
<?php
// Its an EntityCollection that can be used as an array so you need to use [] brackets with an index key to access it directly. 
echo $dataProvider->get( 'Languages')[0]->getSomeProperty();
?>
// Or for the php shorthand echo, which is more elegant when outputting data inline:
<?= $dataProvider->get( 'jobExperiences')[0]->getSomeProperty() ?>
// The short hand is the exact eqelevan of the code above just shorter.
```
I wont type `$languages = $dataProvider->get( 'languages', [] )` in front of every method for convenience just `$l` but in your template you should first receive the request or use it 
like described above.
* `$l->getId(): int`
* `$l->getLevel(): int`
* `$l->getIsIsNative(): bool`
* `$l->getLanguage(): string`
To output all language data you can wite some code like this:
```php
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <div class='portfolio'>
            <h2>I can speak:</h2>
            <?php foreach( $dataProvider->get( 'languages', [] ) as $language ) ?>
                <div class='language'>
                    <h3 class='title'><?= $language->getLanguage() ?></h3>
                    <?php if( $language->getIsNative() ): ?>
                        <p>And its my native language</p>
                    <?php endif; ?>
                    <p>And on an scale from 1/10: <?= $language->getLevel() ?>
                </div>
            <?php endforeach; ?>
        </div>
    </body>
</html>
```

### Training
This list below shows an list of the methods the `Training()` object has.It also shows the return types of the methods. notice that
when you use the methods in your portfolio you don't type `: string ` or `: array` behind the method call, this is just for clarification
of the return methods type. Also notice that the method returns an array with the Training objects. you can get data from the 
Training from either saving the trainings an in variable and then accessing its methods like:
```php
<?php 
$trainings = $dataProvider->get( 'trainings', [] );

// Its an array so you can loop through it and access the Training poreperties.
foreach( $trainings as $training )
{
    echo $training->getSomeProperty();
}
?>
```
Or by accessing it it directly from the DataProvider like:
```php
<?php
// Its an EntityCollection that can be used as an array so you need to use [] brackets with an index key to access it directly. 
echo $dataProvider->get( 'trainings', [] )[0]->getSomeProperty();
?>
// Or for the php shorthand echo, which is more elegant when outputting data inline:
<?= $dataProvider->get( 'trainings', [] )[0]->getSomeProperty() ?>
// The short hand is the exact eqelevan of the code above just shorter.
```
I wont type `$dataProvider->get( 'trainings', [] )` in front of every method for convenience just `$t` but in your template you should first receive the request or use it 
like described above.
* `$t->getId(): int`
* `$t->getTitle(): string`
* `$t->getInstitution(): string`
* `$t->getLocation(): string`
* `$t->getStatedAt(): \DateTime`
* `$t->getFinishedAt(): \DateTime`
* `$t->getDescription(): string`
* `$t->getObtainedCertificate(): bool`
* `$t->getCurrentTraining(): bool`

### SLBAssignment
This list below shows an list of the methods the `SLBAssignment()` object has.It also shows the return types of the methods. notice that
when you use the methods in your portfolio you don't type `: string ` or `: array` behind the method call, this is just for clarification
of the return methods type. Also notice that the method returns an array with the SLBAssignments objects. you can get data from the 
SLBAssignment from either saving the SLB assignments an in variable and then accessing its methods like:
```php
<?php 
$slbAssignments = $dataProvider->get( 'slbAssignments', [] );

// Its an array so you can loop through it and access the SLBAssignment poreperties.
foreach( $slbAssignments as $slbAssignment )
{
    echo $slbAssignment->getSomeProperty();
}
?>
```
Or by accessing it it directly from the DataProvider like:
```php
<?php
// Its an array so you need to use [] brackets with an index key to access it directly. 
echo $dataProvider->get( 'slbAssignments', [] )[0]->getSomeProperty();
?>
// Or for the php shorthand echo, which is more elegant when outputting data inline:
<?= $dataProvider->get( 'slbAssignments', [] )[0]->getSomeProperty() ?>
// The short hand is the exact eqelevan of the code above just shorter.
```
I wont type `$dataProvider->get( 'slbAssignments', [] )` in front of every method for convenience just `$s` but in your template you should first receive the request or use it 
like described above.
* `$s->getId(): int`
* `$s->getName(): string`
* `$s->getFeedback(): string`
* `$s->getFileName(): string`
* `$s->getMimeType(): string`
* `$s->getFilePath(): string`

### Image
This list below shows an list of the methods the `Image()` object has.It also shows the return types of the methods. notice that
when you use the methods in your portfolio you don't type `: string ` or `: array` behind the method call, this is just for clarification
of the return methods type. Also notice that the method returns an array with the Images objects. you can get data from the 
Image from either saving the skill an in variable and then accessing its methods like:
```php
<?php 
$images = $dataProvider->get( 'images', [] );

// Its an array so you can loop through it and access the Image poreperties.
foreach( $images as $image )
{
    echo $image->getSomeProperty();
}
?>
```
Or by accessing it it directly from the DataProvider like:
```php
<?php
// Its an array so you need to use [] brackets with an index key to access it directly. 
echo $dataProvider->get( 'images', [] )[0]->getSomeProperty();
?>
// Or for the php shorthand echo, which is more elegant when outputting data inline:
<?= $dataProvider->get( 'images', [] )[0]->getSomeProperty() ?>
// The short hand is the exact eqelevan of the code above just shorter.
```
I wont type `$dataProvider->get( 'images', [] )` in front of every method for convenience just `$i` but in your template you should first receive the request or use it 
like described above.
* `$i->getId(): int`
* `$i->getFileName(): string`
* `$i->getMimeType(): string`
* `$i->getFilePath(): string`
* `$i->getName(): string`
* `$i->getDescription(): string`
* `$i->getType(): string`
* `$i->getOrder(): int`

### Skill
This list below shows an list of the methods the `Skill()` object has.It also shows the return types of the methods. notice that
when you use the methods in your portfolio you don't type `: string ` or `: array` behind the method call, this is just for clarification
of the return methods type. Also notice that the method returns an array with the Skill objects. you can get data from the 
Skill from either saving the skill an in variable and then accessing its methods like:
```php
<?php 
$skills = $dataProvider->get( 'skills', [] );

// Its an array so you can loop through it and access the Skill poreperties.
foreach( $skills as $skill )
{
    echo $skill->getSomeProperty();
}
?>
```
Or by accessing it it directly from the DataProvider like:
```php
<?php
// Its an array so you need to use [] brackets with an index key to access it directly. 
echo $dataProvider->get( 'skills', [] )[0]->getSomeProperty();
?>
// Or for the php shorthand echo, which is more elegant when outputting data inline:
<?= $dataProvider->get( 'skills', [] )[0]->getSomeProperty() ?>
// The short hand is the exact eqelevan of the code above just shorter.
```
I wont type `$dataProvider->get( 'skills', [] )` in front of every method for convenience just `$s` but in your template you should first receive the request or use it 
like described above.
* `$s->getId(): int`
* `$s->getName(): string`
* `$s->getLevelOfExperience(): int`

### Hobby
This list below shows an list of the methods the `Hobby()` object has.It also shows the return types of the methods. notice that
when you use the methods in your portfolio you don't type `: string ` or `: array` behind the method call, this is just for clarification
of the return methods type. Also notice that the method returns an array with the Hobby objects. you can get data from the 
Hobby from either saving the hobby an in variable and then accessing its methods like:
```php
<?php 
$hobby = $dataProvider->get( 'hobbies', [] );

// Its an array so you can loop through it and access the Hobby poreperties.
foreach( $hobbys as $hobby )
{
    echo $hobby->getSomeProperty();
}
?>
```
Or by accessing it it directly from the DataProvider like:
```php
<?php
// Its an array so you need to use [] brackets with an index key to access it directly. 
echo $dataProvider->get( 'hobbies', [] )[0]->getSomeProperty();
?>
// Or for the php shorthand echo, which is more elegant when outputting data inline:
<?= $dataProvider->get( 'hobbies', [] )[0]->getSomeProperty() ?>
// The short hand is the exact eqelevan of the code above just shorter.
```
I wont type `$dataProvider->get( 'hobbies', [] )` in front of every method for convenience just `$h` but in your template you should first receive the request or use it 
like described above.
* `$h->getId(): int`
* `$h->getName(): string`

### Request object
This list below shows an list of the methods the `HttpRequest()` object has.It also shows the return types of the methods. notice that
when you use the methods in your portfolio you don't type `: string ` or `: array` behind the method call, this is just for clarification
of the return type of the method. you can get data from the request from either saving the request an in variable and then accessing its 
methods like:
```php
<?php 
$request = $dataProvider->get( 'httpRequest' );
echo $request->getSomeProperty();
?>
```
Or by accessing it it directly from the DataProvider like:
```php
<?php
echo $request = $dataProvider->call( 'httpRequest', 'getSomeProperty' );
?>
// Or for the php shorthand echo, which is more elegant when outputting data inline:
<?= $dataProvider->call( 'httpRequest', 'getSomeProperty' ) ?>
// The short hand is the exact eqelevan of the code above just shorter.
```
I wont type `$dataProvider->get( 'httpRequest' )` in front of every method for convenience just `$r` but in your template you should first receive the request or use it 
like described above.
* `$r->getQueryParams() : ParameterContainer` This method returns `$_GET` parameters, scroll down for more information about the `ParameterContainer()` object. 
* `$r->getPostParams(): ParameterContainer` This method returns the `$_POST` parameters, scroll down for more information about the `ParameterContainer()` object. 
* `$r->getFiles(): FilesContainer` This method returns the `$_FILES` parameters, scroll down for more information about the `FilesContainer()` object. 
* `$r->getServer(): ParameterContainer` This method returns the `$_SERVER` parameters, scroll down for more information about the `ParameterContainer()` object. 
* `$r->getHeaders(): ParameterContainer` This method returns the headers from the request, scroll down for more information about the `ParameterContainer()` object. 
* `$r->getCookies(): ParameterContainer` This method returns the `$_COOKIE` parameters, scroll down for more information about the `ParameterContainer()` object. 
* `$r->getContent(): string` This method returns the requests body. 
* `$r->getRequestUri(): string` This method returns the request uri like: `/portfolio/joris?bringAn=towel&answerToEverything=42`.
* `$r->getUri(): string` This method returns the full uri like: `http://hostname.nl/portfolio/joris?bringAn=towel&answerToEverything=42`. 
* `$r->getScheme(): string` This method returns the requests scheme like: `http` or `https`.
* `$r->getBasePath(): string` This method returns the base path of the request like: `/portfolio/joris`.
* `$r->getBaseUri(): string` This method returns the base uri like: `http://hostname.nl`.
* `$r->getScriptName(): string` This method returns the name of the script executing the request like: `index.php`.
* `$r->getClientIp(): string` This method returns the clients ip address like: `192.168.1.10`.
* `$r->getServerIp(): string` This method returns the servers ip address like: `141.185.141.142`.
* `$r->getQueryString(): string` This method returns the query string like: `bringAn=towel&answerToEverything=42`.
* `$r->getHostname(): string` This method returns the hostname of the server like: `www.hostname.nl` without the requests scheme and path.
* `$r->getMethod(): string` This method returns the HTTP request method like `GET`, `POST`, `PUT`, `DELETE`, `HEAD`, `TRACE` or `CONNECT`.
* `$r->getUriForPath( $path ): string` This method returns the uri for an path that can be passed as argument, the path `/portfolio/joris` will return something like: `hhttp://hostname.nl/portfolio/joris`.

### ParameterContainer
This list below shows an list of the methods the `ParameterContainer()` object has.It also shows the return types of the methods. notice that
when you use the methods in your portfolio you don't type `: string ` or `: array` behind the method call, this is just for clarification
of the return type of the method. The parameterContainer is an heavly used object even the `DataProvider` implements it so it has the same methods. 
you can get data from the ParameterContainer from either saving the parameter container an in variable and then 
accessing its methods like:
```php
<?php 
// The request has manny methods that return an ParameterContainer so this applies to all of the methods that return one.
$parameterContainer = $dataProvider->call( 'httpRequest', 'getSomethingThatReturnsParameterContainer' );

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
The DataProvider implements the ParameterConatiner so the DataProvider has the same methods as the ParameterContainer only it has a few extra methods.
* `$dataProvider->all()`
* `$dataProvider->add( array $parameters = [] )`
* `$dataProvider->set( $key, $value )`
* `$dataProvider->has( $key ) : bool`
* `$dataProvider->get( $key, $default = null )`
* `$dataProvider->remove( $key )`
* `$dataProvider->clear(  )`
* `$dataProvider->keys() : array`
* `$dataProvider->replace( array $parameters = [] )`
* `$dataProvider->getInt( $key, $default = 0 ) : int`
* `$dataProvider->getBoolean( $key, $default = false ) : bool`
* `$dataProvider->offsetSet( $key, $value )`
* `$dataProvider->offsetExists( $key )`
* `$dataProvider->offsetUnset( $key )`
* `$dataProvider->offsetGet( $key )`
* `$dataProvider->getIterator()`
* `$dataProvider->count() : int`