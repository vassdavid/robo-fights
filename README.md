# Robot Fights

**Robot Fights** is a Symfony project using Webpack Encore for asset management and Docker for the database. Follow this guide to set up the project on your local machine.

## Prerequisites

Before you begin, ensure you have the following installed:

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [PHP 8.2](https://www.php.net/manual/en/install.php) (for running commands locally)
- [Composer](https://getcomposer.org/download/) (for PHP dependencies)
- [Node.js](https://nodejs.org/en/download/) and [npm](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm) (for asset management)
- [Symfony](https://symfony.com/doc/current/setup.html)

## Start WebApp and installs

1. ``` composer install ```

2. ``` docker compose up -d ```

3. ``` php bin/console doctrine:migrations:migrate ```

4. ``` php bin/console doctrine:fixtures:load ```

5. ``` composer install ```

6. ``` npm install ```

7. ``` npm run build ```

8. ``` symfony serve ```