CREATE DATABASE IF NOT EXISTS sistema_auth CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sistema_auth;

CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255) NOT NULL UNIQUE,
  senha_hash VARCHAR(255) NOT NULL,
  perfil ENUM('admin','user') NOT NULL DEFAULT 'user',
  nome_completo VARCHAR(255) NULL,
  telefone VARCHAR(20) NULL,
  data_nascimento DATE NULL,
  google_id VARCHAR(255) NULL UNIQUE,
  provider VARCHAR(50) NULL,
  avatar_url VARCHAR(500) NULL,
  email_verificado BOOLEAN DEFAULT TRUE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

  INDEX idx_email(email),
  INDEX idx_google_id(google_id),
  INDEX idx_provider(provider)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS logs_login (
 id INT AUTO_INCREMENT PRIMARY KEY,
 usuario_id INT NULL,
 email VARCHAR(255) NOT NULL,
 ip_adress VARCHAR(45) NOT NULL,
 user_agent TEXT NULL,
 sucesso BOOLEAN NOT NULL,
 provider VARCHAR(50) DEFAULT 'local',
 tentativa_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP

 FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL,
 INDEX idx_usuario_id (usuario_id),
 INDEX idx_email (email),
 INDEX idx_ip_adress(ip_adress),
 INDEX idx_tentativa_em (tentativa_em)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- e-mail: admin@example.com
-- senha: Senha123!
INSERT INTO usuarios (email, senha_hash, perfil) VALUES (
  'admin@example.com',
  '$2y$10$HFYs3/01y0Z/KwpQLtmff.O3afzZkQtu.ZIG5oWPkkXxQBLp7VkAy',
  'admin'
);