<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1400 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- [UserInsights](https://userinsights.com)
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)
- [Invoice Ninja](https://www.invoiceninja.com)
- [iMi digital](https://www.imi-digital.de/)
- [Earthlink](https://www.earthlink.ro/)
- [Steadfast Collective](https://steadfastcollective.com/)
- [We Are The Robots Inc.](https://watr.mx/)
- [Understand.io](https://www.understand.io/)
- [Abdel Elrafa](https://abdelelrafa.com)
- [Hyper Host](https://hyper.host)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

----
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
1. Install WAMPServer
	a. Adjust the version of wampserver to 7.2.18
	b. Add php to path in environment variables.
		- PHP bin is in `./wamp64/bin/php/`

2. Install SQLServer 2012
	a. Forgot prerequisites (e.g. Redists). Please update this.
	b. Forgot installation details. Please update this.

3. Replace php.ini on `./wamp64/bin/php/php7.2.18/`.
	a. Download php.ini here: `link_to_file_here`
	b. Manual edit:
		- put instructions here

4. Since SQLSRV4.0 is incompatible to php 7.2.* download SQLSRV5.3 files to `./wamp64/bin/php/php7.2.18/ext/`
	a. Download link: [SQLSRV5.3 download site](https://www.microsoft.com/en-us/download/details.aspx?id=57163&WT.mc_id=rss_alldownloads_devresources)
	b. Install the download. It will give a folder of SQLServer drivers for PHP.
	c. Copy files in `php_pdo_sqlsrv_72_ts_x64.dll` and `php_sqlsrv_72_ts_x64.dll> to <./wamp64/bin/php/php7.2.18/ext/`

5. Clone repository or get copy of repository from Github to Wamp folder `./wamp64/www/`:
	a. Repository: https://github.com/Jetszxcki/LECCO-System
	b. SSH : git@github.com:Jetszxcki/LECCO-System.git

6. Run Laravel server:
	a. Run: `php artisan serve`
		- If it runs but localhost:8000 keeps loading, run “php artisan config:cache” then restart server.
	b. Alternative command: `php -S localhost:8000 -t public/`