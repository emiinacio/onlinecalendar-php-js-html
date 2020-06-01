<?php
    $mysqli = new mysqli('localhost', 'root', '', 'bookingcalendar');
if(isset($_GET['date'])) {
    $date = $_GET['date'];
    $stmt = $mysqli->prepare("select * from tb_bookings where date = ?");
    $stmt->bind_param('s', $date);
    $tb_bookings = array();
    if($stmt->execute()) {
      $result = $stmt->get_result();
      if($result->num_rows>0){
        while($row = $result->fetch_assoc()) {
          $tb_bookings[] = $row['timeslot'];
        }
        $stmt-> close();
      }
    }
}

if(isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $tel = $_POST['tel'];
    $options = $_POST['options'];
    $description = $_POST['description'];
    $timeslot = $_POST['timeslot'];
    $stmt = $mysqli->prepare("select * from tb_bookings where date = ? AND timeslot = ?");
    $stmt->bind_param('ss', $date, $timeslot);
    if($stmt->execute()) {
      $result = $stmt->get_result();
    if($result->num_rows>0){
        $msg = "<div class='alert alert-danger'>Já reservado!</div>";
    } else {
        $stmt = $mysqli->prepare("INSERT INTO tb_bookings (firstname, lastname, tel, options, description, date, timeslot ) VALUES (?,?,?,?,?,?,?)");
        $stmt-> bind_param('sssssss', $firstname, $lastname, $tel, $options, $description, $date, $timeslot);
        $stmt->execute();
        $msg = "<div class='alert alert-success'>Marcação realizada com sucesso</div>";
        $tb_bookings[] = $timeslot;
        $stmt->close();
        $mysqli-> close();
        }
    }
}

$duration = 60;
$cleanup = 0;
$start= "09:00";
$end = "19:30";

function timeslots($duration, $cleanup, $start, $end) {
    $start = new DateTime($start);
    $end = new DateTime($end);
    $interval = new DateInterval("PT".$duration."M");
    $cleanupInterval = new DateInterval("PT".$cleanup."M");
    $slots = array();

    for($intStart = $start; $intStart<$end; $intStart->add($interval)->add($cleanupInterval)) {
        $endPeriod = clone $intStart;
        $endPeriod->add($interval);
            if($endPeriod>$end){
                break;
            }

        $slots[] = $intStart->format("H:iA")."-".$endPeriod->format("H:iA");
    }
    return $slots;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="calendar.css">
      <title>Document</title>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Faça sua marcação</h1>
        <h4 class="text-center">Para dia <?php echo date('m/d/Y', strtotime($date)); ?></h1><hr>
    
        <div class="row">
            <div class="col-ms-2">
                <?php echo isset($msg)?$msg:""?>
            </div>

            <?php $timeslots = timeslots($duration, $cleanup, $start, $end);
            foreach($timeslots as $ts) {
            ?>
        
            <div class="col-md-2">
                <div class="form-group">
                    <?php  if(in_array($ts, $tb_bookings)){ ?>
                        <button class="btn btn-danger"><?php echo $ts; ?></button>
                    <?php }else ?>
                    <button class="btn btn-success book" data-timeslot="<?php echo $ts; ?>"><?php echo $ts; ?></button>
                </div>
            </div>
            <?php }  ?>
        </div>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Horário escolhido: <span id="slot"></span></h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="">Horario Escolhido</label>
                                    <input required type="text" class="form-control" readonly name="timeslot" id="timeslot">
                                </div>
                                <div class="form-group">
                                    <label for="">Seu nome</label>
                                    <input required type="text" class="form-control" placeholder="Primeiro nome" name="firstname">
                                </div>
                                <div class="form-group">
                                    <input required type="text" class="form-control" placeholder="Ultimo Nome nome" name="lastname">
                                </div>
                                <div class="form-group ">
                                    <label for="example-tel-input" >Telephone</label>
                                    <input required class="form-control" type="tel" id="example-tel-input" name="tel">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Selecione o serviço</label>
                                    <select required  class="form-control" id="exampleFormControlSelect1" name="options">
                                    <option>Manutenção</option>
                                    <option>Aplicação</option>
                                    <option>Pedicure</option>
                                    <option>Depilação</option>
                                    <option>Depilação Laser</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Descrição (opcional)</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                                </div>
                        
                                <div class="form-group pull-right"> 
                                    <button class="btn btn-primary" type="submit" name="submit">Confirmar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>
    $(".book").click(function(){
        var timeslot = $(this).attr('data-timeslot');
        $("#slot").html(timeslot);
        $("#timeslot").val(timeslot);
        $("#myModal").modal("show");
    })
    </script>
</body>
</html>