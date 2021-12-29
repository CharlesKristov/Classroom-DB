# DB-WebApp

A project for DBMS course on Binus University.

## ERD Diagram

[Lucid Chart -- ERD](https://lucid.app/lucidchart/e803c288-aad0-4268-bbab-7007388bd60f/edit?invitationId=inv_12158997-fda3-4caf-b31f-216c213d051a&page=0_0#)

## Tech Stack

- Bootstrap 5
- PHP (8.1)
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

<table>
  <tr>
    <td align="middle"><img src="https://stbm7resourcesprod.blob.core.windows.net/profilepicture/e37f6235-26f0-4f80-9f8f-956ffdf8eb66.jpg"></td>
    <td align="middle"><img src="https://stbm7resourcesprod.blob.core.windows.net/profilepicture/8098b4a3-3bc7-4a51-a6e9-ad9c0455af8b.jpg"></td>
    <td align="middle"><img src="https://stbm7resourcesprod.blob.core.windows.net/profilepicture/77998c8f-7dfc-4f41-a5f9-38f1027b3ade.jpg"></td>
  </tr>
  <tr>
     <td align="middle">Charles Christopher</td>
     <td align="middle">Oliver Chico</td>
     <td align="middle">Made Agustha I.S.</td>
  </tr>
  <tr>
     <td align="middle">2440062924</td>
     <td align="middle">2440055635</td>
     <td align="middle">2440048970</td>
  </tr>
  <tr>
     <td align="middle"><a href="https://github.com/CharlesKristov">@CharlesKristov</a></td>
     <td align="middle"><a href="https://github.com/Oiko78">@Oiko78</a></td>
     <td align="middle"><a href="https://www.github.com/agusthas">@agusthas</a></td>
  </tr>
 </table>
