<?php
$mysqli = new mysqli('localhost', 'root', '', 'bookingcalendar');
if(isset($_GET['date'])){
    $date = $_GET['date'];
    $stmt = $mysqli->prepare("select * from bookings where date = ?");
    $stmt->bind_param('s', $date);
    $bookings = array();
    if($stmt->execute()){
        $result = $stmt->get_result();
    }
}

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $stmt = $mysqli->prepare("select * from bookings where date = ?");
    $stmt->bind_param('s', $date);
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            $msg = "<div class='alert alert-danger'>Already Booked</div>";
        }else{
            $stmt = $mysqli->prepare("INSERT INTO bookings (name, email, date) VALUES (?,?,?)");
            $stmt->bind_param('sss', $name, $email, $date);
            $stmt->execute();
            $msg = "<div class='alert alert-success'>Booking Successfull</div>";
            $stmt->close();
            $mysqli->close();
        }
    }
}

$duration = 60;
$cleanup = 0;
$start = "09:00";
$end = "18:00";

function timeslots($duration, $cleanup, $start, $end){
    $start = new DateTime($start);
    $end = new DateTime($end);
    $interval = new DateInterval("PT".$duration."M");
    $cleanupInterval = new DateInterval("PT".$cleanup."M");
    $slots = array();

    for($intStart = $start; $intStart<$end; $intStart->add($interval)->add($cleanupInterval)){
        $endPeriod = clone $intStart;
        $endPeriod->add($interval);
        if($endPeriod>$end){
            break;
        }
        $slots[] = $intStart->format("H:iA")." - ". $endPeriod->format("H:iA");
        
    }
    
    return $slots;
    }

?>
<!doctype html>
<html lang="pt">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title></title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="/css/main.css">
</head>

<body>
<div class="container">
    <h1 class="text-center">Marcar para: <?php echo date('d-m-Y', strtotime($date)); ?></h1><hr>
    <div class="column-center">
        <div class="col-md-12">
            <?php echo isset($msg)?$msg:"";?>
        </div>
        <?php $timeslots = timeslots($duration, $cleanup, $start, $end);
            foreach($timeslots as $ts) {
        ?>
        <div class=" col-sm-6">
            <div class="form-group">
                <?php if(in_array($ts, $bookings)){?>
                <button class="btn btn-danger" data-timeslot="<?php echo $ts;?>"><?php echo $ts;
                    ?></button>
                <?php }else{ ?>
                <button class="btn btn-success book" data-timeslot="<?php echo $ts;?>"><?php echo $ts;
                    ?></button>
                <?php } ?>

                
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!--MODAL!-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Agendar: <span id="slot"></span></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="">Horários</label>
                            <input required type="text" readonly name="timeslot" id="timeslot" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Name</label>
                            <input required type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">E-mail</label>
                            <input required type="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Contacto</label>
                            <input required type="tel" name="contact" class="form-control">
                        </div>
                        <div class="form-group pull-right">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Concluído</button>
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