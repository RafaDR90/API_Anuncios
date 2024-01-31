DROP DATABASE IF EXISTS API_Anuncios;
CREATE DATABASE IF NOT EXISTS API_Anuncios;
USE API_Anuncios;



DROP TABLE IF EXISTS usuario;
CREATE TABLE IF NOT EXISTS `usuario` (
                                         `id` bigint(20)  NOT NULL AUTO_INCREMENT,
    `nombre` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
    `apellidos` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `rol` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
    `confirmado` boolean DEFAULT FALSE,
    `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `token_exp` timestamp NULL DEFAULT NULL,

    CONSTRAINT pk_usuarios PRIMARY KEY(id),
    CONSTRAINT uq_email UNIQUE(email)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS anuncio;
DROP TABLE IF EXISTS anuncio;
CREATE TABLE IF NOT EXISTS anuncio(
                                      id bigint(20) NOT NULL AUTO_INCREMENT,
    titulo varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    descripcion varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    precio float(10,2) NOT NULL,
    img_url varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    fecha timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    usuario_id bigint(20) NOT NULL,
    CONSTRAINT pk_anuncios PRIMARY KEY(id),
    CONSTRAINT fk_anuncios_usuarios FOREIGN KEY(usuario_id) REFERENCES usuario(id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

select * from usuario;
select * from anuncio;
delete from usuario;