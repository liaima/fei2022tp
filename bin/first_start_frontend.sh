#!/bin/bash

echo "Iniciando proyecto frontend"

read -p "Igrese el path de la app: " path
cd $path

if [[ ! -d ./frontend ]];
then
  echo "No exite el directorio fronend. Creando..."
  mkdir fronend
  cd frontend/
  docker run --rm -v $PWD:/aulas -w "/aulas" -it node:17.8.0-alpine3.14 sh -c "npm install -g @vue/cli && vue create ."
else
  echo "Ya existe un directorio frontend, iniciando proyecto..."
  cd frontend/
  docker run --rm -v $PWD:/aulas -w "/aulas" -it node:17.8.0-alpine3.14 sh -c "npm install"
fi
