## About App

This app consists of a client-facing form used to gather submissions for insurance quotes and a Jetstream-powered backend for
viewing submissions. The following technologies were used:

- Laravel v10.47.0
- Vue 3
- Tailwind
- Inertia
- Jetstream

## Installation instructions

The app comes with a docker setup to help you run it on your local environment. Assuming you have Docker on your machine, you can follow
these steps to get the project running.

Go into the project directory
```
cd riskadvisor
```

Run these commands to build the containers
```
docker compose build
```
```
docker compose up -d
```

This will setup containers serving the following
- An nginx instance
- A MySQL instance
- A container instance that exposes the app for you to run php artisan and compose commands
- An instance to install node dependencies and serve the frontend of the app

Next, install project dependencies with composer
```
docker compose exec app bash -c "composer install"
```

Generate an app key for Laravel
```
docker compose exec app bash -c "php artisan key:generate"
```

Run migrations and seeders
```
docker compose exec app bash -c "php artisan migrate --seed"
```

To access the terminal for running further artisan or composer commands
```
docker compose exec app bash
```

Visit `http://localhost:8000/submission` to access the quote submission form

