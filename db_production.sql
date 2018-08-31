INSERT INTO users (name, email, password, avatar) VALUES
('Sebastian Mualim', 'bastian@example.com', '$2y$10$uem1h0upcxlsttLiI5PBYuVTpoKVP.Nf0H/E3MB4roplPuxzZtWYi', 'https://cdn.iconscout.com/icon/free/png-512/avatar-372-456324.png'),
('Isfhani', 'isfhani@example.com', '$2y$10$uem1h0upcxlsttLiI5PBYuVTpoKVP.Nf0H/E3MB4roplPuxzZtWYi', 'https://cdn.iconscout.com/icon/free/png-512/avatar-372-456324.png'),
('Hasbi', 'hasbi@example.com', '$2y$10$uem1h0upcxlsttLiI5PBYuVTpoKVP.Nf0H/E3MB4roplPuxzZtWYi', 'https://cdn.iconscout.com/icon/free/png-512/avatar-372-456324.png'),
('Rangga', 'rangga@example.com', '$2y$10$uem1h0upcxlsttLiI5PBYuVTpoKVP.Nf0H/E3MB4roplPuxzZtWYi', 'https://cdn.iconscout.com/icon/free/png-512/avatar-372-456324.png');

INSERT INTO user_detail (address, lat, lon, user_id) VALUES
('Jakarta, Indonesia', '-6.21462', '106.84513', 1),
('Jakarta, Indonesia', '-6.21462', '106.84513', 2),
('Semarang, Indonesia', '-6.966667', '110.416664', 3),
('Surabaya, Indonesia', '‎-7.250445', '112.768845', 4);

INSERT INTO product_category (name, parent_id) VALUES
('Barang Antik', NULL), ('Uang', NULL), ('Guci', 1), ('Mainan', NULL);

INSERT INTO products (imageurl, name, product_condition, min_price, next_bid, expired, product_category, user_id) VALUES
('https://www.riaume.com/wp-content/uploads/2015/08/4-cara-menghasilkan-uang-dari-internet.jpg', 'Uang 100 ribu seri sama', 1, 15000, 5000, '2018-09-02', 2, 1),
('http://cdn2.tstatic.net/manado/foto/bank/images/mata-uang_20171110_105845.jpg', 'Uang 10 ribu seri unik', 1, 10000, 3000, '2018-09-03', 2, 1),
('http://2.bp.blogspot.com/-pHUJ-YnORKc/Vgir9t2yR4I/AAAAAAABK0E/QncAu8Mf3TE/s1600/IMG_2415.JPG', 'Guci Spanyol tahun 1956', 1, 5000000, 200000, '2018-09-05', 2, 2),
('https://i.ytimg.com/vi/jv4dzjPl5mQ/hqdefault.jpg', 'Gundam Zero Limited Edition', 0, 200000, 10000, '2018-09-01', 4, 3),
('http://i1.wp.com/www.toyzhunt.com/files/imagecache/product_full/TOY-GDM-1218.jpg', 'Gundam Gamma Limited Edition', 0, 200000, 10000, '2018-09-02', 4, 3),
('https://media.karousell.com/media/photos/products/2017/11/25/guci_1511585876_d6a8a652.jpg', 'Guci Jawa Antik', 0, 250000, 20000, '2018-09-03', 2, 2),
('https://i.ebayimg.com/images/g/k4UAAOSwRhVbdX8I/s-l300.jpg', 'Troll Action Figure', 0, 100000, 5000, '2018-09-03', 4, 3),
('https://s.kaskus.id/r480x480/images/fjb/2016/02/20/_979658_1455936344.jpeg', 'Serpentine Hijau', 0, 50000, 10000, '2018-09-03', 2, 2),
('http://allenstanford.com/wp-content/uploads/2016/10/hp-nokia-61101.png', 'Nokia 61101 Jadul', 0, 120000, 5000, '2018-09-01', 1, 1);

INSERT INTO transaction_bid (user_id, product_id, price, created_at) VALUES
(3, 1, 20000, '2018-08-30 12:00:00'),
(4, 1, 25000, '2018-08-30 12:05:00'),
(3, 1, 30000, '2018-08-30 12:10:00'),
(3, 2, 13000, '2018-08-30 12:12:00'),
(4, 2, 20000, '2018-08-30 12:20:00');

INSERT INTO logistics (name, cost) VALUES
('JNE', 5000), ('J&T', 4500), ('Tiki', 4000), ('Pos Indonesia', 4300);