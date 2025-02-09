
CREATE DATABASE IF NOT EXISTS serenatto;
USE serenatto;


CREATE TABLE IF NOT EXISTS produtos (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(45) NOT NULL,
    nome VARCHAR(45) NOT NULL,
    descricao VARCHAR(90),
    imagem VARCHAR(80),
    preco DECIMAL(5,2) NOT NULL,
    data_vencimento DATE,
    status VARCHAR(20) NOT NULL,
    prioridade VARCHAR(10) NOT NULL
);


INSERT INTO produtos (tipo, nome, descricao, imagem, preco, data_vencimento, status, prioridade) VALUES
('Alimento', 'Leite', 'Leite integral 1L', 'leite.jpg', 4.50, '2025-06-01', 'Disponível', 'Alta'),
('Bebida', 'Coca-Cola', 'Refrigerante 2L', 'coca.jpg', 7.99, '2025-07-15', 'Disponível', 'Média'),
('Higiene', 'Shampoo', 'Shampoo anticaspa 400ml', 'shampoo.jpg', 15.90, '2026-01-10', 'Esgotado', 'Baixa'),
('Eletrônico', 'Fone de Ouvido', 'Fone Bluetooth', 'fone.jpg', 99.99, NULL, 'Disponível', 'Alta'),
('Alimento', 'Pão Integral', 'Pão integral caseiro', 'pao.jpg', 6.50, '2025-05-10', 'Disponível', 'Média'),
('Limpeza', 'Detergente', 'Detergente neutro 500ml', 'detergente.jpg', 3.20, '2026-02-20', 'Disponível', 'Baixa'),
('Higiene', 'Creme Dental', 'Creme dental 90g', 'creme.jpg', 5.80, '2026-03-15', 'Disponível', 'Média'),
('Eletrônico', 'Mouse', 'Mouse sem fio', 'mouse.jpg', 49.99, NULL, 'Disponível', 'Alta');

SELECT * FROM produtos;
