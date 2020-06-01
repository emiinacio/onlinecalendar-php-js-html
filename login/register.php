


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registrar-  Salão X</title>

    </head>
    <body>
    <div id="overlay">
        <div class="sidenav">
            <div class="login-main-text">
                <h2>JM Salão de beleza</h2><br>
                <p>Bem vinda(o) ao nosso espaço.<br>
                Aqui você terá a experiencia em realizar as suas próprias marcações! </p>
                <p>O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão.
                O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os
                caracteres de um texto para criar um espécime de livro. </p>
                <hr>
                Tel:- +351 9756545434
            </div>
        </div>
    </div>

    <div class="main">
        <div class="col-md-12 col-sm-12">
            <div class="login-form">
            <form>
                <div class="login-main">
                    <center><h2>LOGO</h2><br></center>
                <h4>Registar</h4>
               
                </div>
                <div class="form-group">
                    <label>Nome Completo</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label>Telefone</label>
                    <input type="tel" name="tel" class="form-control">
                </div>
                
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" placeholder="seuemail@company.com">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="**********">
                </div>

                <?php if(isset($msg)){ echo $msg; } ?>
                <center>
                <div class="button-login">
                    <button type="submit" class="btn-dark" 
                    style="background-color: rgb(248, 19, 134); border: none;width: 80px;">Registrar</button>
                </div>
                </center>
            </form>
            
            <center>
            <div class="form-group ">
                <div class="redes-sociais">
                    <hr>
                <p>Login com</p>
                    <a href=""><img src="https://image.flaticon.com/icons/svg/2702/2702602.svg" alt=""></a>
                    <a href=""><img src="https://image.flaticon.com/icons/svg/1384/1384053.svg" alt=""></a>
                </div>
                </div>
            </div>
            </center>

            
        </div>
    </div>

    
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script>
   
    </script>

    </body>
    </html>