# User Data App

Esta aplicación consume datos de usuarios desde un endpoint y los guarda en una base de datos. El proceso de consumo y almacenamiento se ejecuta automáticamente cada 5 minutos utilizando una tarea programada (`cron`).

## Instalación

1. Clona el repositorio:

    ```bash
    git clone del repositorio
    ```

2. Navega al directorio del proyecto:

    ```bash
    cd UserDataApp
    ```

3. Instala las dependencias del proyecto:

    ```bash
    composer install
    ```

4. Configura el archivo `.env`:

    - Copia el archivo `.env.example` a `.env`.
    - Configura las variables de entorno como la conexión a la base de datos y la URL base.

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5. Ejecuta las migraciones para crear las tablas necesarias en la base de datos:

    ```bash
    php artisan migrate
    ```

## Configuración del Cron Job

Para ejecutar automáticamente el proceso cada 5 minutos, necesitas configurar un cron job en tu sistema operativo. Sigue estos pasos:

1. Abre el archivo `crontab`:

    ```bash
    crontab -e
    ```

2. Añade la siguiente línea al archivo `crontab` para programar la tarea cada 5 minutos:

    ```bash
    */5 * * * * /usr/bin/php /ruta/de/tu/proyecto/artisan fetch:users
    ```

    - **`/usr/bin/php`**: Asegúrar esta que la ruta a PHP es correcta en el sistema.
    - **`/ruta/de/tu/proyecto`**: Reemplaza esto con la ruta del proyecto Laravel.

3. Guarda y cierra el archivo `crontab`.

El cron job ahora está configurado para ejecutar el comando `fetch:users` cada 5 minutos.

## Ejecución Manual

Si necesitas ejecutar el comando manualmente, puedes hacerlo usando Artisan:

```bash
php artisan fetch:users