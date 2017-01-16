# Using and installing composer guide
<!-- START doctoc generated TOC please keep comment here to allow auto update -->
<!-- DON'T EDIT THIS SECTION, INSTEAD RE-RUN doctoc TO UPDATE -->
**Table of Contents**

- [Using composer](#using-composer)
  - [Installing php dependencies windows](#installing-php-dependencies-windows)
  - [installing php dependencies linux/mac](#installing-php-dependencies-linuxmac)
  - [Updating dependencies](#updating-dependencies)
  - [Adding dependencies](#adding-dependencies)
    - [Using the commandline](#using-the-commandline)
    - [Editing the composer file](#editing-the-composer-file)

<!-- END doctoc generated TOC please keep comment here to allow auto update -->

# Using composer
The project uses composer to manage its dependencies to install composer go to to [the composer website](https://getcomposer.org/download/) and follow
the installation instructions.

## Installing php dependencies windows
To install the project dependencies open an command prompt (cmd.exe) you can find it by clicking on strart and typing cmd.
In the command prompt cheance the directory to the root of the project.
```bash
cd path\to\project\directory
```
Then type composer install and wait for the dependencies to download and install.
```bash
composer install
```
Thats it you now have installed the project dependencies.

## installing php dependencies linux/mac
To install the project dependencies open an terminal on ubuntu `crtl + alt + t` on mac click on `/Applications/Utilities/Terminal`. 
In the command prompt cheance the directory to the root of the project.
```bash
cd path/to/project/directory
```
Then type composer install and wait for the dependencies to download and install.
```bash
composer install
```
Thats it you now have installed the project dependencies.

## Updating dependencies
If you updated the `composer.json` file, added new dependencies or want to update the dependency libraries you have to update the composer autoloader. 
To do this open an terminal/command prompt and go to the project root directory. In the project root directory type composer update.
```bash
composer update
```
Now wait for composer to update to download the updated/new dependencies and for composer to generate an new autoload files and your good to go.

## Adding dependencies
If you need to add new dependencies you can do so by either editing the `composer.json` file or by using the composer commandline tools.
### Using the commandline
Go to the project root directory and type composer require.
```bash
composer require
```
Then seartch for the dependency you want to add to to project by either typing the complete name like `vendor\dependency` or by keyword `dependency`.  
```bash
Search for a package: 
> phpunit
Found 15 packages matching phpunit

   [0] phpunit/phpunit
   [1] eher/phpunit
   [2] jbzoo/phpunit
   [3] task/phpunit
   [4] backplane/phpunit
   [5] phpunit/phpunit-mock-objects
   [6] phpunit/phpunit-selenium
   [7] phpunit/phpunit-story
   [8] phpunit/phpunit-skeleton-generator
   [9] phpunit/dbunit
  [10] phpunit/phpunit-dom-assertions
  [11] phpunit/phpcov
  [12] phpunit/phpunit-mink-trait
  [13] phpunit/php-file-iterator
  [14] phpunit/php-token-stream

Enter package # to add, or the complete package name if it is not listed: 
> 0
```
After you added the new dependency update your project.

### Editing the composer file
You can add new php dependencies by editing the composer.json file. To edit the file open `composer.json` and add new dependencies under the `"require"` setting:
```json
{
    "name": "stenden-inf1b/portefolio-cms",
    "description": "Portefolio CMS - An simple CMS system for managing digital portfolios.",
    "type": "project",
    "require-dev": {
        "phpunit/phpunit": "^5.7"
    },
    "license": "GPLv3",
    "authors": [
        {
            "name": "Joris Rietveld",
            "email": "jorisrietveld@gmail.com"
        }
    ],
    "autoload-dev": {
        "psr-4": {
            "Tests\\PortfolioCMS\\" : "Tests/",
            "JorisRietveld\\Commandline\\" : "bin/src/Commandline"
        }
    },
    "minimum-stability": "dev",
    "require": {
        "maximebf/debugbar": "1.*",
        "symfony/debug-bundle": "3.2.*",
        "symfony/console": "3.2.1",
        "my-new/dependency": "dev"
    }
}
```
After you added the new dependency update your project.