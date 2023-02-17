SELECT @lastlayer := id FROM layer l ORDER BY l.order DESC LIMIT 1;


UPDATE entity e SET costs = NULL WHERE e.layer_id != @lastlayer;


CREATE TEMPORARY TABLE to_relation_layer SELECT 
    et.id AS to_entity_id, 
    ef.layer_id AS from_layer_id,
    COUNT(r.id) as count,
    SUM(r.value) as amount,
    r.unit
FROM `relation` r
LEFT JOIN `entity` ef ON ef.id = r.from_id
LEFT JOIN `entity` et ON et.id = r.to_id
GROUP BY to_entity_id, from_layer_id, unit
ORDER BY to_entity_id, from_layer_id, unit;


#SELECT * FROM
UPDATE 
    to_relation_layer rl
INNER JOIN entity ef ON ef.layer_id = rl.from_layer_id
INNER JOIN relation r ON r.to_id = rl.to_entity_id AND r.from_id = ef.id AND r.unit = rl.unit
SET r.costs_part = IF(rl.amount = 0, 1, r.value / rl.amount);


#SELECT * FROM
UPDATE
    entity e
INNER JOIN (
    SELECT 
        r.from_id AS id, 
        SUM(et.costs * r.costs_part) AS costs 
    FROM
        entity et
    LEFT JOIN relation r ON r.to_id = et.id
    WHERE
        et.costs IS NOT NULL
    GROUP BY id
) s ON s.id = e.id
SET e.costs = s.costs
