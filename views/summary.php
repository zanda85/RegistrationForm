<!DOCTYPE html>
<html>
    <head>
        <title>Registration - summary </title>
        <meta charset="ISO-8859-1">
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

            <?php if ($state == "nok" || $state == "pay") { ?>
                <form name="form_carta" class="form-horizontal" method="post" action="<?= $keys->numeraUrl ?>">
                <?php } ?>
                <img src="<?= $keys->logo ?>" alt="conference logo" class="img-fluid" style="width: 100%"/>


                <?php if ($state == "nok") { ?>
                <div class="alert alert-warning" style="margin-top:10px">
                        <strong>Warning!</strong> The registration payment did not complete successfully.  
                    </div>
                <?php } ?>
                <?php if ($state == "ok") { ?>
                <div class="alert alert-success" style="margin-top:10px">
                        <strong>Success!</strong> The registration is completed.  
                    </div>
                <?php } ?>
                <h2>Registration summary</h2>
                <div class="well">
                    <h3>Personal Info</h3>
                    <?= $p->prefix ?> <?= $p->firstname ?> <?= $p->middlename ?> <?= $p->lastname ?> <br/>
                    <?= $p->company ?> <br/>
                    <?= $p->addressline1 ?> <?= $p->addressline2 ?>, <?= $p->zip ?>, <?= $p->city ?>, <?= $p->country ?><br/>

                    <h3>Dietary requirements</h3>
                    <?= $p->getDietaryString() ?>

                    <h3>Fees</h3>
                    <ul>
                        <li><?= $p->getRegType()->title ?> (<?= $p->getRegType()->cost ?> &euro;)</li>
                        <?php foreach ($p->getWorkshops() as $w) { ?>
                            <li><?= $w->title ?> </li>
                        <?php } ?>
                        <?php foreach ($p->getExtras() as $e) { ?>
                            <li><?= ($e->count > 1 ? $e->count : '') ?> <?= $e->title ?> ( <?= $e->count ?> x <?= $e->cost ?>&euro;)</li>
                        <?php } ?>
                    </ul>
                    <strong style="font-size:2.0em">Total: <?= $p->getTotalCost() ?>&euro; </strong>





                </div>


                <?php if ($state == "nok" || $state == "pay") { ?>  
                    
                    <!-- input per numera -->
                    <input type="hidden" name="pol_vendor" value="<?= $keys->vendor ?>">
                    <input type="hidden" name="pol_keyord" value="<?= $p->id ?>">
                    <button id="continue" type="submit" class="btn btn-success center-block">Pay with credit card (<?= $p->getTotalCost() ?>&euro;)</button>
                </form>
            <?php } ?>
        </div>
    </body>
</html>

