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
            <img src="<?= $keys->logo ?>" alt="conference logo" class="img-fluid" style="width: 100%"/>
            <h2>Registration summary</h2>
            <div class="well">
                No paid registrations found for the email address <?= $keys->email ?>.
            </div>


        </div>
    </body>
</html>

