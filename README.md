# DB-WebApp

A project for DBMS course on Binus University.

## ERD Diagram

[Lucid Chart -- ERD](https://lucid.app/lucidchart/e803c288-aad0-4268-bbab-7007388bd60f/edit?invitationId=inv_12158997-fda3-4caf-b31f-216c213d051a&page=0_0#)

## Tech Stack

- Bootstrap 5
- PHP
- MySQL
- Apache

## Run Locally

### Start XAMPP(PHP, MySQL, Apache)

- **Windows**: _please read the documentation on how to run it_
- **Mac**: _please read the documentation on how to run it_
- **Linux**:
  ```bash
  $ sudo /opt/lampp/lampp start
  ```

### Clone the project

```bash
  git clone https://github.com/CharlesKristov/DB-WebApp
```

To make life easier, make sure to put the cloned project directory in `htdocs` folder. This can be found in:

- **Windows** : `C:/xampp/htdocs`
- **Linux** : `/opt/lampp/htdocs`

### Database setup

1. Open browser and navigate to `localhost/phpmyadmin`.
2. Create a new database named `student_database`.
3. Import [student_database.sql](./student_database.sql) that is included in the project directory to the database.
4. Make sure every query successfully executed.

Navigate to [localhost/DB-WebApp](http://localhost/DB-WebApp) and login with one of the secrets in [secrets](./.secrets).

## Authors

- [@CharlesKristov](https://github.com/CharlesKristov) (Owner)
- [@agusthas](https://www.github.com/agusthas) (Contributor)
- [@Oiko78](https://github.com/Oiko78) (Contributor)
