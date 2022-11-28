CREATE TABLE IF NOT EXISTS user (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(64) NOT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP


);
CREATE TABLE IF NOT EXISTS project (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY(user_id)
        REFERENCES user(id)
            ON DELETE CASCADE
            ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS task (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    is_completed INT DEFAULT 0,
    file_path VARCHAR(255),
    end_date TIMESTAMP,
    date_of_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT NOT NULL,
    project_id INT NOT NULL,

    FOREIGN KEY(user_id)
      REFERENCES user(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    FOREIGN KEY(project_id)
        REFERENCES project(id)
            ON DELETE CASCADE
            ON UPDATE CASCADE
);

ALTER TABLE task ADD FULLTEXT INDEX(name);
ALTER TABLE project ADD UNIQUE INDEX unique_project_idx (user_id, name);
