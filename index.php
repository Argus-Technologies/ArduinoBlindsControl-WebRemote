<?php

require_once 'config.php';

date_default_timezone_set($config['location']['timezone']);

if (!isset($_GET['a']))
{
?>

<h1>Arduino Blinds Control - Web Remote</h1>
<hr />

<h3>Direct Control</h3>
<hr />

<form action="index.php?a=direct_control" method="post">
<table>
	<tr><td><label for="channel">Channel: </label></td><td align="right"> <select name="channel" id="channel">
<?php
	foreach ($config['ArduinoBlindsControl']['channels'] as $chan => $name)
	{
?>
					<option value="<?php echo $chan; ?>"><?php echo $name; ?></option>
<?php
	}
?>
	</select></td></tr>
	<td><label for="action">Action: </label></td><td align="right"> <select name="action">
		<option value="0">Up</option>
		<option value="1">Stop</option>
		<option value="2" selected="selected">Down</option>
	</select></td></tr>
	<tr><td><label for="duration">Duration (ms): </label></td><td align="right"> <input type="text" name="duration" id="duration" value="20000" /></td></tr>
	<tr><td colspan="2" align="center"><input type="submit" value="Submit" /></td></tr>
</table>
</form>

<h3>Timezone/Locational Sunrise/Sunset</h3>
<hr />
<?php
$dsi = date_sun_info(time(), $config['location']['lat'], $config['location']['long']);
?>

<ul>
	<li>Astronomical twilight begin: <?php echo ($dsi['astronomical_twilight_begin'] == 1 ? 'Above horizon' : date('d/m/Y H:i:s', $dsi['astronomical_twilight_begin'])); ?></li>
	<li>Nautical twilight begin: <?php echo date('d/m/Y H:i:s', $dsi['nautical_twilight_begin']); ?></li>
	<li>Civil twilight begin: <?php echo date('d/m/Y H:i:s', $dsi['civil_twilight_begin']); ?></li>
	<li>Sunrise: <?php echo date('d/m/Y H:i:s', $dsi['sunrise']); ?></li>
</ul>
<ul>
	<li>Time: <?php echo date('d/m/Y H:i:s'); ?></li>
	<li>Transit: <?php echo date('d/m/Y H:i:s', $dsi['transit']); ?></li>
</ul>
<ul>
	<li>Sunset: <?php echo date('d/m/Y H:i:s', $dsi['sunset']); ?></li>
	<li>Civil twilight end: <?php echo date('d/m/Y H:i:s', $dsi['civil_twilight_end']); ?></li>
	<li>Nautical twilight end: <?php echo date('d/m/Y H:i:s', $dsi['nautical_twilight_end']); ?></li>
	<li>Astronomical twilight end: <?php echo ($dsi['astronomical_twilight_end'] == 1 ? 'Above horizon' : date('d/m/Y H:i:s', $dsi['astronomical_twilight_end'])); ?></li>
</ul>

<?php
}

if (isset($_GET['a']) && $_GET['a'] == 'direct_control')
{
	$fh = fopen('http://' . $config['ArduinoBlindsControl']['ip'] . '/?chan' . intval($_POST['channel']) . ',' . intval($_POST['action']) . ',' . intval($_POST['duration']), 'rb');
	if ($fh)
	{
		$content = stream_get_contents($fh);
		fclose($fh);
	}
	header("Location: index.php");
}