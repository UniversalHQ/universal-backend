FROM node:latest as build-stage

WORKDIR /app
# prepare building
COPY package.json package-lock.json webpack.mix.js ./
RUN npm install
#coppy required files and build js/css
COPY ./resources ./resources
COPY ./public ./public
RUN npm run production

FROM nginx:1.19.1-alpine

#configure the nginx and copy the build public folder
ADD x_infrastructure/docker/web/vhost.conf /etc/nginx/conf.d/default.conf
COPY --from=build-stage /app/public /var/www/public/assets/
