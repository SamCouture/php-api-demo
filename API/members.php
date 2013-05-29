<?php
$session = curl_init();
 
//Connection and Params
// replace "CCID" with the organization's CCID value
curl_setopt($session, CURLOPT_URL, 'http://api.micronetonline.com/V1/associations(CCID)/members?$orderby=WebParticipationLevel%20desc');
curl_setopt($session, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($session, CURLOPT_HTTPGET, 1);
curl_setopt($session, CURLOPT_HEADER, false);
// insert actual X-ApiKey value in place of x's - contact Micronet, Inc. for more info about obtaining an Api-Key - support@micronetonline.com
curl_setopt($session, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json', 'X-ApiKey : xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx'));
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
 
$response = curl_exec($session);
$json = json_decode($response);
curl_close($session);
?>

<style>
#member-list {
font-family:arial, sans-serif;
font-size:14px;
line-height:1.3em;
color:#555;
}
.member-contain {
display: block;
border-bottom: 1px dotted #ccc;
margin-bottom: 10px;
}

.level99 {
background-color:#ada
}

.level30 {
background-color:#dda
}

.level20 {
background-color:#ddd
}

.level10 {
background-color:#bbb
}

.level0 {
background-color:#ccc
}
.member-logo {
float: left;
}

.member-name {
padding: 10px;
}

.member-name a {
color:#000;
}
.member-name a:hover [
color:#ff0;
}
.clear {
clear: both;
float: none;
height: 0px;
}
</style>
<!-- var-dump for testing - remove "//" to enable the dump which will display the data -->
<?php // var_dump($json); ?>
<div id="member-list">
	<?php foreach($json as $data): ?>
	<div class="member-contain level<?= $data->{'WebParticipationLevel'}; ?>">
		<div class="member-name"><a href="/API/member-details.php?id=<?= $data->{'Id'}; ?>&name=<?= $data->{'Slug'}; ?>"><?= $data->{'Name'}; ?></a></div>
	<div class="clear"></div>
	</div>
</div>
<?php endforeach; ?>