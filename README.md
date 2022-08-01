# fei2022tp

## Puesta en marcha del ambiente:

- Clonar el Repositorio e ingresar a la carpeta:

```
  git clone https://github.com/liaima/fei2022tp.git
  cd ./fei2022tp
```

- Configurar las Variables de Entono:

```
  cp .env-dist .env
```

- Ejecutar el docker compose:

```
  docker-compose up -d
```

- Correr el sript de primer inicio:

```
bin/first_start.sh
```

- Instalar paquetes npm:

```
bin/npm.sh update
```

- Correr las migraciones:

```
bin/yii.sh migrate
```
