## About twilio_inertiajs_2fa

A simple Two-factor authentication application using Twilio Verify API, Laravel, Inertia.Js and Vue.js.
The application was build to accompany a tutorial published on the Twilio blog.

We implemented the Two-factor verification by

-   Scaffolding authentication in a Laravel application using Laravel Breeze, Inertial.js, and Vue.Js
-   Inject an OTP system into our authentication flow using Twilio Verify API
-   Create a middleware to restrict access to the dashboard until a given phone number is verified

## Serve Application

To get the application running, do the following

-   clone from the public repo
-   install dependencies using `composer install` and `npm install`
-   run migration using `php artisan migrate`
-   serve application using `php artisan serve` and `npm run dev`

I hope you find this helpful.

## Contributing

Thank you for considering contributing to this application!
Create a new branch with your changes and raise a pull request.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
