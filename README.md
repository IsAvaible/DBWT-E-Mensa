# E-Mensa

## Description

This is a simple php project created for the module `Datenbanken und Webtechnologien` in WS 2023-2024.

## Screenshots

#### Homepage

![Screenshot of the Homepage](/dossier/assets/Homepage%20Top.png)

#### Login

![Screenshot of the Login Page](/dossier/assets/Login.png)

#### Rating Form

![Screenshot of the Rating Form Page](/dossier/assets/Rating%20Form.png)

#### Ratings

![Screenshot of the Ratings Page](/dossier/assets/Ratings.png)

## Authors

#### Simon Conrad

- GitHub: https://github.com/IsAvaible

#### Henning Schreiber

- GitHub: https://github.com/Schr3iber

## Features

* **Dish Display:** Intuitive layout showcasing available dishes with images, titles, descriptions (including allergy
  information), and prices.
* **Ratings & Reviews:** Users can view existing ratings for dishes and submit their own reviews after logging in.
* **User Authentication:** Login system for users to access features like submitting reviews or their profile page.
* **Admin Functionality:** Administrators can delete reviews or highlight them to be shown on the homepage

## Installation

1. Clone the repository
2. Navigate into the emensa directory
   ```shell
   cd emensa
   ```
3. Install the required packages in the emensa directory using the following command:
    ```shell
    php composer install
    ```
4. Setup the database
    - Install MariaDB
    - Create the database
      ```shell
      CREATE DATABASE emensawerbeseite
        CHARACTER SET UTF8mb4
        COLLATE utf8mb4_unicode_ci;
      ```
    - Load the database dump:
      ```shell
      mysql -u root -p emensawerbeseite < emensawerbeseite.sql  
      ```
    - Run the m5_5.sql script to create a necessary login procedure:
      ```shell
      mysql -u root -p emensawerbeseite < beispiele/m5_5.sql
      ```
5. Enable the MySQL PHP Driver
6. Run the following command to serve the application:
    ```bash
    php -S localhost:8080 -t "./public"
    ```

The site should now be accessible under http://localhost:8080

The login credentials for the admin account are:

- Email: admin@emensa.example
- Password: 19c9449c1bd8008c83e5303231e0d06bf9a37869

## Documentation

The documentation can be found in the `dossier` directory. It contains the following files:

- [M1.md](dossier/Meilenstein%201.md)
- [M2.md](dossier/Meilenstein%202.md)
- [M3.md](dossier/Meilenstein%203.md)
- [M4.md](dossier/Meilenstein%204.md)
- [M5.md](dossier/Meilenstein%205.md)
- [M6.md](dossier/Meilenstein%206.md)