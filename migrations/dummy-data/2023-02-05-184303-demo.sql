-- Adminer 4.8.1 MySQL 10.4.11-MariaDB-log dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';
SET NAMES utf8mb4;

INSERT INTO `entity` ( `id`, `handle`, `name`, `layer_id`, `income`, `costs` )
VALUES
    ( 1, 'peter', 'Peter Silie', 3, 654, 5000 ),
	( 2, 'demo', 'Demo', 1, 0, 954 ),
	( 3, 'acme', 'Acme AG', 1, 9000, 8233 ),
	( 4, 'anna', 'Anna Lyse', 3, 7803, 5000 ),
	( 5, 'klara', 'Klara Himmel', 3, 6543, 5000 ),
	( 6, 'plumbus', 'Plumbus', 2, 8833, 11250 ),
	( 7, 'meeseeks', 'Meeseeks Box', 2, 6167, 3750 ),
	( 9, 'skynet', 'Skynet', 1, 5000, 2688 ),
	( 10, 'aperture', 'Aperture Labs', 1, 1000, 3125 ),
	( 11, 'income', 'Erlös', 5, 15000, 15000 ),
	( 12, 'costs', 'Kosten', 6, 15000, 15000 );

INSERT INTO `layer` ( `id`, `name`, `order` )
VALUES ( 1, 'Customer', 10 ),
	( 2, 'Service', 50 ),
	( 3, 'Crew', 90 ),
	( 5, 'Income', 1 ),
	( 6, 'Costs', 100 );

INSERT INTO `relation` ( `id`, `from_id`, `to_id`, `value`, `unit` )
VALUES ( 1, 2, 6, 800, 'count' ),
	( 2, 2, 7, 200, 'count' ),
	( 3, 3, 6, 5000, 'count' ),
	( 4, 6, 5, 20, 'days' ),
	( 5, 6, 4, 5, 'days' ),
	( 6, 7, 4, 15, 'days' ),
	( 9, 3, 7, 5000, 'count' ),
	( 10, 9, 6, 2000, 'count' ),
	( 11, 9, 7, 1000, 'count' ),
	( 13, 10, 6, 3000, 'count' ),
	( 14, 6, 1, 2, 'days' ),
	( 15, 11, 2, 0, 'currency' ),
	( 16, 11, 3, 9000, 'currency' ),
	( 17, 11, 10, 1000, 'currency' ),
	( 18, 11, 9, 5000, 'currency' ),
	( 20, 1, 12, 5000, 'currency' ),
	( 21, 5, 12, 5000, 'currency' ),
	( 22, 4, 12, 5000, 'currency' );

-- 2023-02-20 06:42:32