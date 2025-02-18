DROP DATABASE IF EXISTS `examen`;
CREATE DATABASE examen;
USE examen;

CREATE TABLE IF NOT EXISTS USERS(
    username        VARCHAR(255) not null,
    password        VARCHAR(255) not null,
    first_name      VARCHAR(255),
    email           VARCHAR(255),
    direcction      VARCHAR(30),
    postal          VARCHAR(5),
    CONSTRAINT username_pk PRIMARY KEY (username)
);

CREATE TABLE IF NOT EXISTS CATEGORY(
    category_id  INT not null,
    nombre       VARCHAR(255) not null,
    descripcion  VARCHAR(255) not null,
    CONSTRAINT category_pk PRIMARY KEY (category_id)
);

CREATE TABLE IF NOT EXISTS PRODUCT(
    product_id INT auto_increment,
    product_name VARCHAR(255) not null,
    category_id INT not null,
    stock INT not null,
    CONSTRAINT product_pk PRIMARY KEY (product_id),
    FOREIGN KEY (category_id) REFERENCES CATEGORY(category_id)
);

CREATE TABLE IF NOT EXISTS LINEA_COMANDA(
    comanda_id VARCHAR(255),
    nombre VARCHAR(255) not null,
    product_id INT not null,
    quantity INT not null,
    price DECIMAL not null,
    CONSTRAINT linea_comanda PRIMARY KEY (comanda_id, product_id)
);

CREATE TABLE IF NOT EXISTS COMANDA(
    comanda_id VARCHAR(255),
    username VARCHAR(255) not null,
    quantity INT not null,
    date_buy DATETIME not null,
    total_price DECIMAL not null, 
    CONSTRAINT comanda_pk PRIMARY KEY (comanda_id)
);

CREATE TABLE IF NOT EXISTS MENSAJES(
    id_info INT auto_increment,
    mensaje VARCHAR(255) not null,
    CONSTRAINT mensajes_pk PRIMARY KEY (id_info)
);

INSERT INTO MENSAJES (mensaje) VALUES ('Bienvenido a la tienda');
INSERT INTO MENSAJES (mensaje) VALUES ('Pagina de registro');
INSERT INTO MENSAJES (mensaje) VALUES ('Has hecho click en el boton');

INSERT INTO CATEGORY VALUES(1, 'Categoria1', 'Descripcion1');
INSERT INTO CATEGORY VALUES(2, 'Categoria2', 'Descripcion2');
INSERT INTO CATEGORY VALUES(3, 'Categoria3', 'Descripcion3');
INSERT INTO CATEGORY VALUES(4, 'Categoria4', "<script>alert('Descripcion4');</script>");

INSERT INTO PRODUCT(product_name, category_id, stock) VALUES('Producto 1', 1, 5);
INSERT INTO PRODUCT(product_name, category_id, stock) VALUES('Producto 2', 1, 5);
INSERT INTO PRODUCT(product_name, category_id, stock) VALUES('Producto 3', 1, 10);
INSERT INTO PRODUCT(product_name, category_id, stock) VALUES('Producto 6', 1, 10);

INSERT INTO PRODUCT(product_name, category_id, stock) VALUES('Producto 4', 3, 10);
INSERT INTO PRODUCT(product_name, category_id, stock) VALUES('Producto 5', 2, 10);
INSERT INTO PRODUCT(product_name, category_id, stock) VALUES('Producto 7', 4, 20);
INSERT INTO PRODUCT(product_name, category_id, stock) VALUES('Producto 8', 4, 20);