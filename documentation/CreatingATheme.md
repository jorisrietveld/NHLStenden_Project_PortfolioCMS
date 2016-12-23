# Creating a new theme
This guide explains how to create a new theme for the PortfolioCMS.

## Creating an theme folder
To create a new theme you first have to create a new theme folder located in `src/PortfolioCMS/Themes/{name of your theme}`.  
Inside this folder you can add the css, js and images folders for your assets. 

## Required files
Inside every theme you have to create the files `index.php` and `slbOpdrachen.php`. In these files you can write the html and php code 
for your theme.

## Available portfolio data
In your theme you can access the $portfolio variable which has methods for receiving portfolio data. you can see an interface below defining the 
methods and return types.
```php
$portfolio(
    getTitle() : string;
    getLink() : string;
    getStudent() : array;
    getJobExperiences() : array;
    getLanguages() : array;
    getTrainings() : array;
    getSLBAssignments() : array;
    getProfileImage() : Image();
    getGalleryPictures() : array;
    getSkills() : array;
    getHobbies() : array;
)
```

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
