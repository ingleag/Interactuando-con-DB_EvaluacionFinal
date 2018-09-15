-- CREAR LA BASE DE DATOS
CREATE DATABASE agenda;
USE agenda;

-- CREAR TABLA DE USUARIOS
CREATE TABLE usuarios
(	id			INTEGER			NOT NULL AUTO_INCREMENT,
	email		VARCHAR(200)	NOT NULL,
	nombre		VARCHAR(250)	NOT NULL,
	fecha_nace	DATE			NOT NULL,
	contrasena	VARCHAR(1000)	NOT NULL,
	CONSTRAINT pk_usuarios PRIMARY KEY (id)
);
CREATE UNIQUE INDEX idx_usuarios ON usuarios(email);

-- CREAR TABLA DE EVENTOS
CREATE TABLE eventos
(	id			INTEGER			NOT NULL AUTO_INCREMENT,
	id_usuario	INTEGER			NOT NULL,
	titulo		VARCHAR(200)	NOT NULL,
	fecha_ini	DATETIME		NOT NULL,
	fecha_fin	DATETIME		NULL,
	todo_dia	BOOLEAN			NOT NULL,
	CONSTRAINT pk_eventos PRIMARY KEY(id)
);

ALTER TABLE eventos ADD CONSTRAINT fk_eventos_id_usuarios FOREIGN KEY (id_usuario) REFERENCES usuarios(id);

CREATE USER 'agenda_user'@'localhost' IDENTIFIED BY '12345';
GRANT SELECT, INSERT, UPDATE, DELETE ON agenda.* TO 'agenda_user'@'localhost';
