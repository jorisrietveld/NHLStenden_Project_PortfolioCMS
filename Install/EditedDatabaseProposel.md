# Nieuwe database
Ik heb de database en relaties even bekeken en denk dat hij moeilijk te realizeren is en over complex 
ik ben even bezig om een aantal dingen te wijzigen en dan kunnen we overleggen wat de beste strategie is.
Mischien kunnen we voorstellen dat we een nieuw ERD aanleveren die zal ik ook even maken met een data dictionary.

## Entities

### User 
_This entity is used for authenticating users_
**id** PRIMARY KEY
password _An secret key for authenticating an user_
accountCreated _An timestamp of when the account was created_
lastLogin _An timestamp of the last time the user was online_
email :closed_lock_with_key: _The email address of the user, also used to login_
lastIpAddress :closed_lock_with_key: _The last ip address the user used to login_
firstName :closed_lock_with_key: _The encrypted first name of the user_
lastName :closed_lock_with_key: _The encrypted last name of the user_
active _Veld om gebruikter op inactief te zetten_

### Student 
_This entity is an type of user_
**userId** PRIMARY KEY, FOREIGN KEY -> User( id )
address :closed_lock_with_key:
dateOfBirth :closed_lock_with_key: _The date of birth of an student_
studentCode _Unique identification field for all users that are of the type student_
phoneNumber :closed_lock_with_key: _The encrypted phone number of the user_

### Teacher 
_This entity is an type of user_
**userId** PRIMARY KEY, FOREIGN KEY -> User( id )
isSLBer _Field to differentiate between teachers and SLB'ers_ 

### GuestBookMessage 
_This entity represents an message on the guestbook_
**id** PRIMARY KEY
sender _The name of the author of the message in the guestbook_
title _An subject or title for the message_
message _The actual message_
isAccepted _If the message is accepted by the student_ 
userId FOREIGN KEY -> User( id )

### Theme 
_This entity represents an installed theme that can be used for an portfolio_
**id** PRIMARY KEY
name _An friendly name for the theme_
author _The author that created the theme_
description _A short description of the theme_
directoryName _the name of the actual folder_

### Portfolio 
_This entity represents an portfolio of an user_
**id** PRIMARY KEY, FOREIGN KEY -> User( id )
themeID FOREIGN KEY -> Theme( id ) 
title _The title that will be displayed in the tab on the browser_
link _The url used in the address field in the browser_
grade _The grade of the portfolio given by the SBL teacher_


### JobExperience
**id** PRIMARY KEY
location _The location of the job experience_
startedAt _The start date of the job_
endedAt _The end date of the job_
description _An description about the tasks performed at the job_
isInternship _If the job experience is an internship_
portfolioId FORGEIN KEY -> Portfolio( id )

### Language
_This entity represents the languages the student masters_
**id** PRIMARY KEY
language _The name of the language_
level _The level of mastery of the language_
isNative _If it is the native language of the user_
portfolioId FOREIGN KEY -> Portfolio( id )

### Trainings
_This entity represents the trainings the student attended_
**id** PRIMARY KEY
title _The title of the training_
institution _The institution where the student attended the training_
location _The location of the institution_
startedAt _The start date of the training_
finishedAt _The date the student earned an certificate of the training_
description _An description about the training the student attended_
obtainedCertificate _An boolean representing if the student obtained an certificate for the training_
currentTraining _An boolean representing if it is the current training the student is attending_
portfolioId FOREIGN KEY -> Portfolio( id )

### UploadedFile
_This entity represents an uploaded file like an slb assignment or picture_
**id** PRIMARY KEY
fileName _The file name of the uploaded assignment_
mimeType _The mime type the uploaded file_
filePath _The path of the file_
portfolioId FOREIGN KEY -> Portfolio( id )

### SlbAssignment
_This entity is an type of UploadedFile that represents an slb assignment_
**uploadedFileId** PRIMARY KEY, FOREIGN KEY -> UploadedFile( id )
name _The name of the assignment_
feedback _Feedback by the SLB teacher on the assignment_
uploadedFileId FOREIGN KEY -> UploadedFile( id )

### Image
_This entity is an type of UploadedFile that represents an slb assignment_
**uploadedFileId** PRIMARY KEY, FOREIGN KEY -> UploadedFile( id )
name _An friendly name for the image_
description _The description of the image that can be used in the alt tag in html_ 
type _This defines where the image will be used as PROFILE_IMAGE OR GALLERY_IMAGE._
order _This can be used when an image is an gallery picture to set the order of display._

### Skill
_This entity represents an skill the student has_
**id** PRIMARY KEY, FOREIGN KEY -> Portfolio( id )
name _The name of the skill like MS Office or PHP_
levelOfExperience _The experience level as an integer so you can havel like 10 or 5 stars_
portfolioId FORGEIN KEY -> Portfolio( id )

### Hobbies
_This entity represents an hobby the student has_
**id** PRIMARY KEY, FOREIGN KEY -> Portfolio( id )
name _The name of the hobby and an short description_
portfolioId FORGEIN KEY -> Portfolio( id )