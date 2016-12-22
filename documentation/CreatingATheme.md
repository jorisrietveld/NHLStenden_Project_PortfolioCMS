# Creating a new theme
This guide explains how to create a new theme for the PortfolioCMS.

## Creating an theme folder
todo write someting

## Required files

## Available portfolio data

$portfolio(
    getTitle();
    getLink();
    getStudent();
    getJobExperiences();
)
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

$profileImages [
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

echo '<h1>I can speak:</h1>';
foreach( $portfolio->getLanguages() as $language )
{
    echo $language->getLanguage() . '<br>';
}