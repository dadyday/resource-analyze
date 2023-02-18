
INSERT INTO `entity` (`id`, `handle`, `name`, `layer_id`, `income`, `costs`) VALUES
	(1 , 'peter'   , 'Peter Silie'  , 3, 0    , 0),
	(2 , 'demo'    , 'Demo'         , 1, 0    , 0),
	(3 , 'acme'    , 'Acme AG'      , 1, 0    , 0),
	(4 , 'anna'    , 'Anna Lyse'    , 3, 0    , 0),
	(5 , 'klara'   , 'Klara Himmel' , 3, 0    , 0),
	(6 , 'plumbus' , 'Plumbus'      , 2, 0    , 0),
	(7 , 'meeseeks', 'Meeseeks Box' , 2, 0    , 0),
	(9 , 'skynet'  , 'Skynet'       , 1, 0    , 0),
	(10, 'aperture', 'Aperture Labs', 1, 0    , 0),
	(11, 'income'  , 'Erlös'        , 5, 15000, 0),
	(12, 'costs'   , 'Kosten'       , 6, 0    , 15000);

INSERT INTO `layer` (`id`, `name`    , `order`) VALUES
	(1, 'Customer', 10),
	(2, 'Service' , 50),
	(3, 'Crew'    , 90),
	(5, 'Income'  , 1),
	(6, 'Costs'   , 100);

INSERT INTO `relation` (`id`, `from_id`, `to_id`, `value`, `unit`) VALUES
	(1 , 2 , 6 , 800 , 'count'   ),
	(2 , 2 , 7 , 200 , 'count'   ),
	(3 , 3 , 6 , 5000, 'count'   ),
	(4 , 6 , 5 , 20  , 'days'    ),
	(5 , 6 , 4 , 5   , 'days'    ),
	(6 , 7 , 4 , 15  , 'days'    ),
	(9 , 3 , 7 , 5000, 'count'   ),
	(10, 9 , 6 , 2000, 'count'   ),
	(11, 9 , 7 , 1000, 'count'   ),
	(13, 10, 6 , 3000, 'count'   ),
	(14, 6 , 1 , 2   , 'days'    ),
	(15, 11, 2 , 0   , 'currency'),
	(16, 11, 3 , 9000, 'currency'),
	(17, 11, 10, 1000, 'currency'),
	(18, 11, 9 , 5000, 'currency'),
	(20, 1 , 12, 5000, 'currency'),
	(21, 5 , 12, 5000, 'currency'),
	(22, 4 , 12, 5000, 'currency');