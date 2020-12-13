## Description
Api service for smart devices.  
**Service in development**

## Install

1. `touch .env && make init` - generate .env
1. `make up && make exec` - enter to container
1. `composer install`
1. `npm install && npm run prod`
1. `php artisan migrate`
1. `php artisan admin:create` - for create admin user
1. `php artisan schedule:work > schedule-work.txt &` - start schedule worker
