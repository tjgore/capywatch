# CapyWatch

Track the daily movement of Capybaras in selected cities.

Read more details [here](https://gist.github.com/damiani/15179139347b909edd280d04a94fa972).
If link is broken, see [capy.md](capy.md).

View the live [demo](https://google.com).

## Built With

Laravel, React, Vite, and Tailwind CSS

## Tools needed to run locally

Mysql, composer 2+, node v18.18.0, npm
php8.1

## Getting started

Clone the repo

```bash
git clone
```

Install PHP dependencies

```bash
cd capywatch
composer install

```

Install JS dependencies

```bash
cd capywatch-ui

# if you have nvm installed to use same node version as project
nvm use
#if you don't have the right node version you will not be able to install dependencies

npm install

```

Add laravel and vite envs

```bash
# in root of project
cp .env.example .env

php artisan key:generate

```

```bash
# in root of project
cd capywatch-ui

cp .env.example .env
```

Database setup

```bash
# create local database using mysql cli

echo "CREATE DATABASE capywatch" | mysql -u root

# for testing
echo "CREATE DATABASE capywatch_testing" | mysql -u root
```
If your mysql user needs a password update your laravel database env.
If you don't need a password, carry on.

Run migrations, seed and tests

```bash
# in root of project

php artisan migrate
php artisan db:seed
php artisan test
```

Run the app

Run Laravel using valet.

You can also use php artisan serve command but you will need to update the urls in the env files, both laravel and vite. Not tested.

```bash
# in root of project
valet link
valet open
```

Run React with Vite

```bash
cd capywatch-ui
npm run dev

# keep running
```

## API Endpoints

If you have VS Code and you can install this REST Client extension to test the endpoints.
https://marketplace.visualstudio.com/items?itemName=humao.rest-client

Endpoints can be found in the `api.http` file.

Start from the first request and go down the list sending each request.
Some request have variables above them. You may or may not need to update them to run some requests.

You should be fine from a fresh install.


## Deployment

Add Vite and Laravel prod env files to server

```bash
# in root of project
# change file permissions
php artisan migrate --force
php artisan config:clear
php artisan cache:clear
```

Build the react app

```bash
cd capywatch-ui
npm run build -- --base=/dist/
mv dist ../public
```

Update nginx to serve both laravel and vite from the same domain.

## Notes

Add vite alias to simplify imports.

Add capybara page to show all capybaras.