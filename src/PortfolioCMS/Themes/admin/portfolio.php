<!doctype html>
<?php

$page_title = "Overzicht | Admin";
$isOnAdminPage = "portfolio";

// PER STUDENT, INFO SCHERMEN MET HOBBY, TRAINING, ETC IN COLUMNS

include 'header.php'; ?>
<body>

<?php include 'navigation.php' ?>

<div class="content">
    <div class="">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title text-center">
                            <strong>
                            <?php if( $dataProvider->isAtLeasedTeacher() ):?>
                                Portfolio van <?= $dataProvider->call( 'student', 'getFirstName' ) . ' ' . $dataProvider->call( 'student', 'getLastName' ) ?>
                            <?php else : ?>
                                Mijn portfolio
                            <?php endif; ?>
                            </strong>
                        </h4>
                        <hr class="style-one"/>
                        <div class="col-sm-5 custom-buttons">

                        </div>
                        <div class="content table-responsive table-full-width">
                        <?php
                        /* This is to show what data is available in the portfolio to output
                         * You can remove it
                         */
                        dump( $dataProvider->all() );
                        ?>

                        <?php if( $dataProvider->isOwnOrAdmin() ) : ?>
                            <div>
                                <!-- Show form to edit the portolio: url, theme, title -->


                                <!-- Show lists with all the items in the portfolio with buttons for editing and deleting items
                                    Above each list with items place een button that redirects to the add{itemName} pages.

                                    The links to the edit pages should include the item id like:
                                    /admin/editSkill/{echo the skill id here}

                                    The links to the add pages should contain the portfolioId like:
                                    /admin/addSkill/{echo portfolio id here}
                                -->
                                <?php if ( $dataProvider->hasFeedback() ) : ?>
                                    <div class="alert alert-<?= $dataProvider->get( 'feedback-type' ) ?>">
                                        <span><?= $dataProvider->get( 'feedback' ) ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php elseif ( $dataProvider->isSlbTeacher() ) : ?>
                            <div>
                                <!-- Show the slb assignments here where the SLB teacher can add an grade and feedback to them -->
                            </div>
                        <?php elseif ( $dataProvider->isTeacher() ) : ?>
                            <div>
                                <!-- Show the projects here so the teacher can add an grade to them -->
                            </div>
                        <?php endif; ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>
<?php include 'scripts.php' ?>
</body>
</html>
