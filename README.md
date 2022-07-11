
## About UniversalHQ

This is the universal HQ Backend for [Foxhole](https://www.foxholegame.com/) 

- Historized War Data
- Live Map
- Awesome planing tool
- Group management 
- ... 

Presented By Warden Clans.

## Development

Nothing you have read above actually exists. But this project is under active development.  

This is a PHP Laravel Project. The frontend will be done in VueJs / Livewire / InertiaJS. 

* The foxhole API is integrated and WarReports are saved historically.

ToDo: 
* Add frontend map view.
* Add User management.
* Add interaction on the map.
* Save map states.

Done:
* Integrate Foxhole API
* Historize MapData

If you want to help, contact me on discord: Afrowner#9766

SETUP:
#### if you just want to use the project to develop frontend:

    sh devFastBuild.sh
    docker-compose -f x_infrastructure/deployment/local/docker-compose.yml exec universal-backend php artisan migrate:fresh --seed

#### if you want to develop for the backend:

1. `composer install`
2. `sh devBuild.sh`
3. setup local environment and ide helpers:


    docker-compose -f x_infrastructure/deployment/local/docker-compose.yml exec universal-backend php artisan migrate:fresh --seed
    docker-compose -f x_infrastructure/deployment/local/docker-compose.yml exec universal-backend php artisan ide-helper:generate
    docker-compose -f x_infrastructure/deployment/local/docker-compose.yml exec universal-backend php artisan ide-helper:meta

Connect to app container:

    docker-compose -f x_infrastructure/deployment/local/docker-compose.yml exec universal-backend bash
