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
    $calendar.= "<button class='changemonth btn btn-xs btn-primary' data-month='".date('m', mktime(0, 0, 0, $month-1, 1, $year))."' data-year='".date('Y', mktime(0, 0, 0, $month-1, 1, $year))."'>Previous Month</button> "; 
    $calendar.= " <button class='changemonth btn btn-xs btn-primary' data-month='".date('m')."' data-year='".date('Y')."'>Current Month</button> "; 
    $calendar.= "<button class='changemonth btn btn-xs btn-primary' data-month='".date('m', mktime(0, 0, 0, $month+1, 1, $year))."' data-year='".date('Y', mktime(0, 0, 0, $month+1, 1, $year))."'>Next Month</button></center><br>"; 
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

$dateComponents = getdate();
if(isset($_GET['month'])&& isset($_GET['year'])){
    $month = $_GET['month']; 
    $year = $_GET['year']; 
} else {
    $month = $dateComponents['mon']; 
    $year = $dateComponents['year']; 
}
echo build_calendar($month,$year); 
    
?>