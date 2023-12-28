## Uruchomienie Aplikacji

1. **Sklonuj repozytorium:**
    ```bash
    git clone https://github.com/kcarol3/symfony_6_project.git
    ```

2. **Uruchom bazę danych z Docker Compose:**
    ```bash
    docker-compose up -d
    ```

3. **Zainstaluj zależności za pomocą Composer:**
    ```bash
    cd symfony_6_project
    composer install
    ```

4. **Uruchom serwer Symfony na porcie 8000:**
    ```bash
    php bin/console server:start --port=8000
    ```

5. **Wykonaj migracje do bazy danych:**
    ```bash
    php bin/console doctrine:migration:migrate
    ```

## Funkcjonalności:

>**Dodanie postów do bazy poleceniem konsolowym:**
<br/><br/>
```bash
php bin/console app:create-posts
```
<br/><br/>
![Opis obrazu](https://github.com/kcarol3/symfony_6_project/blob/master/screen4.png)

>**Wyświetlenie wszystkich postów z możliwością usunięcia**
<br/><br/>
![Opis obrazu](https://github.com/kcarol3/symfony_6_project/blob/master/screen1.png)

>**Logowanie do aplikacji:**
<br/><br/>
![Opis obrazu](https://github.com/kcarol3/symfony_6_project/blob/master/screen2.png)

>**Udostępnienie Api do pobrania postów z bazy:**
<br/><br/>
![Opis obrazu](https://github.com/kcarol3/symfony_6_project/blob/master/screen3.png)




