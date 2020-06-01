<?php 
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
    <style>
        .btn-pink{
        background-color: #f25;
        border: none;
        padding: 1vmin;
        text-align: center;
        margin: 1vmin;
        color: white;
      }

      td .today {
          background-color: #ddd;
      }
    </style>
</head>
<body>

    <?php
    $dt = new DateTime;
    if (isset($_GET['year']) && isset($_GET['week'])) {
        $dt->setISODate($_GET['year'], $_GET['week']);
    } else {
        $dt->setISODate($dt->format('o'), $dt->format('W'));
    }
    $year = $dt->format('o');
    $week = $dt->format('W');
    $month = $dt->format('F');
    $year = $dt->format('Y');
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <center>
                <h2><?php echo "$month $year";?></h2>
                <a class="btn btn-pink btn-xs" href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week-1).'&year='.$year; ?>">Semana Anterior</a> <!--Previous week-->
                <a class="btn btn-pink btn-xs" href="weekly.php">Semana Atual</a> <!--Previous week-->
                <a class="btn btn-pink btn-xs"href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week+1).'&year='.$year; ?>">Próxima Semana</a> <!--Next week-->
                </center>

                <table class="table table-bordered">
                <tr class="success">
                    <?php
                    do {
                        if( $dt->format('d M Y') == date('d M Y')) {
                            echo "<td style='background: rgb(241, 232, 200)'>" . $dt->format('l') . "<br>" . $dt->format('d M Y') . "</td>\n";
                        } else {
                            echo "<td>" . $dt->format('l') . "<br>" . $dt->format('d M Y') . "</td>\n";
                        }

                        
                        $dt->modify('+1 day');
                    } while ($week == $dt->format('W'));
                    ?>
                </tr>
                    <?php $timeslots = timeslots($duration, $cleanup, $start, $end);
                    foreach($timeslots as $ts){
                    ?>
                <tr>
                    <td><button class="btn btn-success btn-xs"><?php echo $ts; ?></button></td>
                    <td><button class="btn btn-success btn-xs"><?php echo $ts; ?></button></td>
                    <td><button class="btn btn-success btn-xs"><?php echo $ts; ?></button></td>
                    <td><button class="btn btn-success btn-xs"><?php echo $ts; ?></button></td>
                    <td><button class="btn btn-success btn-xs"><?php echo $ts; ?></button></td>
                    <td><button class="btn btn-success btn-xs"><?php echo $ts; ?></button></td>
                    <td><button class="btn btn-success btn-xs"><?php echo $ts; ?></button></td>
                </tr>
                <?php } ?>
                </table>
                </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>