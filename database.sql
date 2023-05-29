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
CREATE TABLE tb_alcateias (
  id_alcateia int AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  PRIMARY KEY (id_alcateia)
);

CREATE TABLE tb_usuarios ( 
  id_usuario int AUTO_INCREMENT, 
  id_endereco int,
  id_contato int,
  id_alcateia int,
  nome varchar(70) NOT NULL, 
  cpf char(11) NOT NULL,
  login varchar(15) NOT NULL,
  senha varchar(15) NOT NULL,
  papeis varchar(255),
  status_usuario varchar(70) NOT NULL DEFAULT 'ATIVO',
  PRIMARY KEY (id_usuario),
  FOREIGN KEY (id_endereco) REFERENCES tb_enderecos (id_endereco),
  FOREIGN KEY (id_contato) REFERENCES tb_contatos (id_contato),
  FOREIGN KEY (id_alcateia) REFERENCES tb_alcateias (id_alcateia),
  CONSTRAINT uk_usuarios UNIQUE (login)
);

/*Inserts alcateias*/
INSERT INTO tb_alcateias (nome) VALUES ('Alcateia 1');
INSERT INTO tb_alcateias (nome) VALUES ('Alcateia 2');
INSERT INTO tb_alcateias (nome) VALUES ('Alcateia 3');

/*Inserts enderecos*/
INSERT INTO tb_enderecos (cep, logradouro, numero_endereco, bairro, cidade, pais) VALUES ('00000000', 'Rua 1', 1, 'Bairro 1', 'Cidade 1', 'Pais 1');
INSERT INTO tb_enderecos (cep, logradouro, numero_endereco, bairro, cidade, pais) VALUES ('11111111', 'Rua 2', 2, 'Bairro 2', 'Cidade 2', 'Pais 2');

/*Inserts contatos*/
INSERT INTO tb_contatos (telefone, celular, email) VALUES ('11111111', '11111111111', 'emailAdmin@gmail.com');
INSERT INTO tb_contatos (telefone, celular, email) VALUES ('22222222', '22222222222', 'emailRoot@gmail.com');

/*Inserts usuarios*/
INSERT INTO tb_usuarios (id_endereco, id_contato, id_alcateia, nome, cpf, login, senha, papeis, status_usuario) VALUES (1, 1, 1, 'Sr. Administrador', '11122233344', 'admin', 'admin', 'ADMINISTRADOR', 'ATIVO');
INSERT INTO tb_usuarios (id_endereco, id_contato, id_alcateia, nome, cpf, login, senha, papeis, status_usuario) VALUES (1, 1, 1, 'Sr. Root', '44433322211', 'root', 'root', 'USUARIO', 'ATIVO');

