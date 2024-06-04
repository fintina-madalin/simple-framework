-- Create the cities table
CREATE TABLE IF NOT EXISTS cities
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name TEXT NOT NULL
);

-- Create the contacts table
CREATE TABLE IF NOT EXISTS contacts
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    last_name TEXT NOT NULL,
    first_name TEXT NOT NULL,
    email TEXT NOT NULL,
    city_id INT NOT NULL,
    street TEXT NOT NULL,
    zip_code TEXT NULL,
    FOREIGN KEY (city_id) REFERENCES cities (id)
);

-- Create the groups table
CREATE TABLE IF NOT EXISTS groups
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name TEXT NOT NULL
);

-- Create the contacts_groups table to manage many-to-many relationship between contacts and groups
CREATE TABLE IF NOT EXISTS contacts_groups
(
    contact_id INT NOT NULL,
    group_id INT NOT NULL,
    PRIMARY KEY (contact_id, group_id),
    FOREIGN KEY (contact_id) REFERENCES contacts(id),
    FOREIGN KEY (group_id) REFERENCES groups(id)
);

-- Create the group_connections table to manage group inheritance
CREATE TABLE IF NOT EXISTS group_connections
(
    parent_group_id INT NOT NULL,
    child_group_id INT NOT NULL,
    PRIMARY KEY (parent_group_id, child_group_id),
    FOREIGN KEY (parent_group_id) REFERENCES groups(id),
    FOREIGN KEY (child_group_id) REFERENCES groups(id)
);

-- Create the tags table
CREATE TABLE IF NOT EXISTS tags
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name TEXT NOT NULL
);

-- Create the contacts_tags table to manage many-to-many relationship between contacts and tags
CREATE TABLE IF NOT EXISTS contacts_tags
(
    contact_id INT NOT NULL,
    tag_id INT NOT NULL,
    PRIMARY KEY (contact_id, tag_id),
    FOREIGN KEY (contact_id) REFERENCES contacts(id),
    FOREIGN KEY (tag_id) REFERENCES tags(id)
);
