<!doctype html>
<?php
$page_title = "Portfolio | Admin";
$isOnAdminPage = "portfolio";
include 'header.php';
?>
<body>

<?php include 'navigation.php' ?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title text-center">
                            <strong>
                                <i class="fa fa-pencil-square-o"></i> Taal aanpassen
                            </strong>
                        </h4>
                        <hr class="style-one"/>
                        <div class="col-sm-5 custom-buttons">
                            <a href="portfolioOverzicht">
                                <button class="btn btn-md btn-primary btn-block btn-custom">
                                    <i class="fa fa-arrow-left"></i> Terug
                                </button>
                            </a>
                        </div>
                        <div class="clearfix"></div>
                        <div class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <form class="form-custom float-left" action="" method="POST">

                                            <div class="form-group">
                                                <label class="form-label col-lg-3" for="inputEmail">Taal:</label>
                                                <input type="text"
                                                       name="language"
                                                       class="form-control"
                                                       id="language"
                                                       value="<?= $dataProvider->call('language-data','getLanguage') ?>"
                                                       required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="form-label col-lg-3" for="inputEmail">Level(1-10)</label>
                                                <input type="text"
                                                       name="level"
                                                       class="form-control"
                                                       id="langlevel"
                                                       value="<?= $dataProvider->call('language-data','getLevel') ?>"
                                                       required>
                                            </div>
                                            
                                              <div class="form-group">
                                                <label class="form-label col-lg-3" for="inputEmail">Is het de moedertaal?</label>
                                               <select required  class="form-control" name="isNative">
                                                    <option value="<?= $dataProvider->call('language-data','getIsIsNative') ?>">
                                                        <?php if( $dataProvider->call('language-data','getIsIsNative')=== true){
                                                              echo"Ja";
                                                        }else{echo"Nee";} ?></option>
                                                    
                                                    <option value=" <?php if( $dataProvider->call('language-data','getIsIsNative')=== true){
                                                              "Nee";
                                                        }else{"Ja";} ?>">
                                                        <?php if( $dataProvider->call('language-data','getIsIsNative')=== true){
                                                              echo"Nee";
                                                        }else{echo"Ja";} ?></option>
                                           
                                                   
                                                </select>
                               
                                               
                                             
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6 clearfix"><br/></div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-custom">Opslaan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php' ?>

</body>

<?php include 'scripts.php' ?>

</html>