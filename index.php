<html><?php session_start();?>
<head>
<script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="css/index.css" >
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
 <body style="background-color: #228B22;">
            <div class="container">
                <div class="row vertical-offset-100" >
                    <div class="col-md-4 col-md-offset-4" >
                        <div class="panel panel-default" style="background-color: #228B22;">
                                                           
                                <div class="row-fluid user-row" style="background-color: #228B22;">
                                    <img src="img/ifpec.png" class="img-responsive" id="logo"/>
                                </div>
                            
                            <div class="panel-body">
                                <form accept-charset="UTF-8" role="form" class="form-horizontal" action="php/LogarUsuario.php" method="POST">
                                    <fieldset>
                                        <label class="panel-login">
                                            <div class="login_result"></div>
                                        </label>
                                        <input class="form-control" placeholder="Cpf" name="cpf" required  type="text" >
                                        <input class="form-control" placeholder="Senha" name="senha" required type="password" style="margin-top:5px;">
                                        <?php 
										if(isset($_SESSION['errologin'])){
											echo "<center><h4 style='color:white;'>".$_SESSION['errologin']."</h4></center>";
											
										}
										
										?>
                                        <input class="btn btn-lg btn-success btn-block" type="submit" id="login" value="Login »" style="margin-top:10px;">
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>





</html>