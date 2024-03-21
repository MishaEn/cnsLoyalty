-- create_tables.sql
CREATE TABLE users (
    id bigint NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    PRIMARY KEY (id)
);
CREATE TABLE `groups` (
    id bigint NOT NULL,
    name varchar(255) NOT NULL,
    PRIMARY KEY (id)
);
CREATE TABLE permissions (
    id bigint NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    PRIMARY KEY (id)
);
CREATE TABLE user_groups (
    id bigint NOT NULL AUTO_INCREMENT,
    user_id bigint,
    groups_id bigint,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (groups_id) REFERENCES `groups`(id),
    PRIMARY KEY (id)
);
CREATE TABLE permission_groups (
    id bigint NOT NULL AUTO_INCREMENT,
    groups_id bigint,
    permission_id bigint,
    FOREIGN KEY (groups_id) REFERENCES `groups`(id),
    FOREIGN KEY (permission_id) REFERENCES permissions(id),
    PRIMARY KEY (id)
);
CREATE TABLE blocked_user (
    id bigint NOT NULL AUTO_INCREMENT,
    user_id bigint,
    permission_id bigint,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (permission_id) REFERENCES permissions(id),
    PRIMARY KEY (id)
);

INSERT INTO users (id, name) VALUES (1, 'Vasya');
INSERT INTO users (id, name) VALUES (2, 'Petya');
INSERT INTO users (id, name) VALUES (3, 'Gachimuchi');

INSERT INTO permissions (id, name) VALUES (1, 'send_messages');
INSERT INTO permissions (id, name) VALUES (2, 'service_api');
INSERT INTO permissions (id, name) VALUES (3, 'debug');

INSERT INTO `groups` (id, name) VALUES (1, 'admin');
INSERT INTO `groups` (id, name) VALUES (2, 'user');

INSERT INTO permission_groups (id, groups_id, permission_id) VALUES (1, 1, 1);
INSERT INTO permission_groups (id, groups_id, permission_id) VALUES (3, 2, 1);
INSERT INTO permission_groups (id, groups_id, permission_id) VALUES (4, 2, 2);
INSERT INTO permission_groups (id, groups_id, permission_id) VALUES (5, 2, 3);

INSERT INTO user_groups (id, user_id, groups_id) VALUES (1, 1, 1);

INSERT INTO blocked_user (id, user_id, permission_id) VALUES (1, 3, 1);