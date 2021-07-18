CREATE DATABASE `usersDb`;


CREATE TABLE `user`
(
    id int auto_increment primary key,
    user_name varchar(100),
    user_email varchar(150),
    user_pass varchar(100),
    id_role int
);



CREATE TABLE `userRole`
(
    id int auto_increment primary key,
    user_role varchar(100)
);

CREATE TABLE `person`
(
    id int auto_increment primary key,
    person_name varchar(200),
    person_lastname varchar(200),
    person_avatar varchar(100)
    id_user int
);

-- ALTER TABLE FOREING KEYS

ALTER TABLE `person` ADD FOREIGN KEY(id_user) REFERENCES `user`(id);
ALTER TABLE `user` ADD FOREIGN KEY(id_role) REFERENCES `userRole`(id);
ALTER TABLE `person` ADD FOREIGN KEY(id_user) REFERENCES `user`(id);

-- INSERT
INSERT INTO userRole(user_role) values('admin');

INSERT INTO user(user_name,user_email,user_pass,id_role) values('Pedro123','pedro@gmail.com',SHA1('12345'),1);

INSERT INTO person(person_name,person_lastname,id_user) values('Pedro','Picapiedra',1);