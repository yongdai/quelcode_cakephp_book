create database mydata;
create table mydata.people(id int auto_increment primary key, name varchar(100) not null, mail varchar(200), age int not null);
create table mydata.messages(id int auto_increment primary key, person_id int not null, message varchar(255) not null, created_at datetime);
