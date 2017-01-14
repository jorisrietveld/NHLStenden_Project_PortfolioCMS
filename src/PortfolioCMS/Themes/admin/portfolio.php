<!doctype html>
<?php

$page_title = "Portfolio | Admin ";
$isOnAdminPage = "portfolio";

include 'header.php'; ?>
<body>

<?php include 'navigation.php' ?>

<div class="content">
    <div class="container-fluid">
        <h3>Portfolio instellingen</h3>
        <hr>
        <form id="portfolioForm" method="POST" action="">
            <!-- Values still need to be set automatically -->
            <label>Titel:</label><input type="text" name="title" value="#"><br>
            <label>Url:</label><input type="text" name="url" value="#"><br>

            <label></label><select name="theme">
                <option value="theme 1">Theme 1</option>
                <option value="theme 2">Theme 2</option>
                <option value="theme 3">Theme 3</option>
                <option value="theme 4">Theme 4</option>
                <option value="theme 5">Theme 5</option>
            </select><br>
            <label></label><input type="submit" value="submit">
        </form>
    </div>
</div>

<?php include 'footer.php' ?>

</body>

<?php include 'scripts.php' ?>

</html>
