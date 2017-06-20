# Control Panel API

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/3200ceba8aea4a31ac1dfe826328bcb1)](https://www.codacy.com/app/laravel-enso/ControlPanelApi?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=laravel-enso/ControlPanelApi&amp;utm_campaign=Badge_Grade)
[![StyleCI](https://styleci.io/repos/88979520/shield?branch=master)](https://styleci.io/repos/88979520)

The package depends on the Laravel/Passport official package.

### Installation

Follow the standard steps for completing the [Passport package install](https://laravel.com/docs/5.4/passport#installation):
* Add `Laravel\Passport\PassportServiceProvider::class,` to your providers list in `config/app.php`.
* run `php artisan migrate`
* run `php artisan passport:install`
* put  `Passport::routes()` within the boot method of the `AuthServiceProvider` class
* set `'driver' => 'passport',` inside `config/auth.php` for the api guard.
* publish the laravel passport FE components: `php artisan vendor:publish --tag=passport-components`
* register the components in `resources/assets/js/app.js`
    - Vue.component('passport-clients', require('./components/passport/Clients.vue'));
    - Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue'));
    - Vue.component('passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue'));
* compile the js assets `npm run dev`, `gulp`, etc.
* include the component `<passport-clients></passport-clients>` where desired.

Next steps are required for this package:

* Add `LaravelEnso\ControlPanelApi\ControlPanelApiServiceProvider::class` to your providers list in `config/app.php`.
* Run the migrations. 
* Use the FE to define an OAuth client, and take note of the ID and the secret (you'll need these in the client that consumes the services)