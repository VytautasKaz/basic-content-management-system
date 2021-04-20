# Basic Content Management System (CMS)

## Description:

A basic content management system developed using PHP ORM tools. Features:

- Guest page with a navigation menu.
- Administration page, where CRUD (create, read, update, delete) operations can be performed (to reach this page, you need to add '/admin' to the address bar: http://localhost/cms/admin).
- Basic authentication to access administration page, with username and password provided as placeholders in the login form.

## Launch instructions:

- Clone this repository or download it as a ZIP package.
- Clone/extract it to your AMPPS (.../AMPPS/www/), XAMPP or other web server platform directory.
- **_Make sure that the downloaded/cloned repository folder is named 'cms'._**
- If needed, install composer (installation instructions: https://getcomposer.org/download) and using terminal download Doctrine ORM:
  - if composer is installed locally: php <'path to composer.phar file location'>/composer.phar install
  - if composer is installed on your system globally: composer install
- Import 'cms_db.sql' database into your local MySQL server.
- Open the app via your preferred web browser (http://localhost/cms/).

## Author:

[Vytautas K.](https://github.com/VytautasKaz)
