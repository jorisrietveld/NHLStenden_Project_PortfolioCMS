/*****************************************************************************************
 * Insert, update, delete and select statements for the table GuestBookMessage.
 ****************************************************************************************/

/**
 * Select statement for GuestBookMessage
*/
SELECT
	`GuestBookMessage`.`id`,
	`GuestBookMessage`.`sender`,
	`GuestBookMessage`.`title`,
	`GuestBookMessage`.`message`,
	`GuestBookMessage`.`sendAt`,
	`GuestBookMessage`.`studentId`,
	`GuestBookMessage`.`accsepted`
FROM `DigitalPortfolio`.`GuestBookMessage`
;

/**
 * Update statement for GuestBookMessage
*/
UPDATE GuestBookMessage SET 
	`id` = :id,
	`sender` = :sender,
	`title` = :title,
	`message` = :message,
	`sendAt` = :sendAt,
	`studentId` = :studentId,
	`accsepted` = :accsepted
WHERE `GuestBookMessage`.`id` = :id;


/**
 * Delete statement for GuestBookMessage
*/
DELETE FROM GuestBookMessage WHERE `GuestBookMessage`.`id` = :id;

/**
 * Select statement for GuestBookMessage
*/
SELECT
	`GuestBookMessage`.`id`,
	`GuestBookMessage`.`sender`,
	`GuestBookMessage`.`title`,
	`GuestBookMessage`.`message`,
	`GuestBookMessage`.`sendAt`,
	`GuestBookMessage`.`studentId`,
	`GuestBookMessage`.`accsepted`
FROM `DigitalPortfolio`.`GuestBookMessage`
WHERE `GuestBookMessage`.`id` = :id;


/**
 * Insert statement for GuestBookMessage
*/
INSERT INTO `DigitalPortfolio`.`GuestBookMessage`( 
	`id`,
	`sender`,
	`title`,
	`message`,
	`sendAt`,
	`studentId`,
	`accsepted`
) VALUES ( 
	:id,
	:sender,
	:title,
	:message,
	:sendAt,
	:studentId,
	:accsepted
);

/*****************************************************************************************
 * Insert, update, delete and select statements for the table Hobby.
 ****************************************************************************************/

/**
 * Select statement for Hobby
*/
SELECT
	`Hobby`.`id`,
	`Hobby`.`name`,
	`Hobby`.`portfolioId`
FROM `DigitalPortfolio`.`Hobby`
;

/**
 * Update statement for Hobby
*/
UPDATE Hobby SET 
	`id` = :id,
	`name` = :name,
	`portfolioId` = :portfolioId
WHERE `Hobby`.`id` = :id;


/**
 * Delete statement for Hobby
*/
DELETE FROM Hobby WHERE `Hobby`.`id` = :id;

/**
 * Select statement for Hobby
*/
SELECT
	`Hobby`.`id`,
	`Hobby`.`name`,
	`Hobby`.`portfolioId`
FROM `DigitalPortfolio`.`Hobby`
WHERE `Hobby`.`id` = :id;


/**
 * Insert statement for Hobby
*/
INSERT INTO `DigitalPortfolio`.`Hobby`( 
	`id`,
	`name`,
	`portfolioId`
) VALUES ( 
	:id,
	:name,
	:portfolioId
);

/*****************************************************************************************
 * Insert, update, delete and select statements for the table Image.
 ****************************************************************************************/

/**
 * Select statement for Image
*/
SELECT
	`Image`.`uploadedFileId`,
	`Image`.`name`,
	`Image`.`description`,
	`Image`.`type`,
	`Image`.`order`
FROM `DigitalPortfolio`.`Image`
;

/**
 * Update statement for Image
*/
UPDATE Image SET 
	`uploadedFileId` = :uploadedFileId,
	`name` = :name,
	`description` = :description,
	`type` = :type,
	`order` = :order
WHERE `Image`.`uploadedFileId` = :id;


/**
 * Delete statement for Image
*/
DELETE FROM Image WHERE `Image`.`uploadedFileId` = :id;

/**
 * Select statement for Image
*/
SELECT
	`Image`.`uploadedFileId`,
	`Image`.`name`,
	`Image`.`description`,
	`Image`.`type`,
	`Image`.`order`
FROM `DigitalPortfolio`.`Image`
WHERE `Image`.`uploadedFileId` = :id;


/**
 * Insert statement for Image
*/
INSERT INTO `DigitalPortfolio`.`Image`( 
	`uploadedFileId`,
	`name`,
	`description`,
	`type`,
	`order`
) VALUES ( 
	:uploadedFileId,
	:name,
	:description,
	:type,
	:order
);

/*****************************************************************************************
 * Insert, update, delete and select statements for the table JobExperience.
 ****************************************************************************************/

/**
 * Select statement for JobExperience
*/
SELECT
	`JobExperience`.`id`,
	`JobExperience`.`location`,
	`JobExperience`.`startedAt`,
	`JobExperience`.`endedAt`,
	`JobExperience`.`description`,
	`JobExperience`.`isInternship`,
	`JobExperience`.`portfolioId`
FROM `DigitalPortfolio`.`JobExperience`
;

/**
 * Update statement for JobExperience
*/
UPDATE JobExperience SET 
	`id` = :id,
	`location` = :location,
	`startedAt` = :startedAt,
	`endedAt` = :endedAt,
	`description` = :description,
	`isInternship` = :isInternship,
	`portfolioId` = :portfolioId
WHERE `JobExperience`.`id` = :id;


/**
 * Delete statement for JobExperience
*/
DELETE FROM JobExperience WHERE `JobExperience`.`id` = :id;

/**
 * Select statement for JobExperience
*/
SELECT
	`JobExperience`.`id`,
	`JobExperience`.`location`,
	`JobExperience`.`startedAt`,
	`JobExperience`.`endedAt`,
	`JobExperience`.`description`,
	`JobExperience`.`isInternship`,
	`JobExperience`.`portfolioId`
FROM `DigitalPortfolio`.`JobExperience`
WHERE `JobExperience`.`id` = :id;


/**
 * Insert statement for JobExperience
*/
INSERT INTO `DigitalPortfolio`.`JobExperience`( 
	`id`,
	`location`,
	`startedAt`,
	`endedAt`,
	`description`,
	`isInternship`,
	`portfolioId`
) VALUES ( 
	:id,
	:location,
	:startedAt,
	:endedAt,
	:description,
	:isInternship,
	:portfolioId
);

/*****************************************************************************************
 * Insert, update, delete and select statements for the table Language.
 ****************************************************************************************/

/**
 * Select statement for Language
*/
SELECT
	`Language`.`id`,
	`Language`.`language`,
	`Language`.`level`,
	`Language`.`isNative`,
	`Language`.`portfolioId`
FROM `DigitalPortfolio`.`Language`
;

/**
 * Update statement for Language
*/
UPDATE Language SET 
	`id` = :id,
	`language` = :language,
	`level` = :level,
	`isNative` = :isNative,
	`portfolioId` = :portfolioId
WHERE `Language`.`id` = :id;


/**
 * Delete statement for Language
*/
DELETE FROM Language WHERE `Language`.`id` = :id;

/**
 * Select statement for Language
*/
SELECT
	`Language`.`id`,
	`Language`.`language`,
	`Language`.`level`,
	`Language`.`isNative`,
	`Language`.`portfolioId`
FROM `DigitalPortfolio`.`Language`
WHERE `Language`.`id` = :id;


/**
 * Insert statement for Language
*/
INSERT INTO `DigitalPortfolio`.`Language`( 
	`id`,
	`language`,
	`level`,
	`isNative`,
	`portfolioId`
) VALUES ( 
	:id,
	:language,
	:level,
	:isNative,
	:portfolioId
);

/*****************************************************************************************
 * Insert, update, delete and select statements for the table Page.
 ****************************************************************************************/

/**
 * Select statement for Page
*/
SELECT
	`Page`.`id`,
	`Page`.`name`,
	`Page`.`fileName`,
	`Page`.`description`,
	`Page`.`url`,
	`Page`.`themeId`
FROM `DigitalPortfolio`.`Page`
;

/**
 * Update statement for Page
*/
UPDATE Page SET 
	`id` = :id,
	`name` = :name,
	`fileName` = :fileName,
	`description` = :description,
	`url` = :url,
	`themeId` = :themeId
WHERE `Page`.`id` = :id;


/**
 * Delete statement for Page
*/
DELETE FROM Page WHERE `Page`.`id` = :id;

/**
 * Select statement for Page
*/
SELECT
	`Page`.`id`,
	`Page`.`name`,
	`Page`.`fileName`,
	`Page`.`description`,
	`Page`.`url`,
	`Page`.`themeId`
FROM `DigitalPortfolio`.`Page`
WHERE `Page`.`id` = :id;


/**
 * Insert statement for Page
*/
INSERT INTO `DigitalPortfolio`.`Page`( 
	`id`,
	`name`,
	`fileName`,
	`description`,
	`url`,
	`themeId`
) VALUES ( 
	:id,
	:name,
	:fileName,
	:description,
	:url,
	:themeId
);

/*****************************************************************************************
 * Insert, update, delete and select statements for the table Portfolio.
 ****************************************************************************************/

/**
 * Select statement for Portfolio
*/
SELECT
	`Portfolio`.`id`,
	`Portfolio`.`themeId`,
	`Portfolio`.`title`,
	`Portfolio`.`url`,
	`Portfolio`.`grade`,
	`Portfolio`.`userId`
FROM `DigitalPortfolio`.`Portfolio`
;

/**
 * Update statement for Portfolio
*/
UPDATE Portfolio SET 
	`id` = :id,
	`themeId` = :themeId,
	`title` = :title,
	`url` = :url,
	`grade` = :grade,
	`userId` = :userId
WHERE `Portfolio`.`id` = :id;


/**
 * Delete statement for Portfolio
*/
DELETE FROM Portfolio WHERE `Portfolio`.`id` = :id;

/**
 * Select statement for Portfolio
*/
SELECT
	`Portfolio`.`id`,
	`Portfolio`.`themeId`,
	`Portfolio`.`title`,
	`Portfolio`.`url`,
	`Portfolio`.`grade`,
	`Portfolio`.`userId`
FROM `DigitalPortfolio`.`Portfolio`
WHERE `Portfolio`.`id` = :id;


/**
 * Insert statement for Portfolio
*/
INSERT INTO `DigitalPortfolio`.`Portfolio`( 
	`id`,
	`themeId`,
	`title`,
	`url`,
	`grade`,
	`userId`
) VALUES ( 
	:id,
	:themeId,
	:title,
	:url,
	:grade,
	:userId
);

/*****************************************************************************************
 * Insert, update, delete and select statements for the table Project.
 ****************************************************************************************/

/**
 * Select statement for Project
*/
SELECT
	`Project`.`id`,
	`Project`.`name`,
	`Project`.`description`,
	`Project`.`link`,
	`Project`.`imageId`,
	`Project`.`portfolioId`,
	`Project`.`grade`
FROM `DigitalPortfolio`.`Project`
;

/**
 * Update statement for Project
*/
UPDATE Project SET 
	`id` = :id,
	`name` = :name,
	`description` = :description,
	`link` = :link,
	`imageId` = :imageId,
	`portfolioId` = :portfolioId,
	`grade` = :grade
WHERE `Project`.`id` = :id;


/**
 * Delete statement for Project
*/
DELETE FROM Project WHERE `Project`.`id` = :id;

/**
 * Select statement for Project
*/
SELECT
	`Project`.`id`,
	`Project`.`name`,
	`Project`.`description`,
	`Project`.`link`,
	`Project`.`imageId`,
	`Project`.`portfolioId`,
	`Project`.`grade`
FROM `DigitalPortfolio`.`Project`
WHERE `Project`.`id` = :id;


/**
 * Insert statement for Project
*/
INSERT INTO `DigitalPortfolio`.`Project`( 
	`id`,
	`name`,
	`description`,
	`link`,
	`imageId`,
	`portfolioId`,
	`grade`
) VALUES ( 
	:id,
	:name,
	:description,
	:link,
	:imageId,
	:portfolioId,
	:grade
);

/*****************************************************************************************
 * Insert, update, delete and select statements for the table SLBAssignment.
 ****************************************************************************************/

/**
 * Select statement for SLBAssignment
*/
SELECT
	`SLBAssignment`.`uploadedFileId`,
	`SLBAssignment`.`name`,
	`SLBAssignment`.`feedback`
FROM `DigitalPortfolio`.`SLBAssignment`
;

/**
 * Update statement for SLBAssignment
*/
UPDATE SLBAssignment SET 
	`uploadedFileId` = :uploadedFileId,
	`name` = :name,
	`feedback` = :feedback
WHERE `SLBAssignment`.`uploadedFileId` = :id;


/**
 * Delete statement for SLBAssignment
*/
DELETE FROM SLBAssignment WHERE `SLBAssignment`.`uploadedFileId` = :id;

/**
 * Select statement for SLBAssignment
*/
SELECT
	`SLBAssignment`.`uploadedFileId`,
	`SLBAssignment`.`name`,
	`SLBAssignment`.`feedback`
FROM `DigitalPortfolio`.`SLBAssignment`
WHERE `SLBAssignment`.`uploadedFileId` = :id;


/**
 * Insert statement for SLBAssignment
*/
INSERT INTO `DigitalPortfolio`.`SLBAssignment`( 
	`uploadedFileId`,
	`name`,
	`feedback`
) VALUES ( 
	:uploadedFileId,
	:name,
	:feedback
);

/*****************************************************************************************
 * Insert, update, delete and select statements for the table Skill.
 ****************************************************************************************/

/**
 * Select statement for Skill
*/
SELECT
	`Skill`.`id`,
	`Skill`.`name`,
	`Skill`.`levelOfExperience`,
	`Skill`.`portfolioId`
FROM `DigitalPortfolio`.`Skill`
;

/**
 * Update statement for Skill
*/
UPDATE Skill SET 
	`id` = :id,
	`name` = :name,
	`levelOfExperience` = :levelOfExperience,
	`portfolioId` = :portfolioId
WHERE `Skill`.`id` = :id;


/**
 * Delete statement for Skill
*/
DELETE FROM Skill WHERE `Skill`.`id` = :id;

/**
 * Select statement for Skill
*/
SELECT
	`Skill`.`id`,
	`Skill`.`name`,
	`Skill`.`levelOfExperience`,
	`Skill`.`portfolioId`
FROM `DigitalPortfolio`.`Skill`
WHERE `Skill`.`id` = :id;


/**
 * Insert statement for Skill
*/
INSERT INTO `DigitalPortfolio`.`Skill`( 
	`id`,
	`name`,
	`levelOfExperience`,
	`portfolioId`
) VALUES ( 
	:id,
	:name,
	:levelOfExperience,
	:portfolioId
);

/*****************************************************************************************
 * Insert, update, delete and select statements for the table Student.
 ****************************************************************************************/

/**
 * Select statement for Student
*/
SELECT
	`Student`.`userId`,
	`Student`.`address`,
	`Student`.`zipCode`,
	`Student`.`location`,
	`Student`.`dateOfBirth`,
	`Student`.`studentCode`,
	`Student`.`phoneNumber`
FROM `DigitalPortfolio`.`Student`
;

/**
 * Update statement for Student
*/
UPDATE Student SET 
	`userId` = :userId,
	`address` = :address,
	`zipCode` = :zipCode,
	`location` = :location,
	`dateOfBirth` = :dateOfBirth,
	`studentCode` = :studentCode,
	`phoneNumber` = :phoneNumber
WHERE `Student`.`userId` = :id;


/**
 * Delete statement for Student
*/
DELETE FROM Student WHERE `Student`.`userId` = :id;

/**
 * Select statement for Student
*/
SELECT
	`Student`.`userId`,
	`Student`.`address`,
	`Student`.`zipCode`,
	`Student`.`location`,
	`Student`.`dateOfBirth`,
	`Student`.`studentCode`,
	`Student`.`phoneNumber`
FROM `DigitalPortfolio`.`Student`
WHERE `Student`.`userId`;


/**
 * Insert statement for Student
*/
INSERT INTO `DigitalPortfolio`.`Student`( 
	`userId`,
	`address`,
	`zipCode`,
	`location`,
	`dateOfBirth`,
	`studentCode`,
	`phoneNumber`
) VALUES ( 
	:userId,
	:address,
	:zipCode,
	:location,
	:dateOfBirth,
	:studentCode,
	:phoneNumber
);

/*****************************************************************************************
 * Insert, update, delete and select statements for the table Teacher.
 ****************************************************************************************/

/**
 * Select statement for Teacher
*/
SELECT
	`Teacher`.`userId`,
	`Teacher`.`isSLBer`
FROM `DigitalPortfolio`.`Teacher`
;

/**
 * Update statement for Teacher
*/
UPDATE Teacher SET 
	`userId` = :userId,
	`isSLBer` = :isSLBer
WHERE `Teacher`.`userId` = :id;


/**
 * Delete statement for Teacher
*/
DELETE FROM Teacher WHERE `Teacher`.`userId` = :id;

/**
 * Select statement for Teacher
*/
SELECT
	`Teacher`.`userId`,
	`Teacher`.`isSLBer`
FROM `DigitalPortfolio`.`Teacher`
WHERE `Teacher`.`userId` = :id;


/**
 * Insert statement for Teacher
*/
INSERT INTO `DigitalPortfolio`.`Teacher`( 
	`userId`,
	`isSLBer`
) VALUES ( 
	:userId,
	:isSLBer
);

/*****************************************************************************************
 * Insert, update, delete and select statements for the table Theme.
 ****************************************************************************************/

/**
 * Select statement for Theme
*/
SELECT
	`Theme`.`id`,
	`Theme`.`author`,
	`Theme`.`description`,
	`Theme`.`directoryName`
FROM `DigitalPortfolio`.`Theme`
;

/**
 * Update statement for Theme
*/
UPDATE Theme SET 
	`id` = :id,
	`author` = :author,
	`description` = :description,
	`directoryName` = :directoryName
WHERE `Theme`.`id` = :id;


/**
 * Delete statement for Theme
*/
DELETE FROM Theme WHERE `Theme`.`id` = :id;

/**
 * Select statement for Theme
*/
SELECT
	`Theme`.`id`,
	`Theme`.`author`,
	`Theme`.`description`,
	`Theme`.`directoryName`
FROM `DigitalPortfolio`.`Theme`
WHERE `Theme`.`id` = :id;


/**
 * Insert statement for Theme
*/
INSERT INTO `DigitalPortfolio`.`Theme`( 
	`id`,
	`author`,
	`description`,
	`directoryName`
) VALUES ( 
	:id,
	:author,
	:description,
	:directoryName
);

/*****************************************************************************************
 * Insert, update, delete and select statements for the table Training.
 ****************************************************************************************/

/**
 * Select statement for Training
*/
SELECT
	`Training`.`id`,
	`Training`.`title`,
	`Training`.`institution`,
	`Training`.`location`,
	`Training`.`startedAt`,
	`Training`.`finishedAt`,
	`Training`.`description`,
	`Training`.`obtainedCertificate`,
	`Training`.`currentTraining`,
	`Training`.`portfolioId`
FROM `DigitalPortfolio`.`Training`
;

/**
 * Update statement for Training
*/
UPDATE Training SET 
	`id` = :id,
	`title` = :title,
	`institution` = :institution,
	`location` = :location,
	`startedAt` = :startedAt,
	`finishedAt` = :finishedAt,
	`description` = :description,
	`obtainedCertificate` = :obtainedCertificate,
	`currentTraining` = :currentTraining,
	`portfolioId` = :portfolioId
WHERE `Training`.`id` = :id;


/**
 * Delete statement for Training
*/
DELETE FROM Training WHERE `Training`.`id` = :id;

/**
 * Select statement for Training
*/
SELECT
	`Training`.`id`,
	`Training`.`title`,
	`Training`.`institution`,
	`Training`.`location`,
	`Training`.`startedAt`,
	`Training`.`finishedAt`,
	`Training`.`description`,
	`Training`.`obtainedCertificate`,
	`Training`.`currentTraining`,
	`Training`.`portfolioId`
FROM `DigitalPortfolio`.`Training`
WHERE `Training`.`id` = :id;


/**
 * Insert statement for Training
*/
INSERT INTO `DigitalPortfolio`.`Training`( 
	`id`,
	`title`,
	`institution`,
	`location`,
	`startedAt`,
	`finishedAt`,
	`description`,
	`obtainedCertificate`,
	`currentTraining`,
	`portfolioId`
) VALUES ( 
	:id,
	:title,
	:institution,
	:location,
	:startedAt,
	:finishedAt,
	:description,
	:obtainedCertificate,
	:currentTraining,
	:portfolioId
);

/*****************************************************************************************
 * Insert, update, delete and select statements for the table UploadedFile.
 ****************************************************************************************/

/**
 * Select statement for UploadedFile
*/
SELECT
	`UploadedFile`.`id`,
	`UploadedFile`.`fileName`,
	`UploadedFile`.`mimeType`,
	`UploadedFile`.`filePath`,
	`UploadedFile`.`portfolioId`
FROM `DigitalPortfolio`.`UploadedFile`
;

/**
 * Update statement for UploadedFile
*/
UPDATE UploadedFile SET 
	`id` = :id,
	`fileName` = :fileName,
	`mimeType` = :mimeType,
	`filePath` = :filePath,
	`portfolioId` = :portfolioId
WHERE `UploadedFile`.`id` = :id;


/**
 * Delete statement for UploadedFile
*/
DELETE FROM UploadedFile WHERE `UploadedFile`.`id` = :id;

/**
 * Select statement for UploadedFile
*/
SELECT
	`UploadedFile`.`id`,
	`UploadedFile`.`fileName`,
	`UploadedFile`.`mimeType`,
	`UploadedFile`.`filePath`,
	`UploadedFile`.`portfolioId`
FROM `DigitalPortfolio`.`UploadedFile`
WHERE `UploadedFile`.`id` = :id;


/**
 * Insert statement for UploadedFile
*/
INSERT INTO `DigitalPortfolio`.`UploadedFile`( 
	`id`,
	`fileName`,
	`mimeType`,
	`filePath`,
	`portfolioId`
) VALUES ( 
	:id,
	:fileName,
	:mimeType,
	:filePath,
	:portfolioId
);

/*****************************************************************************************
 * Insert, update, delete and select statements for the table User.
 ****************************************************************************************/

/**
 * Select statement for User
*/
SELECT
	`User`.`id`,
	`User`.`password`,
	`User`.`accountCreated`,
	`User`.`lastLogin`,
	`User`.`email`,
	`User`.`lastIpAddress`,
	`User`.`firstName`,
	`User`.`lastName`,
	`User`.`isAdmin`,
	`User`.`active`
FROM `DigitalPortfolio`.`User`
;

/**
 * Update statement for User
*/
UPDATE User SET 
	`id` = :id,
	`password` = :password,
	`accountCreated` = :accountCreated,
	`lastLogin` = :lastLogin,
	`email` = :email,
	`lastIpAddress` = :lastIpAddress,
	`firstName` = :firstName,
	`lastName` = :lastName,
	`isAdmin` = :isAdmin,
	`active` = :active
WHERE `User`.`id` = :id;


/**
 * Delete statement for User
*/
DELETE FROM User WHERE `User`.`id` = :id;

/**
 * Select statement for User
*/
SELECT
	`User`.`id`,
	`User`.`password`,
	`User`.`accountCreated`,
	`User`.`lastLogin`,
	`User`.`email`,
	`User`.`lastIpAddress`,
	`User`.`firstName`,
	`User`.`lastName`,
	`User`.`isAdmin`,
	`User`.`active`
FROM `DigitalPortfolio`.`User`
WHERE `User`.`id` = :id;


/**
 * Insert statement for User
*/
INSERT INTO `DigitalPortfolio`.`User`( 
	`id`,
	`password`,
	`accountCreated`,
	`lastLogin`,
	`email`,
	`lastIpAddress`,
	`firstName`,
	`lastName`,
	`isAdmin`,
	`active`
) VALUES ( 
	:id,
	:password,
	:accountCreated,
	:lastLogin,
	:email,
	:lastIpAddress,
	:firstName,
	:lastName,
	:isAdmin,
	:active
);

