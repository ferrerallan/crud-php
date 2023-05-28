CREATE DATABASE minha_base;

CREATE TABLE `produto` (
  `nome` varchar(200) DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
)

-- SELECT
SELECT * FROM produtos;

-- INSERT
INSERT INTO produtos (nome, preco) VALUES ('Produto A', 10.99);

-- UPDATE
UPDATE produtos SET preco = 9.99 WHERE id = 1;

-- DELETE
DELETE FROM produtos WHERE id = 1;
