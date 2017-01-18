# Portfolio pages

### Portfolio overzicht ( Admin | student | Teacher | SLB teacher )
__Student__  __Admin__ An page where the student can see lists on all the items in the portfolio and where he can chose to add, edit and delete items. to 
 add an item an student goes to an add{itemName} page where he can add the new items. to edit an item the student goes to edit{itemName} page where he can edit the item.
 An admin and student can also edit his theme, url and title on this page.
__SLB teacher__ An page where the SLB teacher can see the SLB assignments and where he can add feedback to each item. and where he can give an grade for 
the whole portfolio ? Maybe we can do this in the portfolio ?
__Teacher__ An page where he can see all the students projects and can assign an grade to them. 

_Route_ /admin/portfolioOverzicht/{id}

### edit{itemName} ( Admin | Student )
__Student__  __Admin__ An page where the student can edit portfolio items.

_Route_ /admin/editItem/{id}

### add{itemName} ( Admin | Student )
__Student__  __Admin__ An page where the student can add portfolio items.

_Route_ /admin/addItem/{id}

### Portfolios overzicht ( admin | Teacher | SLB Teacher )
__Admin__ An list with all the portfolios where the admin can select an student portfolio and can edit delete and add an portfolio.
__SLB Teacher__ An list with all the portfolios where the SLB teacher can select an portfolio witch redirects to the Portfolio overzicht page.
__Teacher__ An list with all the portfolios where the teacher can select an portfolio witch redirects to the Portfolio overzicht page.

_Route_ /admin/portfoliosOverzicht

### Cijfer administratie ( Admin | SLB Teacher | Teacher | Student )
__Student__ __SLB Teacher__ __Teacher__ __Admin__ An page where he can se all his/the students grades.

_Route_ /admin/cijferAdministratie/{id}

### Cijfers Overzicht ( Admin | SLB Teacher | Teacher )
__SLB Teacher__ __Teacher__ __Admin__ An page where he can se all students and he can select one that will redirect him to the Cijfer administratie page.
 
 _Route_ /admin/cijfersOverzicht

# Table with pages
| Page                 | fileName                | Authorizatoin                         | Route                           | Data available     | 
|----------------------|-------------------------|---------------------------------------|---------------------------------|--------------------| 
| Portfolio overzicht  | portfolioOverzicht.php  | Admin, SLB Teacher, Teacher, Student  | /admin/portfolioOverzicht/{id}  | portfolio-data     | 
| Portfolios ovezicht  | portfoliosOverzicht.php | Admin, SLB Teacher, Teacher           | /admin/portfoliosOverzicht      | cortfolios-data    | 
| Cijfer administratie | cijferAdministratie.php | Admin, SLB Teacher, Teacher, Student  | /admin/cijferAdministratie/{id} | cijfer-data        | 
| Cijfers overzicht    | cijfersOverzicht.php    | Admin, SLB Teacher, Teacher           | /admin/cijfersOverzicht         | cijfers-data       | 
|                      |                         |                                       |                                 |                    | 
| Edit skill           | editSkill.php           | Admin, Student                        | /admin/editSkill/{id}           | Skill-data         | 
| Edit Training        | editTraining.php        | Admin, Student                        | /admin/editTraining/{id}        | Training-data      | 
| Edit Hobby           | editHobby.php           | Admin, Student                        | /admin/editHobby/{id}           | Hobby-data         | 
| Edit Language        | editLanguage.php        | Admin, Student                        | /admin/editLanguage{id}         | Language-data      | 
| Edit JobExperience   | editJobExperience.php   | Admin, Student                        | /admin/editJobExperience/{id}   | Jobexperience-data | 
| Edit SLBAssignment   | editSlbAssignment.php   | Admin, Student                        | /admin/editSlbAssignment/{id}   | Slbassignment-data | 
| Edit Image           | editImage.php           | Admin, Student                        | /admin/editImage/{id}           | Image-data         | 
| Edit Project         | editProject.php         | Admin, Student                        | /admin/editProject/{id}         | Project-data       | 
|                      |                         |                                       |                                 |                    | 
| Add skill            | addSkill.php            | Admin, Student                        | /admin/addSkill/{id}            |                    | 
| Add Training         | addTraining.php         | Admin, Student                        | /admin/addTraining/{id}         |                    | 
| Add Hobby            | addHobby.php            | Admin, Student                        | /admin/addHobby/{id}            |                    | 
| Add Language         | addLanguage.php         | Admin, Student                        | /admin/addLanguage{id}          |                    | 
| Add JobExperience    | addJobExperience.php    | Admin, Student                        | /admin/addJobExperience/{id}    |                    | 
| Add SLBAssignment    | addSlbAssignment.php    | Admin, Student                        | /admin/addSlbAssignment/{id}    |                    | 
| Add Image            | addImage.php            | Admin, Student                        | /admin/addImage/{id}            |                    | 
| Add Project          | addProject.php          | Admin, Student                        | /admin/addProject/{id}          |                    | 

# Data available
| Data name          | type               | description                                 | 
|--------------------|--------------------|---------------------------------------------| 
| portfolio-data     | Portfolio()        | The same as on the portolios                | 
| Portfolios-data    | EntityCollection   | Entity collection with Portfolio() objects  | 
| cijfer-data        | ParameterContainer | Just an array with all grades and item name | 
| cijfers-data       | ParameterContainer | Just an array with cijfer-data arrays       | 
| skill-data         | Skill()            | The same as on the portolios                | 
| training-data      | Training()         | The same as on the portolios                | 
| hobby-data         | Hobby()            | The same as on the portolios                | 
| language-data      | Language()         | The same as on the portolios                | 
| jobExperience-data | jobexperience()    | The same as on the portolios                | 
| slbAssignment-data | SlbAssignment()    | The same as on the portolios                | 
| image-data         | Image()            | The same as on the portolios                | 
| project-data       | Project()          | The same as on the portolios                | 
To access grade data you can use:
```php
<div>
    <?= $dataProvider->get( 'grade-data' )->get( 'grade' ) ?>
    <?= $dataProvider->get( 'grade-data' )->get( 'cource' ) ?>
    <?= $dataProvider->get( 'grade-data' )->get( 'teacher' ) ?>
    <?= $dataProvider->get( 'grade-data' )->get( 'studentName' ) ?>
    <!-- OR like this wich is safer -->
    <?= $dataProvider->call( 'grade-data', 'get', [ 'grade' ] ) ?>
    <?= $dataProvider->call( 'grade-data', 'get', [ 'cource' ] ) ?>
    <?= $dataProvider->call( 'grade-data', 'get', [ 'teacher' ] ) ?>
    <?= $dataProvider->call( 'grade-data', 'get', [ 'studentName' ] ) ?>
</div>
```
To access grades data you can use
```php
<div>
    <?php foreach( $dataProvider->get( 'grades-data' ) as $grade ): ?>
        <div>
            <?= $grade->get( 'grade' ) ?>
            <?= $grade->get( 'grade-data' )->get( 'cource' ) ?>
            <?= $grade->get( 'grade-data' )->get( 'teacher' ) ?>
            <?= $grade->get( 'grade-data' )->get( 'studentName' ) ?>
        </div>
    <?php endforeach; ?>
</div>
```