ArduinoBlindsControl-WebRemote
==============================

Web Remote for the Arduino Blinds Control.

## Instructions: Requirements

- Webserver (Apache/PHP) in the same network as your ArduinoBlindsControl

## Instructions: Installation

<ul>
	<li>Rename the "config.sample.php" file to "config.php" and set your local configuration</li>
	<li>Put the "cron.php" file in your crontab, ex on Debian/Ubuntu based systems:
		<ul>
			<li>Edit your crontab ("crontab -e")</li>
			<li>Enter the following entry so it will run every 5 minutes (with the correct path to your cron.php file): "*/5 * * * * /usr/bin/php5 /path/to/cron.php >> /path/to/cron_abc_wr.log 2>&1"</li>
		</ul>
	</li>
</ul>

## Changelog

- v0.2: Configuration in separated configuration file, very basic website with direct control
- v0.1: Initial commit, hardcoded cronfile only

## Todo

- A website/database to control and configure the scheduling
- Support different fixed scheduling for all days of the week (possible with season difference).
- Support dynamic time of sunrise/sunset (+/- an offset) for your location instead of fixed hours
- Direct control aside of the scheduled control