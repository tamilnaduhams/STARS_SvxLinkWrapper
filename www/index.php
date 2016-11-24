<?php ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>E R - V U 2 P O C</title>
<link href="favicon.ico" rel="icon" type="image/x-icon" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<style type="text/css">
.page-header {
	text-align: center;
	background-color: #C7C23A;
	margin-bottom:0;
	margin-top:0;
}
.container_title {
	text-align: center;
}
</style>
</head>
<body topmargin=0 leftmargin=0>
<div class="page-header">
  <h1>VU2POC UHF DISASTER COMMUNICATION REPEATER</h1>
</div>
<div class="container">
  <div class="row">
    <div class="row">
      <div class="col-md-6" style="float:left"> <!-- Daily Report -->
        <div class="row">
          <div class="col-md-12">
            <div class="container_title">
              <h3>Today's Echolink Activity Report </h3>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
              <div class="row">
                <div class="col-md-1">Sl</div>
                <div class="col-md-3">Callsign</div>
                <div class="col-md-2">Start</div>
                <div class="col-md-2">End</div>
                <div class="col-md-4">QSO Duration</div>
              </div>
<!-- -->
<?php
function getval($val,$default)
{
	$string=$_GET[$val];

	if (empty($string)) 
	{
		$string = $default;
	}
	return $string;
}

/**
 * StartsWith
 * Tests if a text starts with an given string.
 *
 * @param     string
 * @param     string
 * @return    bool
 */
function StartsWith($Haystack, $Needle){
    // Recommended version, using strpos
    return strpos($Haystack, $Needle) === 0;
}

#information from browser
$count = getval('count','200');

// set path of database file
//$_SERVER['DOCUMENT_ROOT']
$db = "/home/pi/SvxLinkWrapper/EcholinkQsoLog.sqlite";


//don't tuch the constants! For they posess a terrable curse
$action = "ACTION";

// open database file
// create a SQLite3 database file with PDO and return a database handle (Object Oriented)
try{
$dbHandle = new PDO('sqlite:'. $db);
}catch( PDOException $exception ){
die($exception->getMessage());
}
//end create

// generate IN query string
$query = "select * from elqsotodayclear order by id desc limit 0," .$count;

// execute query

$result = $dbHandle->query($query);

// if rows exist,get each row as an array and print values

  $i=1;
    while($row = $result->fetch()) {
		$CS = $row[1];
		$TCS = explode('-', $CS, 2);
		
		$timeElapsed = date_create(date("H:i:s",$row[3]))->diff(date_create(date("H:i:s",$row[4])))->format('%H:%I:%S');
		
	    echo "<div class='row'>";
        echo "<div class='col-md-1'>" . $i . "</div>";      
		echo "<div class='col-md-3'><a href=" . "http://www.qrz.com/db/" .$TCS[0] . " target='_blank'>" .$CS . "</a></div>";
		echo "<div class='col-md-2'>". date("H:i:s",$row[3])."</div>";
		echo "<div class='col-md-2'>". date("H:i:s",$row[4])."</div>";
		echo "<div class='col-md-4'>" . $timeElapsed. "</div>";
		echo "</div>";
		$i++;
    }
// all done

?>
              <!-- --> 
            </div>
            <div class="col-md-1"></div>
          </div>
        </div>
      </div>
      <div class="col-md-6" style="float:left"> <!-- Live Report -->
        <div class="row">
          <div class="col-md-12">
            <div class="container_title">
              <h3>Echolink Activity Report(LIVE)</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
              <div class="row">
                <div class="col-md-1">Sl</div>
                <div class="col-md-2">CallSign</div>
                <div class="col-md-3">QSO Start</div>
                <div class="col-md-4">QSO Duration</div>
              </div>
              <!-- --> 
<?php
// generate OUT query string
$query = "select * from elqsolive order by id desc limit 0," .$count;

// execute query

$result = $dbHandle->query($query);

// if rows exist,get each row as an array and print values

  $i=1;
    while($row = $result->fetch()) {
		$CS = $row[1];
		$TCS = explode('-', $CS, 2);
		$timeElapsed = date_create(date("H:i:s",$row[3]))->diff(date_create(date("H:i:s")))->format('%H:%I:%S');
	    echo "<div class='row'>";
        echo "<div class='col-md-1'>" . $i . "</div>";      
		echo "<div class='col-md-2'><a href=" . "http://www.qrz.com/db/" .$TCS[0] . " target='_blank'>" .$CS . "</a></div>";
		echo "<div class='col-md-3'>". date("H:i:s",$row[3])."</div>";
		echo "<div class='col-md-4'>" . $timeElapsed . "</div>";
		echo "</div>";
		$i++;
    }
// all done

?>
              <!-- --> 
            </div>
            <div class="col-md-1"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
