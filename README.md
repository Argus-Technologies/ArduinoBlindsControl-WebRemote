ArduinoBlindsControl-WebRemote
==============================

Web Remote for the Arduino Blinds Control.

## Instructions: Requirements

- Webserver (Apache/PHP) in the same network as your ArduinoBlindsControl

## Instructions: Installation

Debian/Ubuntu based systems:
- Edit your crontab ("crontab -e")
- Enter the following entry in your crontab (with the correct path to your cron.php file): "*/5 * * * * /usr/bin/php5 /var/www/abc_wr/cron.php >> /var/cron_abc_wr.log 2>&1"

## Todo

- A website/database to control and configure the scheduling
- Support different fixed scheduling for all days of the week (possible with season difference).
- Support dynamic time of sunrise/sunset (+/- an offset) for your location instead of fixed hours
- Direct control aside of the scheduled control