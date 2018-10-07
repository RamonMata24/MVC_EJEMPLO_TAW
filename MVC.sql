create database MVC;
USE MVC;



create table users(
id_user int(10) auto_increment NOT NULL,
username varchar(200) not null ,
email varchar(200) not null,
pass varchar(200) not null,
Primary key(id_user));

insert into users VALUES (1,'admin','admin@upv.edu.mx','admin');

insert into users VALUES (1,'admin','admin@upv.edu.mx','admin');
select *  from users;