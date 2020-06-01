<?php



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>

        <div class="row mr-0">
            <div class="col-lg-8 col-md-8 ">
                <div class="card1">
                    <div class="row justify-content-center border-line"> <img src="../img/img-1.jpeg" class="image"> </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-10">

            <div class="row"> <h1 class="logo"> LOGO </h1></div>

               <form action="valida.php" class="form-signin" method="POST">
                <div class="row px-3"> 
                <label class="mb-1" for="inputEmail"> <h6 class="mb-0 text-sm">Email </h6> </label> 
                <input class="mb-4" type="email" name="email" id="inputEmail" placeholder="Email"> </div>
                <div class="row px-3" for="inpuPassword"> <label class="mb-1"> <h6 class="mb-0 text-sm">Senha</h6> </label> 
                <input type="password" name="password" placeholder="Password"> </div>
                <div class="row px-3 mb-4">
                <div class="custom-control custom-checkbox custom-control-inline"> 
                <input id="chk1" type="checkbox" name="chk" class="custom-control-input"> <label for="chk1" class="custom-control-label text-sm">Lembar-me</label> 
                </div> <a href="#" class="ml-auto mb-2 text-sm">Esqueceu senha?</a>
                </div>
                <div class="row mb-3 px-3"> <button type="submit" class="btn btn-pink text-center">Login</button> </div>
                <div class="row mb-4 px-3"> <small class="font-weight-bold">Não tenho conta? <a class="text-danger ">Registrar</a></small> </div>
                
                <div class="row px-4 mb-0">
                <div class="line"></div> <small class="or text-center">Ou</small>
                <div class="line"></div>
                </div>
               </form>

                <div class="card2 card border-0 px-3 py-4">
                <div class="row mb-2 px-5">
                    <h6 class="mb-4 mr-1 mt-2 ml-1">Sign in with   </h6>
                    <div class="google text-center mr-3">
                        
                            <a href=""><img src="https://image.flaticon.com/icons/svg/2965/2965278.svg" alt=""></a>
                        
                    </div>
                    <div class="facebook text-center mr-3">
                        <div class="facebook">
                            <a href=""><img src="https://image.flaticon.com/icons/svg/2111/2111392.svg" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>                
        </div>
    </div>
</div>
    
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script>
   
    </script>

    </body>
    </html>