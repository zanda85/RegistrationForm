<!DOCTYPE html>
<html>
    <head>
        <title>Registration - start registration</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <script src="js/jquery-3.2.1.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css" >
        <link rel="stylesheet" href="css/custom.css" >
        <script src="js/bootstrap.min.js"></script>
        
        <script src="js/personal.js"></script>
    </head>
    <body>
        <div class="container">
            
            <form class="form-horizontal" method="post" action="index.php">
                <img src="<?= $keys->logo ?>" alt="conference logo" class="img-fluid" style="width: 100%"/>
                <h2>Start your registration</h2>
                <div class="well">
                    <div class="form-group">
                        <label for="email1" class="col-sm-2 control-label" >Email *</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email1" name="email1" placeholder="your email" data-required="true">
                            <span id="email1-error" class="has-error help-block hidden">This field is required</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email2" class="col-sm-2 control-label">Verify Email *</label>
                        <div class="col-sm-10">
                            <input type="email"  class="form-control" id="email2" name="email2" placeholder="your email again" data-required="true">
                            <span id="email2-error" class="has-error help-block hidden">This field is required</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="regtype" class="col-sm-2 control-label">Select registant type *</label>
                        <div class="col-sm-10">
                            <select id="regtype"  class="form-control" name="regtype" data-required="true">
                                <option value=""></option>
                                <?php foreach ($regs as $reg){ ?>
                                <option value="reg<?= $reg->id ?>"><?= $reg->title ?> (<?= $reg->cost ?>€)</option>
                                <?php } ?>
                            </select>
                            <span id="country-error" class="has-error help-block hidden">This field is required</span>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="step" value="s1">
                <input type="hidden" name="conf" value="<?= $keys->conf ?>">
                <button id="continue" type="submit" class="btn btn-primary center-block">Continue</button>
                
            </form>
        </div>
    </body>
</html>
