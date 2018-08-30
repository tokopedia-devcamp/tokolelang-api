INSERT INTO users (name, email, password, avatar) VALUES
('Sebastion Mualim', 'bastian@example.com', '$2y$10$uem1h0upcxlsttLiI5PBYuVTpoKVP.Nf0H/E3MB4roplPuxzZtWYi', 'https://cdn.iconscout.com/icon/free/png-512/avatar-372-456324.png'),
('Isfhani', 'isfhani@example.com', '$2y$10$uem1h0upcxlsttLiI5PBYuVTpoKVP.Nf0H/E3MB4roplPuxzZtWYi', 'https://cdn.iconscout.com/icon/free/png-512/avatar-372-456324.png'),
('Hasbi', 'hasbi@example.com', '$2y$10$uem1h0upcxlsttLiI5PBYuVTpoKVP.Nf0H/E3MB4roplPuxzZtWYi', 'https://cdn.iconscout.com/icon/free/png-512/avatar-372-456324.png');
('Agas', 'agas@example.com', '$2y$10$uem1h0upcxlsttLiI5PBYuVTpoKVP.Nf0H/E3MB4roplPuxzZtWYi', 'https://cdn.iconscout.com/icon/free/png-512/avatar-372-456324.png');

INSERT INTO user_detail (address, lat, lon, user_id) VALUES
('Jakarta, Indonesia', '-6.966667', '110.416664', 1),
('Jakarta, Indonesia', '-6.966667', '110.416664', 2),
('Jakarta, Indonesia', '-6.966667', '110.416664', 3);

INSERT INTO product_category (name, parent_id) VALUES
('Barang Antik', NULL), ('Uang', NULL), ('Guci', 1);

INSERT INTO products (imageurl, name, product_condition, min_price, next_bid, expired, product_category, user_id) VALUES
('http://cdn.onlinewebfonts.com/svg/img_231353.png', 'Uang 100 ribu seri sama', 1, 15000, 5000, '2018-09-2', 2, 1),
('http://cdn.onlinewebfonts.com/svg/img_231353.png', 'Uang 10 ribu seri unik', 1, 10000, 3000, '2018-09-3', 2, 1),
('http://cdn.onlinewebfonts.com/svg/img_231353.png', 'Guci Spanyol tahun 1956', 1, 5000000, 200000, '2018-09-3', 2, 2);

INSERT INTO transaction_bid (user_id, product_id, price, created_at) VALUES
(3, 1, 20000, '2018-08-30 12:00:00'),
(4, 1, 25000, '2018-08-30 12:05:00'),
(3, 1, 30000, '2018-08-30 12:10:00'),
(3, 2, 13000, '2018-08-30 12:12:00'),
(4, 2, 20000, '2018-08-30 12:20:00');