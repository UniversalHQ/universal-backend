
## About UniversalHQ

This is the universal HQ for [Foxhole](https://www.foxholegame.com/) 

- Historized War Data
- Live Map
- Awesome planing tool
- Group management 
- ... 

Presented By [3SP](https://discord.gg/sZs5UZf) a german Warden Clan.

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

    docker build --rm -t universal_hq/backend -f x_infrastructure/docker/app/Dockerfile .
    docker build --rm -t universal_hq/web -f x_infrastructure/docker/web/Dockerfile .
    docker-compose up -d
    docker exec -i wardenhq_universal-backend_1 bash < start.sh

Connect to app container:

    docker-compose exec universal-backend bash