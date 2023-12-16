
<?php

require_once('scripts/AdminLogin.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="public/css/login.css">
</head>
<body>
   
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
           
            <!--- login form-->
            <div class="login-form bg-light">
                <h1 class="text-success">Admin Panel</h1>
                <p class="text-danger"><?= $login ?? ''; ?></p>
                <form method="post">
                    <div class=" mb-3 mt-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="emailAddress">
                    <p class="text-danger"><?= $validateLogin['emailErr'] ?? ''; ?></p>
                    </div>
                    
                    <div class=" mt-3 mb-3">
                    <label for="email">Password</label>
                    <input type="password" class="form-control" name="pass">
                    <p class="text-danger"><?= $validateLogin['passErr'] ?? ''; ?></p>
                    </div>
                    
                     <div class="row">
                        <div class="col-sm-6">
                        <div class="input-group mb-3 mt-3">
                            <label>
                                <a href="" class="text-success"> Forgot your Password</a>
                            </label>
                        </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="form-check input-group mb-3 mt-3">
                                <input class="form-check-input" type="checkbox"  name="remember"> 
                                 <label class="form-check-label"> Remember me Password</label>
                            </div>
                        </div>
                     </div>
                  
                    <button type="submit" name="login" class="btn btn-success">Login</button>
                </form>
            </div>
            <!---- login form-->
       </div>
       <div class="col-sm-6">
        <img src="public/images/login-page/admin.png" style="width: 80%" />

       </div>
    </div>
</div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</body>
</html>
