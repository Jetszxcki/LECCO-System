# NOTE: Please test changes and check errors in changes before committing. Thanks!

# System Setup

## System Requirements:
- WAMPServer 3.1.9
> Installer can be accessed in: [WAMPServer download site](http://wampserver.aviatechno.net/)
- PHP 7.2.21
> Preferred but built in php 7.2.18 in WAMP works.
> No need to find installer if going to use v7.2.18.
- SQLServer 2012
> If we have online copy, put link here.

## Setup:
#### Install WAMPServer
- Adjust the version of wampserver to 7.2.18
- Add php to path in environment variables.
    - PHP bin is in `./wamp64/bin/php/`

#### Install SQLServer 2012
- Forgot prerequisites (e.g. Redists). Please update this.
- Forgot installation details. Please update this.

#### Replace php.ini on `./wamp64/bin/php/php7.2.18/`.
- Download php.ini here: `link_to_file_here`
- Manual edit:
    - put instructions here

#### Download SQL Srver drivers for PHP. SQLSRV5.3 files to `./wamp64/bin/php/php7.2.18/ext/`
- Download link: [SQLSRV5.3 download site](https://www.microsoft.com/en-us/download/details.aspx?id=57163&WT.mc_id=rss_alldownloads_devresources)
- Install the download. It will give a folder of SQLServer drivers for PHP.
- Copy files in `php_pdo_sqlsrv_72_ts_x64.dll` and `php_sqlsrv_72_ts_x64.dll> to <./wamp64/bin/php/php7.2.18/ext/`

#### Clone repository or get copy of repository from Github to Wamp folder `./wamp64/www/`:
- Repository: https://github.com/Jetszxcki/LECCO-System
- SSH : git@github.com:Jetszxcki/LECCO-System.git

#### Font Package:
- Apply this step only if production of system is done in an offline environment (local).
- Extract the Nunito.zip file (found at the repo) or download the font at https://fonts.google.com/specimen/Nunito and install it to your computer system.

#### Run Laravel server:
- Run: `php artisan serve`
    - If it runs but localhost:8000 keeps loading, run `php artisan config:cache` then restart server.
- Alternative command: `php -S localhost:8000 -t public/`

## Some errors you might encounter:
- getColumnType() error:
    - Install form table column dependency by typing the following command: `composer require doctrine/dbal`.
