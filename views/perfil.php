<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/sidebar.css">
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/perfil.css">
    <script src="../plugins/sweetalert/dist/sweetalert2.all.min.css"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  
    <title>Nails - Perfil</title>
</head>
<body>
<div id="flex-dashboard">
    
    <?php include('sidebar.php'); ?>

        <main>
            <header>
                <div class="menu-bar">
                    <a href="">
                        <img src="https://image.flaticon.com/icons/svg/1828/1828859.svg" alt="">
                    </a>
                </div>
                <div class="menu-profile">
                    <a href="perfil.php">
                        <img src="https://image.flaticon.com/icons/svg/2948/2948035.svg" alt="">
                    </a>
                </div>
                
            </header>                
 
            <div class="main-content">                  
                <div id="perfil-parent">
                    <div class="perfil">
                        <div class="perfil-img">
                            <div class="img"></div>
                            <div class="change">
                                <a href="#">Alterar foto</a>
                            </div>
                        </div>

                        

                        <div id="perfil-form">
                            <form action="" id="form-perfil">
            
                                <fieldset>
            
                                    <div class="field-group">
                                        <div class="field">
                                            <label for="firstname">Primeiro Nome *</label>
                                            <input type="text" name="firstname" id="firstname">
                                        </div>
                                        <div class="field">
                                            <label for="lastname">Último Nome *</label>
                                            <input type="text" name="lastname" id="lastname">
                                        </div>
                                    </div>

                                    <div class="field-group">
                                        <div class="field">
                                            <label for="phone">Telemóvel *</label>
                                            <input type="text" name="phone" id="phone">
                                        </div>

                                        <div class="field">
                                            <label for="date-birth">Data de Nascimento *</label>
                                                <div class="container ">
                                                    <div style="max-width:300px">
                                                        <div class="panel-body">
                                                            <form id="js-form">
                                                                <input id="datebirth" name="datebirth" class="form-control input-lg js-date--west" type="text" placeholder=" 01 / 05 / 1990  ">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
            
                                    <div class="field">
                                        <label for="address">Morada *</label>
                                        <input type="text" name="address" id="address">
                                    </div>

                                    <div class="field">
                                        <label for="occupation">Profissão</label>
                                        <input type="text" name="occupation" id="occupation">
                                    </div>

                                    <div class="field-group">
                                        <div class="field">
                                            <label for="password">Senha *</label>
                                            <input type="text" name="password" id="password">
                                        </div>
                                        <div class="field">
                                            <label for="confirmpass">Confirmar senha*</label>
                                            <input type="text" name="confirmpass" id="confirmpass">
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <legend>
                                        <h2>Serviço de Prefêrencia: *</h2>
                                    </legend>                        
            
                                    <div class="items-grid">
                                        <li data-id="1">
                                            <img src="https://image.flaticon.com/icons/svg/599/599752.svg" alt="Manicure">
                                            <span>Unhas</span>
                                        </li>
                                        <li data-id="2">
                                            <img src="https://image.flaticon.com/icons/svg/1997/1997087.svg" alt="Pedicure">
                                            <span>Pedicure</span>
                                        </li>
                                        <li data-id="3">
                                            <img src="https://image.flaticon.com/icons/svg/2228/2228125.svg" alt="Brushing">
                                            <span>Brushing</span>
                                        </li>
                                        <li data-id="4"> 
                                            <img src="https://image.flaticon.com/icons/svg/775/775404.svg" alt="Coloração">
                                            <span>Coloração</span>
                                        </li>
                                        <li data-id="5">
                                            <img src="https://image.flaticon.com/icons/svg/2025/2025275.svg  " alt="Madeixas">
                                            <span>Madeixas</span>
                                        </li>
                                        <li data-id="6">
                                            <img src="https://image.flaticon.com/icons/svg/2025/2025279.svg" alt="Corte">
                                            <span>Corte</span>
                                        </li>
                                        <li data-id="7">
                                            <img src="https://image.flaticon.com/icons/svg/2025/2025335.svg" alt="Limpeza de pele">
                                            <span>Limpeza de pele</span>
                                        </li>
                                        <li data-id="8">
                                            <img src="https://image.flaticon.com/icons/svg/2025/2025238.svg" alt="Massagem">
                                            <span>Massagem</span>
                                        </li>
                                        <li data-id="8">
                                            <img src="https://image.flaticon.com/icons/svg/2025/2025243.svg" alt="Depilação">
                                            <span>Depilação</span>
                                        </li>
                                       
                                    </div>
                                </fieldset>
            
                                <button type="submit" id="perfil-save" onclick="perfil.js">
                                     Salvar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                        
            </div>
        </main>
    </div>  

    <script>
        $(function() {
            $('form').submit(function(){
                $.ajax({
                    url: 'send-form.php',
                    type: 'POST',
                    data: $('.form').serialize(),
                    sucess: function(data) {
                        $('.mostrar').html(data);
                    }
                });
            })
        });
    </script>
    
    <script src="../plugins/jquery/jquery.min.js"></script>
    <script src="../plugins/jquery-validation/jquery-validation-1.19.2/dist/jquery.validate.min.js"></script>
    <script src="../plugins/jquery-validation/jquery-validation-1.19.2/dist/additional-methods.min.js"></script>
    <script src="../plugins/jquery-validation/jquery-validation-1.19.2/dist/localization/messages_pt_PT.min.js"></script>
    <script src="../plugins/sweetalert/dist/sweetalert2.all.min.js"></script>
    <script src="../plugins/package-lock.json"></script>
    <script src="../script/field-birth.js"></script>
    <script src="../script/perfil-services.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="../script/perfil.js"></script>
</body>
</html>