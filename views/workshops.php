<!DOCTYPE html>
<html>
    <head>
        <title>Registration - workshops and extras </title>
        <meta charset="ISO-8859-1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/bootstrap.min.js" ></script>
        <script src="js/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="css/custom.css" >
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css" >
        <link rel="stylesheet" href="css/jquery-ui.min.css" >
        <link rel="stylesheet" href="css/jquery-ui.structure.min.css" >
        <link rel="stylesheet" href="css/jquery-ui.theme.min.css" >
        
        
        
        <script src="js/personal.js"></script>
    </head>
    <body>
        <div class="container">
            
            <form class="form-horizontal" method="post" action="index.php">
                <img src="<?= $keys->logo ?>" alt="conference logo" class="img-fluid" style="width: 100%"/>
                
                <h2>Select workshops</h2>
                <div class="well">
                    <?php if(count($workshops) > 0 ) { 
                          foreach ($workshops as $w) {
                        ?>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="w<?=$w->id?>" name="w[]"
                                    <?= $p->hasWorkshop($w->id) ? "checked='checked'" : "" ?>>
                                <?= $w->title ?>
                            </label>
                        </div>
                        
                    <?php
                          }
                        }else{ ?>
                         <div class="col-sm-10">
                             You can't register to any workshop in this conference. <br/>
                          </div>
                    <?php } ?>
                </div>
                <h2>Select extras</h2>
                <div class="well">
                    <?php if(count($extras) > 0 ) { 
                          foreach ($extras as $e) {
                        ?>
                        <div class="checkbox">
                            <input id ="e<?= $e->id ?>" value="<?=$p->getExtraCount($e->id)?>" 
                                   class="spinner" name="e<?= $e->id ?>" min="0">
                            <label for="e<?= $e->id ?>">
                                <?= $e->title ?> ( + <?= $e->cost ?>&euro;)
                            </label>
                        </div>
                        
                    <?php
                          }
                        }else{ ?>
                         <div class="col-sm-10">
                             You can't add any extra to your registration in this conference. <br/>
                          </div>
                    <?php } ?>
                </div>
                <input type="hidden" name="step" value="s3">
                <input type="hidden" name="conf" value="<?= $keys->conf ?>">
                <input type="hidden" name="partId" value="<?= $p->id ?>">
                <button id="continue" type="submit" class="btn btn-primary center-block">Checkout</button>
                
            </form>
        </div>
    </body>
</html>

