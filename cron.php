<?php // ##### CRONTAB CALL EVERY 5 MINUTES #####

if (!isset($_SERVER['argv'])) die('No.'); // Only PHP CLI may use this file.

require_once 'config.php';

date_default_timezone_set($config['location']['timezone']);

set_time_limit(0);  // Do not limit time for large scripts

$time_now = time(); // Save the time() in a var for when a part of the script takes more then a minute to process

$chan = 5;

$comm_up   = 0;
$comm_stop = 1;
$comm_down = 2;

// Once every day on a specific hour
if (date('H:i', $time_now) == '08:00')
{
	$fh = fopen('http://' . $config['ArduinoBlindsControl']['ip'] . '/?chan' . $chan . ',' . $comm_up . ',20000', 'rb');
	if ($fh)
	{
		$content = stream_get_contents($fh);
		fclose($fh);
	}
}

if (date('H:i', $time_now) == '22:00')
{
	$fh = fopen('http://' . $config['ArduinoBlindsControl']['ip'] . '/?chan' . $chan . ',' . $comm_down . ',20000', 'rb');
	if ($fh)
	{
		$content = stream_get_contents($fh);
		fclose($fh);
	}
}