<?php

    if(isset($_POST["submit"])) {
        if(!empty($_POST['user']) && !empty($_POST['pass'])) {
            $email=$_POST['user'];
            $password=$_POST['pass'];

            $con=mysql_connect('localhost', 'root', '') or die(mysql_error());
            mysql_select_db('bookingcalendar')  or die("cannot select DB");  

            $query=mysql_query("SELECT * FROM login WHERE username='".$user."' AND password='".$pass."'");
            $numrows=mysql_num_rows($query);  
            if($numrows!=0)  
            {  
            while($row=mysql_fetch_assoc($query))  
            {  
            $dbusername=$row['username'];  
            $dbpassword=$row['password'];  
            } 

            if($email== $dbusername && $pass == $dbpassword)  
            {  
            session_start();  
            $_SESSION['sess_user']=$user;  
        
            /* Redirect browser */  
            header("Location: dashboard.php");  
            }  
            } else {  
            echo "Email ou senha inválidos!";  
            }  
        
        } else {  
            echo "Todos os campos são requeridos!";  
                }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../style/style.css">
        <link rel="stylesheet" href="../style/global.css">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;1,500&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Ubuntu:wght@700&display=swap" rel="stylesheet">

        <title>Nails</title>
    </head>
    <body>
        <div id="page-login">

            <form action="" method="POST">

                <div class="logo">
                    <img src="../img/logo.png" alt="">
                </div>
                <legend>Bem vindo de volta. Faça login na sua conta!</legend>

                <div class="social">
                    <button type="submit" class="facebook">
                        <img src="../img/facebook.svg" alt=""> Facebook
                    </button>
    
                    <button type="submit" class="google">
                        <img src="../img/google.svg" alt="">  Google
                    </button>
                </div>

                <div class="field">
                    
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" name="user" id="email">
                    </div>

                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" name="pass" id="senha">
                    </div>
                    
                    <input type="checkbox" name="" id="" class="check">
                    <label for="">Relembrar me</label>

                </div>
                    
                <div class="button">
                    <button type="submit" class="signin" id="sigin">
                        Entrar
                    </button>

                    <button  class="register">
                        Registrar
                    </button>
                </div>

                <a href="#"> <h6>Esqueci minha senha</h6> </a> 
            </form>

            <content>
                <img src="../img/img-1.jpeg" alt="">
                                  
            </content>
        </div>
        
    </body>

    <script src="../plugins/jquery/jquery.min.js"></script>
    <script src="../plugins/jquery-validation/jquery-validation-1.19.2/dist/jquery.validate.min.js"></script>
    <script src="../plugins/jquery-validation/jquery-validation-1.19.2/dist/additional-methods.min.js"></script>
    <script src="../plugins/jquery-validation/jquery-validation-1.19.2/dist/localization/messages_pt_PT.min.js"></script>
    <script src="../plugins/package-lock.json"></script>
    <script>
        let button = document.querySelector('form button#sigin')
        button.addEventListener("click", () => {
            location.href = "/views/dashboard.html"
        })
    </script>
</html>