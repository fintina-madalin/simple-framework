## Simple framework

### Follow the bellow instructions(point 1 OR point 2)

1. Create a new schema in your database
2. Add your connection details in ``src/Core/Config.php`` file
3. Open a terminal and run ``php composer.phar install``
4. Follow one of the flows bellow to continue

#### 1) Standard implementation
1. Run the queries in ``db_create.sql`` in your database
2. Run the queries in ``db_insert.sql`` in your database
3. Open a terminal and run ``cd public && php -S 127.0.0.1:8000``
4. Visit ``127.0.0.1:8000`` in your browser

#### 2) Using the simple binary
1. Open a terminal and run ``./simple db_create`` - this will create the schema defined in config and create the needed tables
2. Run in the terminal ``./simple db_insert`` - this will insert dummy data into the database
3. Run in the terminal ``./simple serve`` - this will start a webserver on port 8000
4. Visit ``127.0.0.1:8000`` in your browser