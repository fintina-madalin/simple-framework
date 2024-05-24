-- Create the cities table
CREATE TABLE IF NOT EXISTS cities
(
    id   INT AUTO_INCREMENT PRIMARY KEY,
    name TEXT NOT NULL
);

-- Create the main table with the fields (name, first name, email, street, zip-code, city_id)
CREATE TABLE IF NOT EXISTS contacts
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    last_name       TEXT    NOT NULL,
    first_name TEXT    NOT NULL,
    email      TEXT    NOT NULL,
    city_id    INT NOT NULL,
    street     TEXT    NOT NULL,
    zip_code   TEXT    NULL,
    FOREIGN KEY (city_id) REFERENCES cities (id)
);
