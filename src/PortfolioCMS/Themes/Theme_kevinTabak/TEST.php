<php $student = $dataProvider->get( 'student' ); ?>
<!DOCTYPE html>
<html>
    <head>
        <title><?= $dataProvider->get( 'title' ) ?></title>
    </head>
    <body>
        <div class='portfolio'>
            <address>
            Name: <?= $student->getFirstName() ?>&nbsp;<?= $student->getLastName() ?><br />
            email: <? $student->getEmail() ?><br />
            Date of birth: <?= $student->getDateOfBirth()->format( 'Y-m-d H:i:s' ) ?><br />
            Phone number: <?= $student->getPhoneNumber() ?>
            </address>
        </div>
    </body>
</html>