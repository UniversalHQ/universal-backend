cd x_infrastructure/deployment/local

docker-compose pull
docker-compose build
docker-compose up -d

#docker-compose exec universal-backend php artisan migrate:fresh --seed
#docker-compose exec universal-backend php artisan ide-helper:generate
#docker-compose exec universal-backend php artisan ide-helper:meta

