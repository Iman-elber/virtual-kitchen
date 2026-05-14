## About The Project

This was my first full web application project, where I explored frontend and backend integration while building a basic virtual kitchen system.

Through this project, I developed experience in:
- structuring frontend interfaces
- connecting frontend and backend functionality
- improving usability and interaction flow
- testing and evaluating system behaviour

## Future Improvements
- Improve UI design and responsiveness
- Enhance user experience and accessibility
- Refactor backend structure
- Add authentication and database functionality

## How to Run Locally
1. Download or clone this repository.
2. Move the project folder into your local server directory:
   - XAMPP: `htdocs`
   - MAMP: `htdocs`
   - WAMP: `www`
3. Start Apache and MySQL from XAMPP/MAMP/WAMP.
4. Create a MySQL database.
5. Import the provided `.sql` database file into phpMyAdmin.
6. Update the database connection file with your own local credentials:

```php
$db_host = 'localhost';
$db_name = 'your_database_name';
$username = 'your_username';
$password = 'your_password';
```
7. Open the project in your browser:
http://localhost/project-folder-name
