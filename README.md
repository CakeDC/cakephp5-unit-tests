# CakePHP 5 unit tests session contents

## Requirements

* PHP 8.3 installed, using the required CakePHP extensions AND using sqlite3 extension for database operations
* Composer installed
* A browser?

## Setup

* Clone the repo `git clone https://github.com/CakeDC/cakephp5-unit-tests.git`
* `composer install`
* Update your `config/app_local.php` file to configure your database, for example use `sqlite://127.0.0.1/tmp/db.sqlite`
* Run migrations `bin/cake migrations migrate`
* Run the standalone server using `bin/cake server`
* You'll need to register first to create an account, then login and play a http://www.samkass.com/theories/RPSSL.html game
