<?php
function build_calendar($month, $year, $room){
    $mysqli = new mysqli('localhost', 'root', '', 'bookingcalendar');
    $stmt = $mysqli->prepare('select * from rooms');
    $rooms = "";
    $first_room = 0;
    $i = 0;
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                if($i==0){
                    $fist_room = $row['id'];
                }
                $rooms.= "<option value='".$row['id']."'>".$row['name']."</option>";
                $i++;
            }
            $stmt->close();
        }
    }

    if($room==0){
        $fist_room = $room;
    }

    $stmt = $mysqli->prepare('select * from bookings where MONTH(date) = ? AND YEAR(date) = ? AND room_id = ?');
    $stmt->bind_param('ssi', $month, $year, $first_room);
    $bookings = array();
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            while($row = $stmt->fetch_assoc()){
                $bookings[] = $row['date'];
            }
            $stmt->close();
        }
    }
        
    $daysOfWeek = array('Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo');
    $firstDayOfMonth = mktime(0,0,0,$month,1,$year);
    $numberDays = date('t',$firstDayOfMonth);
    $dateComponents = getdate($firstDayOfMonth);
    $monthName = $dateComponents['month'];
    $dayOfWeek = $dateComponents['wday'];
    if($dayOfWeek==0){
        $dayOfWeek = 6;
    }else {
        $dayOfWeek = $dayOfWeek-1;
    }

    $datetoday = date('Y-m-d'); 
    $calendar = "<table class='table table-bordered'>"; 
    $calendar.= "<center><h2>$monthName $year</h2>"; 
    $calendar.= "<button class='changemonth btn btn-xs btn-primary' data-month='".date('m', mktime(0, 0, 0, $month-1, 1, $year))."' data-year='".date('Y', mktime(0, 0, 0, $month-1, 1, $year))."'>Mês anterior</button> "; 
    $calendar.= "<button class='changemonth btn btn-xs btn-primary' data-month='".date('m')."' data-year='".date('Y')."'>Mês atual</button> "; 
    $calendar.= "<button class='changemonth btn btn-xs btn-primary' data-month='".date('m', mktime(0, 0, 0, $month+1, 1, $year))."' data-year='".date('Y', mktime(0, 0, 0, $month+1, 1, $year))."'>Próximo mês</button></center><br>"; 
    $calendar.= "<tr>";
    $calendar.= "
    <form id='room_select_form'>
        <div class='row'>
            <div class='col-md-6 col-md-offset-3 form-group'>
                <label>Selecionar serviço</label>
                <select class='form-control' id='room_select' name='room'>
                    ".$rooms."
                </select>
                <input type='hidden' name='month' value='".$month."'>
                <input type='hidden' name='year' value='".$year."'>
            </div>
        </div>
    </form>
    
    <table class='table table-bordered'>"; 
    $calendar.= "<tr>";

    foreach($daysOfWeek as $day) { 
        $calendar .= "<th class='header'>$day</th>"; 
    } 
    $calendar .= "</tr><tr>";
    $currentDay = 1;
    if($dayOfWeek > 0) { 
        for($k=0;$k<$dayOfWeek;$k++){ 
            $calendar .= "<td class='empty'></td>"; 
        } 
    }

    $month = str_pad($month, 2, "0", STR_PAD_LEFT);
    while ($currentDay <= $numberDays) { 

    if ($dayOfWeek == 7) { 
        $dayOfWeek = 0; 
        $calendar .= "</tr><tr>"; 
    } 
    $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT); 
    $date = "$year-$month-$currentDayRel"; 
    $dayname = strtolower(date('i', strtotime($date))); 
    $eventNum = 0; 
    $today = $date==date('Y-m-d')?"today":"";
    if($date<date('Y-m-d')){
        $calendar.="<td><h4>$currentDay</h4><button class='btn btn-danger btn-xs'>Indisponível</button>";
    }else{
        $calendar.="<td class='$today'><h4>$currentDay</h4><a href='book.php?date=".$date."' class='btn btn-success btn-xs'>Livre</button>";

        /*$totalbookings = checkSlots($mysqli, $date);
        if($totalbookings==9){
            $calendar.="<td class='$today'><h4>$currentDay</h4><a href='#' class='btn btn-danger btn-xs'>Tudo Reservado</button><small><i>$availableslots horários restantes</i></small>";
        }else{
            $availableslots = 9 - $totalbookings;
            
        }*/
        
    }

    $calendar.="</td>"; 

    $currentDay++; 
    $dayOfWeek++; 

    }

    if($dayOfWeek != 7) {
        $remainingDays = 7-$dayOfWeek;
    for($i=0;$i<$remainingDays;$i++){
        $calendar.="<td class='empty'></td>";
        }
    }

    $calendar.="</tr>";
    $calendar.="</table>";

    echo $calendar;
}

function checkSlots($mysqli, $date){
    $stmt = $mysqli->prepare("select * from bookings where date = ?");
    $stmt->bind_param('s', $date);
    $bookings = $array();
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $totalbookings++;
            }

            $stmt->close();
        }
    }
    return $totalbookings;
}
    
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        @media only screen and (max-width: 800px),
        (min-device-width: 802px) and (max-device-width: 1020px) {

        /* Force table to not be like tables anymore */
        table, thead, tbody, th, td, tr {
            display: block;

        }

        .empty {
            display: none;
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        th {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        tr {
            border: 1px solid #ccc;
        }

        td {
            /* Behave  like a "row" */
            border: none;
            border-bottom: 1px solid #eee;
            position: relative;
            padding-left: 50%;
        }



        /*
        Label the data
        */
        td:nth-of-type(1):before {
            content: "Domingo";
        }
        td:nth-of-type(2):before {
            content: "Segunda";
        }
        td:nth-of-type(3):before {
            content: "Terça";
        }
        td:nth-of-type(4):before {
            content: "Quarta";
        }
        td:nth-of-type(5):before {
            content: "Quinta";
        }
        td:nth-of-type(6):before {
            content: "Sexta";
        }
        td:nth-of-type(7):before {
            content: "Sabádo";
        }


        }

        /* Smartphones (portrait and landscape) ----------- */

        @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
        body {
            padding: 0;
            margin: 0;
        }
        }

        /* iPads (portrait and landscape) ----------- */

        @media only screen and (min-device-width: 802px) and (max-device-width: 1020px) {
        body {
            width: 495px;
        }
        }

        @media (min-width:641px) {
        table {
            table-layout: fixed;
        }
        td {
            width: 33%;
        }
        }

        .row{
        margin-top: 20px;
        }

        .today{
        background: yellow;
        }
    </style>
    <title>Agendamento</title>
</head>
<body style="background-color: #f9f9f9;"> 
    <div class="container"> 
        <div class="row"> 
            <div class="col-md-12"> 
                    <?php 
                        $dateComponents = getdate();
                        if(isset($_GET['month'])&& isset($_GET['year'])){
                            $month = $_GET['month']; 
                            $year = $_GET['year']; 
                        } else {
                            $month = $dateComponents['mon']; 
                            $year = $dateComponents['year']; 
                        }
                        
                        if(isset($_GET['room'])){
                            $room = $_GET['room'];
                        } else{
                            $room = 0;
                        }

                        echo build_calendar($month,$year, $room); 
                    ?> 
            </div> 
        </div> 
    </div> 


</body>
<script 
    src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
    crossorigin="anonymous"></script>
<script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous">
</script>
<script>
    $("#room_select").change(function(){
        $("#room_select_form").submit();
    });

    $("#room_select option[value='<?php echo $room; ?>']").attr('selected', 'selected');
</script>
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/jquery-validation/jquery-validation-1.19.2/dist/jquery.validate.min.js"></script>
<script src="../plugins/jquery-validation/jquery-validation-1.19.2/dist/additional-methods.min.js"></script>
<script src="../plugins/jquery-validation/jquery-validation-1.19.2/dist/localization/messages_pt_PT.min.js"></script>
<script src="../plugins/package-lock.json"></script>
<script>
    $.ajax({
    url: "calendar.php",
    type: "POST",
    data: {'month':'<php echo date('m'); ?>,'year':'<?php echo date('Y');?>},
    success: function(data){
        $("#calendar").html(data);
    }
});

$(document).on('click', '.changemonth', function(){
    $.ajax({
        url: "calendar.php",
        type: "POST",
        data: {'month':$(this).data('month'),'year':$(this).data('year')},
        success: function(data){
            $("#calendar").html(data);
        }
    });
});
</script>
</html>