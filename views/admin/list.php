<!DOCTYPE html>
<html>
    <head>
        <title>Admin - Participants</title>
        <meta charset="ISO-8859-1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <script src="js/jquery-3.2.1.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css" >
        <link rel="stylesheet" href="css/custom.css" >
        <script src="js/bootstrap.min.js"></script>

        <script src="js/personal.js"></script>
    </head>
    <body style="padding-top: 70px;">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="http://dipartimenti.unica.it/matematicaeinformatica/">Dipartimento di Matematica e Informatica</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="admin.php?cmd=list">Conference List</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="admin.php?cmd=logout">Logout</a></li>
                    </ul>
                </div>
        </nav>
        <div class="container-fluid">
            <div class="page-header">
                <h1><?= $conference->title ?></h1>
            </div>
            <p><?= sizeof($participants) ?> registrations in total, <?= $sum ?> &euro; paid.</p>
            <div class="well">
                <form action="admin.php" method="get">
                    <div class="row">
                        <input type="hidden" name="cmd" value="conf"/>
                        <input type="hidden" name="id" value="<?= $conference->id ?>"/>
                        <div class="form-group">
                            <label for="state" class="col-sm-2 control-label">Registration state</label>
                            <div class="col-sm-10">
                                <select id="state" name="state" class="form-control">
                                    <option value="-1" <?= $state == -1 ? 'selected' : '' ?> >All</option>
                                    <option value="-2" <?= $state == -2 ? 'selected' : '' ?> >Completed (all payment methods)</option>
                                    <option value="0"  <?= $state == 0 ? 'selected' : '' ?>>Not completed</option>
                                    <option value="1"  <?= $state == 1 ? 'selected' : '' ?>>Credit card</option>
                                    <option value="2"  <?= $state == 2 ? 'selected' : '' ?>>Bank transfer</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-xs-12">
                            <div  class="text-center">
                                <button id="update" type="submit" class="btn btn-primary">Update</button>
                                <button id="download" type="submit" class="btn btn-success" name="download">Download as CSV</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="table-responsive">          
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Email</th>
                            <th>Cost</th>
                            <th>State</th>
                            <th>Company</th>
                            <th>Birth Date</th>
                            <th>Birth Place</th>
                            <th>CF</th>
                            <th>VAT</th>
                            <th>Address</th>
                            <th>ZIP</th>
                            <th>City</th>
                            <th>Co.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $c = 1;
                        foreach ($participants as $p) {
                            ?>
                            <tr>
                                <td><?= $p->id ?></td>
                                <td><?= $p->lastname ?></td>
                                <td><?= $p->middlename ?> <?= $p->firstname ?></td>
                                <td><?= $p->email ?></td>
                                <td><?= $p->getTotalCost() ?></td>
                                <td><?= $p->getStateString() ?><br/>
                                    <?php if ($p->state == 0) { ?>
                                        <form action="admin.php" method="get">
                                            <input type="hidden" name="state" value="<?= $state ?>"/>
                                            <input type="hidden" name="cmd" value="conf"/>
                                            <input type="hidden" name="id" value="<?= $conference->id ?>"/>
                                            <input type="hidden" name="pid" value="<?= $p->id ?>"/>
                                            <button id="paid" type="submit" class="btn btn-success" name="paid">
                                                <span class="glyphicon glyphicon-ok" title="Set as paid"></span>
                                            </button>
                                        </form>
                                    <?php } ?>
                                </td>
                                <td><?= $p->company ?></td>
                                <td><?= $p->birthDate ?></td>
                                <td><?= $p->birthPlace ?></td>
                                <td><?= $p->cf ?></td>
                                <td><?= $p->vat ?></td>
                                <td><?= $p->addressline1 ?><br/><?= $p->addressline2 ?></td>
                                <td><?= $p->zip ?></td>
                                <td><?= $p->city ?></td>
                                <td><?= $p->country ?></td>
                            </tr>
                            <?php
                            $c++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
