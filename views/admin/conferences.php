<!DOCTYPE html>
<html>
    <head>
        <title>Admin - Conferences</title>
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
   <body style="padding-top: 70px;">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="http://dipartimenti.unica.it/matematicaeinformatica/">Dipartimento di Matematica e Informatica</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Conference List</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="admin.php?cmd=logout">Logout</a></li>
                    </ul>
                </div>
        </nav>
        <div class="container-fluid">
            <div class="page-header">
                <h1>Conference List</h1>
            </div>
            <div class="well">
                <ul>
                    <?php foreach ($conferences as $c) { ?>
                        <li><a href="admin.php?cmd=conf&id=<?= $c->id ?>"><?= $c->title ?></a></li>
                    <?php } ?>
                </ul>
            </div>
    </body>
</html>
