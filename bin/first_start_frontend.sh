#!/bin/bash

echo "Iniciando proyecto frontend"

cd ../

if [[ ! -d ./fronend ]];
then
  echo "No exite el directorio fronend. Creando..."
  mkdir fronend
  cd fronend/
  docker run --rm -v $PWD:/aulas -w "/aulas" -it node:17.8.0-alpine3.14 sh -c "npm install -g @vue/cli && vue create ."
else
  cd fronend/
  docker run --rm -v $PWD:/aulas -w "/aulas" -it node:17.8.0-alpine3.14 sh -c "npm install"
fi
