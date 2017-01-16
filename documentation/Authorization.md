# Authorization level explanation
<!-- START doctoc generated TOC please keep comment here to allow auto update -->
<!-- DON'T EDIT THIS SECTION, INSTEAD RE-RUN doctoc TO UPDATE -->
**Table of Contents**

- [Portfolio CMS authorization](#portfolio-cms-authorization)
- [The admin panel](#the-admin-panel)
    - [Guest](#guest)
    - [Student](#student)
    - [Teacher](#teacher)
    - [SLB Teacher](#slb-teacher)
    - [Admin](#admin)
- [Administration pages per authorization level](#administration-pages-per-authorization-level)
    - [Student](#student-1)
    - [Teacher](#teacher-1)
    - [SLB Teacher](#slb-teacher-1)
    - [Admin](#admin-1)
- [Pages needed](#pages-needed)

<!-- END doctoc generated TOC please keep comment here to allow auto update -->
# Portfolio CMS authorization
The portfolio cms has multiple authorization levels:
* Admin
* SLB teacher
* Teacher 
* Student
* Guest
each level has its own tasks and things it can view. The dataProvider has some methods to check the current authorization is:
* `$dataProvider->isAdmin() : bool` Checks if the current session holds an admin account.
* `$dataProvider->isSlbTeacher() : bool` Checks if the current session holds an SLB teacher account.
* `$dataProvider->isTeacher() : bool` Checks if the current session holds an teacher account.
* `$dataProvider->isStudent() : bool` Checks if the current session holds an student account.
* `$dataProvider->isGuest() : bool` Checks if there is no current authenticated session.
* `$dataProvider->isOwnOrSlbTeacher() : bool` Checks if the current session holds an account matching the current portfolio or an SLB taacher/admin account.
* `$dataProvider->isAtLeasedSlbTeacher() : bool` Checks if the current session holds an SLB teacher or admin account.
* `$dataProvider->isAtLeasedTeacher() : bool` Checks if the current session holds an teacher, SLB tacher or admin account.
* `$dataProvider->isAtLeasedStudent() : bool` Checks if the current session holds an student, teacher, SLB teacher or admin account.

# The admin panel
An authenticated user has access to the administraton panel where he can edit the CMS its data for witch he has authorization for.
Below there is an list of the pages avalilable grouped by the authorization level.

### Guest
* view home
* view contact
* view login
* view all portfolio's

### Student
* view home
* view contact
* view login
* view all portfolio's
* admin - manage own account
* admin - manage own profile
* admin - manage SLB assingments
* admin - view own portfolio/slbAssignment grades
* admin - manage guestbook messages

### Teacher
* view home
* view contact
* view login
* view all portfolio's
* admin - manage own account
* admin - manage student project grades
* admin - view students portfolio/slbAssignment students grades

### SLB Teacher
* view home
* view contact
* view login
* view all portfolio's
* admin - manage own account
* admin - mangage portfolio grades
* admin - manage students SLB assignment feedback
* admin - view students portfolio/slbAssignment students grades
* admin - view students SLB assingments

### Admin
* view home
* view contact
* view login
* view all portfolio's
* admin - manage teacher/student/admin accounts
* admin - manage students guestbook messages
* admin - manage students portfolios
* admin - manage students SLB assingments
* admin - manage students grades
# Administration pages per authorization level

# Admin actions for each authorization level

### Guest :cop:
* none

### Student
* Edit account
* Edit portfolio
* Edit/add/delete SLB assingments
* Edit/delete guestbook messages

### Teacher
* Edit account
* Edit/add/delete project grades

### SLB Teacher
* Edit account
* Edit/add/delete SLB assingment feedback
* Edit/add/delete portfolio grade

### Admin
* Edit/add/delete users (students and teachers)
* Edit/add/delete portfolios
* Edit/add/delete slb assignments
* Edit/add/delete guestbook messages
* Edit/add/delete grades

# Pages needed
 - Accounts overview (admin) 
    - Edit account (admin | SLB teacher | teacher | student)
 - Portfolios overview ( admin | SLB teacher | teacher )
    - Edit portfolio ( admin | student )
    - Edit SLB assingments ( admin | student )
    - Edit project grades ( admin | teacher )
    - Edit SLB assignment feedback ( admin | SLB teacher )
    - Edit guestbook messages ( admin | student )
