CREATE TABLE tb_enderecos (
  id_endereco int AUTO_INCREMENT,
  cep CHAR(9) NOT NULL,
  logradouro VARCHAR(255) NOT NULL,
  numero_endereco int NOT NULL,
  bairro VARCHAR(100) NOT NULL,
  cidade VARCHAR(100) NOT NULL,
  pais VARCHAR(45) NOT NULL,
  PRIMARY KEY (id_endereco)
);

CREATE TABLE tb_contatos (
  id_contato int AUTO_INCREMENT,
  telefone CHAR(10) NOT NULL,
  celular CHAR(11) NOT NULL,
  email VARCHAR(100),
  PRIMARY KEY (id_contato)
);

CREATE TABLE tb_usuarios ( 
  id_usuario int AUTO_INCREMENT, 
  id_endereco int,
  id_contato int,
  nome varchar(70) NOT NULL, 
  cpf char(11) NOT NULL,
  login varchar(15) NOT NULL,
  senha varchar(15) NOT NULL,
  papeis varchar(255),
  status_usuario varchar(70) NOT NULL,
  PRIMARY KEY (id_usuario),
  CONSTRAINT fk_id_endereco FOREIGN KEY (id_endereco) REFERENCES tb_endereco (id_endereco),
  CONSTRAINT fk_id_contato FOREIGN KEY (id_contato) REFERENCES tb_contato (id_contato)
);
ALTER TABLE usuarios ADD CONSTRAINT uk_usuarios UNIQUE KEY (login);

/*Inserts usuarios*/
INSERT INTO usuarios (nome_usuario, login, senha) VALUES ('Sr. Administrador', 'admin', 'admin');
INSERT INTO usuarios (nome_usuario, login, senha) VALUES ('Sr. Root', 'root', 'root');