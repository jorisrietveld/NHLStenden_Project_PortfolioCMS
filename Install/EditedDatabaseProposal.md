# Nieuwe database
Ik heb de database en relaties even bekeken en denk dat hij moeilijk te realizeren is en over complex 
ik ben even bezig om een aantal dingen te wijzigen en dan kunnen we overleggen wat de beste strategie is.
Mischien kunnen we voorstellen dat we een nieuw ERD aanleveren die zal ik ook even maken met een data dictionary.

## Entities

### User 
_This entity is used for authenticating users_ <br>
**id** PRIMARY KEY<br>
password _An secret key for authenticating an user_<br>
accountCreated _An timestamp of when the account was created_<br>
lastLogin _An timestamp of the last time the user was online_<br>
email :closed_lock_with_key: _The email address of the user, also used to login_<br>
lastIpAddress :closed_lock_with_key: _The last ip address the user used to login_<br>
firstName :closed_lock_with_key: _The encrypted first name of the user_<br>
lastName :closed_lock_with_key: _The encrypted last name of the user_<br>
active _Veld om gebruikter op inactief te zetten_<br>

### Student 
_This entity is an type of user_<br>
**userId** PRIMARY KEY, FOREIGN KEY -> User( id )<br>
street :closed_lock_with_key: _The encrypted name the street where the student lives_<br>
address :closed_lock_with_key: _The encrypted street number of the house where the student lives_<br>
zipCode :closed_lock_with_key: _The zip code of where student lives_<br>
location :closed_lock_with_key: _The place the student lives_<br>
dateOfBirth :closed_lock_with_key: _The date of birth of an student_<br>
studentCode _Unique identification field for all users that are of the type student_<br>
phoneNumber :closed_lock_with_key: _The encrypted phone number of the user_<br>

### Teacher 
_This entity is an type of user_<br>
**userId** PRIMARY KEY, FOREIGN KEY -> User( id )<br>
isSLBer _Field to differentiate between teachers and SLB'ers_ <br>

### GuestBookMessage 
_This entity represents an message on the guestbook_<br>
**id** PRIMARY KEY<br>
sender _The name of the author of the message in the guestbook_<br>
title _An subject or title for the message_<br>
message _The actual message_<br>
isAccepted _If the message is accepted by the student_ <br>
userId FOREIGN KEY -> User( id )<br>

### Theme 
_This entity represents an installed theme that can be used for an portfolio_<br>
**id** PRIMARY KEY<br>
name _An friendly name for the theme_<br>
author _The author that created the theme_<br>
description _A short description of the theme_<br>
directoryName _the name of the actual folder_<br>

### Portfolio 
_This entity represents an portfolio of an user_<br>
**id** PRIMARY KEY, FOREIGN KEY -> User( id )<br>
themeID FOREIGN KEY -> Theme( id ) <br>
title _The title that will be displayed in the tab on the browser_<br>
link _The url used in the address field in the browser_<br>
grade _The grade of the portfolio given by the SBL teacher_<br>

### JobExperience
**id** PRIMARY KEY<br>
location _The location of the job experience_<br>
startedAt _The start date of the job_<br>
endedAt _The end date of the job_<br>
description _An description about the tasks performed at the job_<br>
isInternship _If the job experience is an internship_<br>
portfolioId FORGEIN KEY -> Portfolio( id )<br>

### Language
_This entity represents the languages the student masters_<br>
**id** PRIMARY KEY<br>
language _The name of the language_<br>
level _The level of mastery of the language_<br>
isNative _If it is the native language of the user_<br>
portfolioId FOREIGN KEY -> Portfolio( id )<br>

### Trainings
_This entity represents the trainings the student attended_<br>
**id** PRIMARY KEY<br>
title _The title of the training_<br>
institution _The institution where the student attended the training_<br>
location _The location of the institution_<br>
startedAt _The start date of the training_<br>
finishedAt _The date the student earned an certificate of the training_<br>
description _An description about the training the student attended_<br>
obtainedCertificate _An boolean representing if the student obtained an certificate for the training_<br>
currentTraining _An boolean representing if it is the current training the student is attending_<br>
portfolioId FOREIGN KEY -> Portfolio( id )<br>

### UploadedFile
_This entity represents an uploaded file like an slb assignment or picture_<br>
**id** PRIMARY KEY<br>
fileName _The file name of the uploaded assignment_<br>
mimeType _The mime type the uploaded file_<br>
filePath _The path of the file_<br>
portfolioId FOREIGN KEY -> Portfolio( id )<br>

### SlbAssignment
_This entity is an type of UploadedFile that represents an slb assignment_<br>
**uploadedFileId** PRIMARY KEY, FOREIGN KEY -> UploadedFile( id )<br>
name _The name of the assignment_<br>
feedback _Feedback by the SLB teacher on the assignment_<br>
uploadedFileId FOREIGN KEY -> UploadedFile( id )<br>

### Image
_This entity is an type of UploadedFile that represents an slb assignment_<br>
**uploadedFileId** PRIMARY KEY, FOREIGN KEY -> UploadedFile( id )<br>
name _An friendly name for the image_<br>
description _The description of the image that can be used in the alt tag in html_ <br>
type _This defines where the image will be used as PROFILE_IMAGE OR GALLERY_IMAGE._<br>
order _This can be used when an image is an gallery picture to set the order of display._<br>

### Skill
_This entity represents an skill the student has_<br>
**id** PRIMARY KEY, FOREIGN KEY -> Portfolio( id )<br>
name _The name of the skill like MS Office or PHP_<br>
levelOfExperience _The experience level as an integer so you can havel like 10 or 5 stars_<br>
portfolioId FORGEIN KEY -> Portfolio( id )<br>

### Hobbies
_This entity represents an hobby the student has_<br>
**id** PRIMARY KEY, FOREIGN KEY -> Portfolio( id )<br>
name _The name of the hobby and an short description_<br>
portfolioId FORGEIN KEY -> Portfolio( id )<br>

 