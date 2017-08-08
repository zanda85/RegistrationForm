<!DOCTYPE html>
<html>
    <head>
        <title>Admin - Login</title>
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
            </div>
        </nav>
        <div class="container-fluid">
            <div class="page-header">
                <h1>Login</h1>
            </div>
            <form class="form-horizontal" method="post" action="admin.php">
               
                <div class="well">
                    <div class="form-group">
                        <label for="email1" class="col-sm-2 control-label" >Username </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="user" name="user">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">Password </label>
                        <div class="col-sm-10">
                            <input type="password"  class="form-control" id="password" name="password">
                        </div>
                    </div>
                </div>
                <input type="hidden" name="cmd" value="login" />
                <button id="continue" type="submit" class="btn btn-primary center-block">Login</button>
            </form>
        </div>
    </body>
</html>
