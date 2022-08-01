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
- Correr el sript de primer inicio para el Frontend:
Tenga a mano el path de a la app

```
pwd
bin/first_start_frontend.sh
```

- Ejecutar el docker compose:

```
  docker-compose up -d
```

- Correr el sript de primer inicio:

```
bin/first_start_backend.sh
```

- Correr las migraciones:

```
bin/yii.sh migrate
```

- Finalmente abrir la app en http://localhost:8080
