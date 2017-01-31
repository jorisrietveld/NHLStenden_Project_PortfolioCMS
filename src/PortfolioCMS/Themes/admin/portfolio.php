<!doctype html>
<?php

$page_title = "Overzicht | Admin";
$pageName = "portfolio";
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
                        <div class="content table-responsive table-full-width">
                            <?php if ( $dataProvider->isOwnOrAdmin() ) : ?>
                            <h4 class="title text-center">
                                <strong>
                                    <?php if ( $dataProvider->isAtLeasedTeacher() ): ?>
                                        Portfolio van <?= $dataProvider->call( 'student', 'getFirstName' ) . ' ' . $dataProvider->call( 'student', 'getLastName' ) ?>
                                    <?php else : ?>
                                        Mijn Portfolio
                                    <?php endif; ?>
                                </strong>
                            </h4>
                            <hr class="style-one"/>
                            <form class="form-custom float-left" action="" method="POST">
                                <?php if ( $dataProvider->hasFeedback() ) : ?>
                                    <div class="alert alert-<?= $dataProvider->get( 'feedback-type' ) ?>">
                                        <span><?= $dataProvider->get( 'feedback' ) ?></span>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <br />
                                    <label class="form-label col-lg-3" for="title">Titel:</label>
                                    <input type="text"
                                           name="title"
                                           class="form-control"
                                           id="title"
                                           pattern="{3,40}"
                                           placeholder="De titel"
                                           title="Het veld mag alleen letters bevatten en tussen de 3 - 40 karakters zijn"
                                           value="<?= $dataProvider->get( 'title' ) ?>"
                                           required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label col-lg-3" for="url">Url</label>
                                    <input type="text"
                                           name="url"
                                           class="form-control"
                                           id="url"
                                           placeholder="mijn_portfolio"
                                           pattern="{3,40}"
                                           title="Het veld moet tussen de 3 -40 karakters zijn"
                                           value="<?= $dataProvider->get( 'url' ) ?>"
                                           required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label col-lg-3" for="themeId">Thema</label>
                                    <select required class="form-control" name="themeId" id="themeId">
                                        <?php foreach ($dataProvider->get( 'themes' ) as $theme) : ?>
                                            <option value="<?= $theme->getId() ?>" <?= $dataProvider->call( 'current-theme', 'getId' ) == $theme->getId() ? 'selected="selected"' : '' ?>><?= $theme->getName() ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 clearfix"><br/></div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-custom">Wijzigingen opslaan</button>
                            </form>
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                            <h4 class="title text-center">
                                <strong>
                                    Werkervaringen
                                </strong>
                            </h4>
                            <hr class="style-one"/>
                            <div class="col-sm-5 custom-buttons">
                                <a href="../addJobExperience/<?= $dataProvider->get( 'id' ) ?>">
                                    <button class="btn btn-md btn-primary btn-block btn-custom">
                                        <i class="fa fa-plus"></i> Werk ervaring toevoegen
                                    </button>
                                </a>
                            </div>
                            <table class="table table-hover table-custom-portfolio">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Locatie</th>
                                    <th>Beschrijving</th>
                                    <th>Type</th>
                                    <th>Aanpassen</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($dataProvider->get( 'jobExperiences', [] ) as $jobExperience): ?>
                                    <tr>
                                        <td><?= $jobExperience->getId() ?></td>
                                        <td><?= $jobExperience->getLocation() ?></td>
                                        <td><?= $jobExperience->getDescription() ?></td>
                                        <td><?= $jobExperience->getIsInternship() ? 'Stage' : 'Baan' ?></td>
                                        <td>
                                            <a href="../editJobExperience/<?= $jobExperience->getId() ?>">
                                                <button class="btn btn-md btn-primary btn-block btn-custom">
                                                    <i class="fa fa-edit"></i>
                                                    <span class="out_window">Bewerk</span>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                                </div></div>

                            <br>
                            <h4 class="title text-center">
                                <strong>
                                    Talen
                                </strong>
                            </h4>
                            <hr class="style-one"/>
                            <div class="col-sm-5 custom-buttons">
                                <a href="../addLanguage/<?= $dataProvider->get( 'id' ) ?>">
                                    <button class="btn btn-md btn-primary btn-block btn-custom">
                                        <i class="fa fa-plus"></i> Talen toevoegen
                                    </button>
                                </a>
                            </div>
                            <table class="table table-hover table-custom-portfolio">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Taal</th>
                                    <th>Niveau</th>
                                    <th>Moeder taal?</th>
                                    <th>Aanpassen</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($dataProvider->get( 'languages', [] ) as $language): ?>
                                    <tr>
                                        <td><?= $language->getId() ?></td>
                                        <td><?= $language->getLanguage() ?></td>
                                        <td><?= $language->getLevel() ?></td>
                                        <td><?= $language->getIsIsNative() ? 'Ja' : 'Nee' ?></td>
                                        <td>
                                            <a href="../editLanguage/<?= $language->getId() ?>">
                                                <button class="btn btn-md btn-primary btn-block btn-custom">
                                                    <i class="fa fa-edit"></i>
                                                    <span class="out_window">Bewerk</span>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>

                            <br>
                            <h4 class="title text-center">
                                <strong>
                                    Opleidingen
                                </strong>
                            </h4>
                            <hr class="style-one"/>
                            <div class="col-sm-5 custom-buttons">
                                <a href="../addTraining/<?= $dataProvider->get( 'id' ) ?>">
                                    <button class="btn btn-md btn-primary btn-block btn-custom">
                                        <i class="fa fa-plus"></i> Opleidingen toevoegen
                                    </button>
                                </a>
                            </div>
                            <table class="table table-hover table-custom-portfolio">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Titel</th>
                                    <th>Institutie</th>
                                    <th>Locatie</th>
                                    <th>Beschrijving</th>
                                    <th>Diploma behaald</th>
                                    <th>Huidige opleiding</th>
                                    <th>Aanpassen</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($dataProvider->get( 'trainings', [] ) as $training): ?>
                                    <tr>
                                        <td><?= $training->getId() ?></td>
                                        <td><?= $training->getTitle() ?></td>
                                        <td><?= $training->getInstitution() ?></td>
                                        <td><?= $training->getLocation() ?></td>
                                        <td><?= $training->getDescription() ?></td>
                                        <td><?= $training->getObtainedCertificate() ? 'Ja' : 'Nee' ?></td>
                                        <td><?= $training->getCurrentTraining() ? 'Ja' : 'Nee' ?></td>
                                        <td>
                                            <a href="../editTraining/<?= $language->getId() ?>">
                                                <button class="btn btn-md btn-primary btn-block btn-custom">
                                                    <i class="fa fa-edit"></i>
                                                    <span class="out_window">Bewerk</span>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>

                            <br>
                            <h4 class="title text-center">
                                <strong>
                                    SLB Opdrachten
                                </strong>
                            </h4>
                            <hr class="style-one"/>
                            <div class="col-sm-5 custom-buttons">
                                <a href="../addSlbAssignment/<?= $dataProvider->get( 'id' ) ?>">
                                    <button class="btn btn-md btn-primary btn-block btn-custom">
                                        <i class="fa fa-plus"></i> SLB opdracht toevoegen
                                    </button>
                                </a>
                            </div>
                            <table class="table table-hover table-custom-portfolio">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Naam</th>
                                    <th>Feedback</th>
                                    <th>Aanpassen</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($dataProvider->get( 'slbAssignments', [] ) as $slbAssignment): ?>
                                    <tr>
                                        <td><?= $slbAssignment->getId() ?></td>
                                        <td><?= $slbAssignment->getName() ?></td>
                                        <td><?= $slbAssignment->getFeedback() ?></td>
                                        <td>
                                            <a href="../editSlbAssignment/<?= $slbAssignment->getId() ?>">
                                                <button class="btn btn-md btn-primary btn-block btn-custom">
                                                    <i class="fa fa-edit"></i>
                                                    <span class="out_window">Bewerk</span>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>

                            <br>
                            <h4 class="title text-center">
                                <strong>
                                    Afbeeldingen
                                </strong>
                            </h4>
                            <hr class="style-one"/>
                            <div class="col-sm-5 custom-buttons">
                                <a href="../addImage/<?= $dataProvider->get( 'id' ) ?>">
                                    <button class="btn btn-md btn-primary btn-block btn-custom">
                                        <i class="fa fa-plus"></i> Afbeeldingen toevoegen
                                    </button>
                                </a>
                            </div>
                            <table class="table table-hover table-custom-portfolio">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Naam</th>
                                    <th>Aanpassen</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($dataProvider->get( 'images' ) as $image): ?>
                                    <tr>
                                        <td><?= $image->getId() ?></td>
                                        <td><?= $image->getName() ?></td>
                                        <td>
                                            <a href="../editImage/<?= $image->getId() ?>">
                                                <button class="btn btn-md btn-primary btn-block btn-custom">
                                                    <i class="fa fa-edit"></i>
                                                    <span class="out_window">Bewerk</span>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>

                            <br>
                            <h4 class="title text-center">
                                <strong>
                                    Vaardigheden
                                </strong>
                            </h4>
                            <hr class="style-one"/>
                            <div class="col-sm-5 custom-buttons">
                                <a href="../addSkill/<?= $dataProvider->get( 'id' ) ?>">
                                    <button class="btn btn-md btn-primary btn-block btn-custom">
                                        <i class="fa fa-plus"></i> Vaardigheden toevoegen
                                    </button>
                                </a>
                            </div>
                            <table class="table table-hover table-custom-portfolio">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Naam</th>
                                    <th>Niveau</th>
                                    <th>Aanpassen</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($dataProvider->get( 'skills', [] ) as $skills ): ?>
                                    <tr>
                                        <td><?= $skills->getId() ?></td>
                                        <td><?= $skills->getName() ?></td>
                                        <td><?= $skills->getLevelOfExperience() ?></td>
                                        <td>
                                            <a href="../editSkill/<?= $skills->getId() ?>">
                                                <button class="btn btn-md btn-primary btn-block btn-custom">
                                                    <i class="fa fa-edit"></i>
                                                    <span class="out_window">Bewerk</span>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>

                            <br>
                            <h4 class="title text-center">
                                <strong>
                                    Projects
                                </strong>
                            </h4>
                            <hr class="style-one"/>
                            <div class="col-sm-5 custom-buttons">
                                <a href="../editProject/<?= $dataProvider->get( 'id' ) ?>">
                                    <button class="btn btn-md btn-primary btn-block btn-custom">
                                        <i class="fa fa-plus"></i> Projects toevoegen
                                    </button>
                                </a>
                            </div>
                            <table class="table table-hover table-custom-portfolio">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Naam</th>
                                    <th>Description</th>
                                    <th>Link</th>
                                    <th>imageId</th>
                                    <th>Aanpassen</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($dataProvider->get( 'projects' ) as $projects ): ?>
                                    <tr>
                                        <td><?= $projects->getId() ?></td>
                                        <td><?= $projects->getName() ?></td>
                                        <td><?= $projects->getDescription() ?></td>
                                        <td><?= $projects->getLink() ?></td>
                                        <td><?= $projects->getImageId() ?></td>
                                        <td>
                                            <a href="../editProject/<?= $projects->getId() ?>">
                                                <button class="btn btn-md btn-primary btn-block btn-custom">
                                                    <i class="fa fa-edit"></i>
                                                    <span class="out_window">Bewerk</span>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>

                            <br>
                            <h4 class="title text-center">
                                <strong>
                                    Hobbies
                                </strong>
                            </h4>
                            <hr class="style-one"/>
                            <div class="col-sm-5 custom-buttons">
                                <a href="../addHobby/<?= $dataProvider->get( 'id' ) ?>">
                                    <button class="btn btn-md btn-primary btn-block btn-custom">
                                        <i class="fa fa-plus"></i> Hobbies toevoegen
                                    </button>
                                </a>
                            </div>
                            <table class="table table-hover table-custom-portfolio">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Naam</th>
                                    <th>Aanpassen</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($dataProvider->get( 'hobbies', [] ) as $hobbies ): ?>
                                    <tr>
                                        <td><?= $hobbies->getId() ?></td>
                                        <td><?= $hobbies->getName() ?></td>
                                        <td>
                                            <a href="../editHobby/<?= $hobbies->getId() ?>">
                                                <button class="btn btn-md btn-primary btn-block btn-custom">
                                                    <i class="fa fa-edit"></i>
                                                    <span class="out_window">Bewerk</span>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>

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
