<?php
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <h1></h1>
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
                <a class="btn btn-primary btn-xs" href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week-1).'&year='.$year; ?>">Semana Anterior</a>
                <a class="btn btn-primary btn-xs" href="weekly.php">Semana Atual</a>
                <a class="btn btn-primary btn-xs" href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week+1).'&year='.$year; ?>">Próxima Semana</a>
                
                </center>
                <br>
                <table class="table table-bordered">
                    <tr class="success">
                    <?php
                    do {
                        if($dt->format('d M Y') == date('d M Y')){
                            echo "<td style='background:yellow'>" . $dt->format('l') . "<br>" . $dt->format('d M Y') . "</td>\n";
                        }else {
                            echo "<td>" . $dt->format('l') . "<br>" . $dt->format('d M Y') . "</td>\n";
                        }
                        
                        $dt->modify('+1 day');
                    } while ($week == $dt->format('W'));
                    ?>
                    </tr>
                    <?php $timeslots = timeslots($duration, $cleanup, $start, $end);
                        foreach($timeslots as $ts) {
                    ?>
                    <tr>
                        <td><button class="btn btn-success btn-xs"><?php echo $ts;?></button></td>
                        <td><button class="btn btn-success btn-xs"><?php echo $ts;?></button></td>
                        <td><button class="btn btn-success btn-xs"><?php echo $ts;?></button></td>
                        <td><button class="btn btn-success btn-xs"><?php echo $ts;?></button></td>
                        <td><button class="btn btn-success btn-xs"><?php echo $ts;?></button></td>
                        <td><button class="btn btn-success btn-xs"><?php echo $ts;?></button></td>
                        <td><button class="btn btn-success btn-xs"><?php echo $ts;?></button></td>
                    </tr>
                    <?php }?>
                </table>
            </div>
        </div>
    </div>
    
    </table>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script 
    src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
    crossorigin="anonymous">
</script>
</html>