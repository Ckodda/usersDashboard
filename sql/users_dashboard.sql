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
    person_avatar varchar(100),
    id_user int
);

-- ALTER TABLE FOREING KEYS
-- Relacionando llaves foraneas
ALTER TABLE `person` ADD FOREIGN KEY(id_user) REFERENCES `user`(id);
ALTER TABLE `user` ADD FOREIGN KEY(id_role) REFERENCES `userRole`(id);
ALTER TABLE `person` ADD FOREIGN KEY(id_user) REFERENCES `user`(id);

-- INSERT
-- Al insertarse 'admin' primero obtiene rol id : 1
-- Al insertarse 'user' primero obtiene rol id : 2
INSERT INTO userRole(user_role) values('admin');
INSERT INTO userRole(user_role) values('user');

--Usuario admin :::::::: rol id : 1 -admin
INSERT INTO user(user_name,user_email,user_pass,id_role) values('Pedro123','pedro@gmail.com',SHA1('12345'),1);


-- Usuarios normales ::::::: rol id : 2 -user
INSERT INTO user(user_name,user_email,user_pass,id_role) values('martin123','martin@gmail.com',SHA1('12345'),2);
INSERT INTO user(user_name,user_email,user_pass,id_role) values('paola33','paola@gmail.com',SHA1('12345'),2);
INSERT INTO user(user_name,user_email,user_pass,id_role) values('lucho45','lucho@gmail.com',SHA1('12345'),2);

-- persona usuario administrador ::::::::: rol id : 1 -admin
INSERT INTO person(person_name,person_lastname,id_user) values('Pedro','Picapiedra',1);

-- personas usuarios normales ::::::: rol id : 2 -user
INSERT INTO person(person_name,person_lastname,id_user) values('Martin','Chavez Silvio',2);
INSERT INTO person(person_name,person_lastname,id_user) values('Paola','Gutierrez Lora',2);
INSERT INTO person(person_name,person_lastname,id_user) values('Lucho','Diaz',2);
