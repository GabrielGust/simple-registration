create database simpleregister;

use simpleregister;

create table clientes (
	id_client int not null AUTO_INCREMENT primary key,
	client_name varchar(40) not null,
    email varchar(33) unique not null ,
    password varchar(61) not null,
    tell varchar(13),
    age int
)engine=innodb;