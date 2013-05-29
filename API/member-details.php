<?php
// gets the member ID from URL query string and sets it as a variable
$memid=($_GET["id"]);
// sets URL to be used in curl request below *note: replace "CCID" with the organization's CCID value
$cUrlUrl="http://api.micronetonline.com/V1/associations(CCID)/members($memid)/details";

$session = curl_init();
 
//Connection and Params 
curl_setopt($session, CURLOPT_URL, $cUrlUrl);
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
body {
color:#444;
background:#ccc;
}

.member-contain {
display: block;
border-bottom: 1px dotted #ccc;
margin-bottom: 10px;
width: 960px;
margin:0 auto;
background: #eee;
box-shadow: 0 0 10px #333;
padding:5px;
}

.member-name {
font-weight:700;
display:block;
}

.member-phone {
display:block;
}

.member-address {
display:block;
}

.clear {
clear: both;
float: none;
height: 0px;
}
</style>
<!-- var-dumps for testing - remove "//" to enable a dump which will display the data-->
<?php // var_dump($memid); ?>
<?php // var_dump($cUrlUrl); ?>
<?php // var_dump($json); ?>

<div class="member-contain" id="member-details">
	<div class="member-name"><?= $json->{'OrganizationName'}; ?></div>
<?php if ($json->{'DispPhone1'} != NULL): ?>
	<div class="member-phone"><?= $json->{'DispPhone1'}; ?></div>
<?php endif; ?>
	<div class="member-address">
		<?php if ($json->{'Line1'} != NULL): ?>
		<?= $json->{'Line1'}; ?>, 
		<?php endif; ?>
		<?php if ($json->{'City'} != NULL): ?>
		<?= $json->{'City'}; ?>, 
		<?php endif; ?>
		<?php if ($json->{'Region'} != NULL): ?>
		<?= $json->{'Region'}; ?> 
		<?php endif; ?>
		<?php if ($json->{'PostalCode'} != NULL): ?>
		<?= $json->{'PostalCode'}; ?>
		<?php endif; ?>
		</div>
<?php if ($json->{'Website'} != NULL): ?>
	<div class="member-website"><a href="<?= $json->{'Website'}; ?>"><?= $json->{'Website'}; ?></a></div>
<?php endif; ?>
	<div class="clear"></div>
</div>
