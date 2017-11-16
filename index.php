<!DOCTYPE html>
<?PHP  

include "config.inc.php";
if(isset($_GET['room']))
{$SQL    = "select * from Devices where room = '" . $_GET['room'] . "' group by room order by view_order ASC";}
else
{$SQL    = "select * from Devices order by view_order ASC";}

$result = mysqli_query($db_handle, $SQL);

$ACTION	=	$_GET['action'];
$IP 	=	$_GET['ip'];
$TYPE	=	$_GET['type'];
$NAME	=	$_GET['name'];
$VALUE	=	$_GET['value'];

if ($TYPE == "yeelight")
{
	if ($ACTION == "on" or $ACTION == "off")
	{
		$command = "yee --ip=" . $IP . " turn " . $ACTION;
		shell_exec($command);
		$output = $NAME . " turned " . $ACTION . "." ;
	}
	if ($ACTION == "dim")
	{
		$command = "yee --ip=" . $IP . " brightness " . $VALUE;
		shell_exec($command);
		$output = $NAME . "brightness changed to " . $VALUE . " percent." ;
	}
}

if ($TYPE == "kankun")
{
	if ($ACTION == "on" or $ACTION == "off")
	{
		$command = "http://" . $IP . "/cgi-bin/relay.cgi?". $ACTION;
		$returned_content = file_get_contents($command);
		$output = $NAME . " turned " . $ACTION . ".";
	}
}
if ($TYPE == "sonoff")
{
	if ($ACTION == "on" or $ACTION == "off")
	{
		$command = "http://" . $IP . "/" . $ACTION;
		$returned_content = file_get_contents($command);
		$output = $NAME . " turned " . $ACTION . ".";
	}
}

?>
<html lang="en">
  <head>
  <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
<link rel="manifest" href="manifest.json">
<link rel="mask-icon" href="safari-pinned-tab.svg" color="#5bbad5">
<link rel="icon" type="image/png" sizes="192x192" href="android-chrome-192x192.png">
<meta name="theme-color" content="#ffffff">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Smart House</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">
	<?PHP if(isset($_GET['action'])) { 
		echo "<meta http-equiv='refresh' content='3;url=http://web.danmed.co.uk/SmartHome/index.php'/>" ;
	} ?> 

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>
  <body>

    <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
	
		
<?PHP

while ($db_field = mysqli_fetch_assoc($result)) {
$NAME_DB	=	$db_field['name'];
$IP_DB		=	$db_field['ipaddress'];
$TYPE_DB	=	$db_field['type'];
if ($TYPE_DB == "yeelight")
{
	$STATUS_COMMAND = "yee --ip=" . $IP_DB . " status";
	$STATUS = shell_exec($STATUS_COMMAND);
	if (strpos($STATUS, 'power: on') !== false) { $STATUS = "<img src='yee_online.png' height=20>"; } else { $STATUS = "<img src='yee_offline.png' height=20>"; }
?>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<?PHP echo $STATUS; ?><?PHP echo $NAME_DB; ?>
					</h3>
				</div>
				<div class="panel-body">
					<a href="index.php?action=on&ip=<?PHP echo $IP_DB; ?>&type=<?PHP echo $TYPE_DB; ?>&name=<?PHP echo $NAME_DB; ?>" class="btn btn-success"><span class="glyphicon glyphicon-adjust"></span> Turn On</a> &nbsp; <a href="index.php?action=off&ip=<?PHP echo $IP_DB; ?>&type=<?PHP echo $TYPE_DB; ?>&name=<?PHP echo $NAME_DB; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-adjust"></span> Turn Off</a>
				<div class="btn-group">
				 
				<button class="btn btn-default">
					Dim
				</button> 
				<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<li>
						<a href="index.php?action=dim&value=1&type=<?PHP echo $TYPE_DB; ?>&ip=<?PHP echo $IP_DB; ?>">Lowest</a>
					</li>
					<li>
						<a href="index.php?action=dim&value=25&type=<?PHP echo $TYPE_DB; ?>&ip=<?PHP echo $IP_DB; ?>">Quarter</a>
					</li>
					<li>
						<a href="index.php?action=dim&value=50&type=<?PHP echo $TYPE_DB; ?>&ip=<?PHP echo $IP_DB; ?>">Half</a>
					</li>
					<li>
						<a href="index.php?action=dim&value=75&type=<?PHP echo $TYPE_DB; ?>&ip=<?PHP echo $IP_DB; ?>">3 Quarters</a>
					</li>
					<li>
						<a href="index.php?action=dim&value=100&type=<?PHP echo $TYPE_DB; ?>&ip=<?PHP echo $IP_DB; ?>">Full</a>
					</li>
				</ul>
			</div>
				</div>
				<div class="panel-footer">
					<?PHP if($NAME == $NAME_DB){echo $output;} ?>&nbsp;
				</div>
			</div>
<?PHP
}
if ($TYPE_DB == "kankun")
{
	
	$STATUS_COMMAND = "http://" . $IP_DB . "/cgi-bin/json.cgi?get=state";
	$returned_content = file_get_contents($STATUS_COMMAND);
	if (strpos($returned_content, 'on') !== false) { $STATUS = "<img src='plug_on.png' height=20>"; } else { $STATUS = "<img src='plug_off.png' height=20>"; }
?>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<?PHP echo $STATUS; ?><?PHP echo $NAME_DB; ?>
					</h3>
				</div>
				<div class="panel-body">
					<a href="index.php?action=on&ip=<?PHP echo $IP_DB; ?>&type=<?PHP echo $TYPE_DB; ?>&name=<?PHP echo $NAME_DB; ?>" class="btn btn-success"><span class="glyphicon glyphicon-adjust"></span> Turn On</a> &nbsp; <a href="index.php?action=off&ip=<?PHP echo $IP_DB; ?>&type=<?PHP echo $TYPE_DB; ?>&name=<?PHP echo $NAME_DB; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-adjust"></span> Turn Off</a>

				</div>
				<div class="panel-footer">
					<?PHP if($NAME == $NAME_DB){echo $output;} ?>&nbsp;
				</div>
			</div>
<?PHP
}
if ($TYPE_DB == "sonoff")
{
?>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<?PHP echo $NAME_DB; ?>
					</h3>
				</div>
				<div class="panel-body">
					<a href="index.php?action=on&ip=<?PHP echo $IP_DB; ?>&type=<?PHP echo $TYPE_DB; ?>&name=<?PHP echo $NAME_DB; ?>" class="btn btn-success"><span class="glyphicon glyphicon-adjust"></span> Turn On</a> &nbsp; <a href="index.php?action=off&ip=<?PHP echo $IP_DB; ?>&type=<?PHP echo $TYPE_DB; ?>&name=<?PHP echo $NAME_DB; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-adjust"></span> Turn Off</a>

				</div>
				<div class="panel-footer">
					<?PHP if($NAME == $NAME_DB){echo $output;} ?>&nbsp;
				</div>
			</div>
<?PHP
}

}
?>			
	</div>
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>