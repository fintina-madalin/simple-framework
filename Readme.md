## Simple framework

### Follow the bellow instructions(point 1 OR point 2)
#### 1) Standard implementation
1. Create a new schema in your database
2. Add your connection details in ``src/Core/Config.php`` file
3. Run the queries in ``db_create.sql`` in your database
4. Run the queries in ``db_insert.sql`` in your database
5. Open a terminal and run ``cd public && php -S 127.0.0.1:8000``
6. Visit ``127.0.0.1:8000`` in your browser

#### 2) Using the simple binary
1. Create a new schema in your database
2. Add your connection details in ``src/Core/Config.php`` file
3. Open a terminal and run ``./simple db_create`` - this will create the schema defined in config and create the needed tables
4. Run in the terminal ``./simple db_insert`` - this will insert dummy data into the database
5. Run in the terminal ``./simple serve`` - this will start a webserver on port 8000
6.Visit ``127.0.0.1:8000`` in your browser