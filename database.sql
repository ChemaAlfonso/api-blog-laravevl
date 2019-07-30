CREATE DATABASE IF NOT EXISTS api_laravel_blog

USE api_laravel_blog;

CREATE TABLE users IF NOT EXISTS(
id                  int (255) auto_increment not null,
name                varchar (50),
surname             varchar (100),
role                varchar (20),
email               varchar (255) not null,
password            varchar (255) not null,
description         text,
image               varchar (255),
created_at          datetime DEFAULT NULL,
updated_at          datetime DEFAULT NULL,
remember_token      varchar (255),
CONSTRAINT pk_users PRIMARY KEY (id)
)ENGINE=InnoDb;