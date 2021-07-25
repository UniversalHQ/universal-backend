cd x_infrastructure/deployment/local

docker-compose -f docker-compose-fast.yml pull
docker-compose -f docker-compose-fast.yml build
docker-compose -f docker-compose-fast.yml up -d

#docker-compose exec universal-backend php artisan migrate:fresh --seed
