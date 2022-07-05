#!/bin/bash

docker-compose exec backend bash composer create-project --prefer-dist yiisoft/yii2-app-basic .

echo "CAMBIANDO PROPIETARIOS: ...."

docker-compose exec backend chown www-data:www-data ./web/assets -R &&\
  echo "+Propietario modificado a ./web/assets" &&\
  docker-compose exec backend chown www-data:www-data ./runtime -R && \
  echo "+Propietario modificado a ./runtime" &&\
  echo "PROPIETARIOS MODIFICADOS CORRECTAMENTE!"
