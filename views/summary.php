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
                        <strong>Success!</strong> The registration is completed.  <br/>
                        We will send you a proper receipt or invoce by email as soon as possible.  
                    </div>
                <?php } ?>
                <h2>Registration summary</h2>
                <div class="well">
                    <h3>Personal Information</h3>
                    <?php if ($p->invoiceType == 0) { ?>
                        <?= $p->prefix ?> <?= $p->firstname ?> <?= $p->middlename ?> <?= $p->lastname ?> <br/>
                        <?= $p->company ?> <br/>
                        <?= $p->addressline1 ?> <?= $p->addressline2 ?>, <?= $p->zip ?>, <?= $p->city ?>, <?= $p->country ?><br/>
                    <?php } ?>
                    <?php if ($p->invoiceType == 1) { ?>
                        <?= $p->prefix ?> <?= $p->firstname ?> <?= $p->middlename ?> <?= $p->lastname ?> 
                        <h3>Billing Information</h3>
                        <?= $p->company ?> <br/>
                        <?= $p->addressline1 ?> <?= $p->addressline2 ?>, <?= $p->zip ?>, <?= $p->city ?>, <?= $p->country ?><br/>
                        VAT number:  <?= $p->vat ?>
                    <?php } ?>
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
                    <button id="continue" type="submit" class="btn btn-success center-block">
                        Pay with credit card (<?= $p->getTotalCost() ?>&euro;)
                    </button>
                    <div style="text-align: center; margin-top:20px">
                        or <a href="#" id="btn-bank" data-toggle="modal" 
                              data-target="#bankModal" >
                            Pay with bank transfer
                        </a>
                    </div>
                </form>
            <?php } ?>
        </div>
        <div id="bankModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">How to pay the registration with a bank transfer</h4>
                    </div>
                    <div class="modal-body">
                        <p>It is possible to pay the registration fee with a 
                            bank transfer. There are two possible options:
                        </p>
                        <ol>
                            <li>
                                Bank transfer to "Dipartimento di Matematica e Informatica".<br/>
                                IBAN: IT57Q0101504800000000043247<br/>
                                Please use "Quota iscrizione convegno <?=$keys->conf?> 
                                <?= $p->firstname ?> <?= $p->lastname ?>" as the description of the transfer.
                            </li>
                            <li>
                                If your University has an account at 
                                "Banca d'Italia" (Italian national Bank), it is 
                                also possible to do a transfer entry (giroconto) 
                                at "conto di Tesoreria Unica n. 0037390 (BANKIT)"
                            </li>
                        </ol>
                        <p>Once you completed the transfer, please send a copy 
                            of the receipt to the conference organisers.
                        </p>
                        <p>If you have any questions or problems, please contact 
                            the Department Secretary 
                            <a href="mailto:stefaniacurto@amm.unica.it">
                                Stefania Curto
                            </a>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>

