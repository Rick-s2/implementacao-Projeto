CREATE TABLE usuarios ( 
  id_usuario int AUTO_INCREMENT, 
  nome_usuario varchar(70) NOT NULL, 
  login varchar(15) NOT NULL,
  senha varchar(15) NOT NULL,
  papeis varchar(255),
  PRIMARY KEY (id_usuario) 
);
ALTER TABLE usuarios ADD CONSTRAINT uk_usuarios UNIQUE KEY (login);

/*Inserts usuarios*/
INSERT INTO usuarios (nome_usuario, login, senha) VALUES ('Sr. Administrador', 'admin', 'admin');
INSERT INTO usuarios (nome_usuario, login, senha) VALUES ('Sr. Root', 'root', 'root');