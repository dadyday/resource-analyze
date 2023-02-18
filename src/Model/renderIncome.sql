SELECT @firstlayer := id FROM layer l ORDER BY l.order ASC LIMIT 1;


UPDATE entity e SET income = NULL WHERE e.layer_id != @firstlayer;


CREATE TEMPORARY TABLE from_relation_layer SELECT 
    ef.id AS from_entity_id, 
    et.layer_id AS to_layer_id,
    COUNT(r.id) as count,
    SUM(r.value) as amount,
    r.unit
FROM `relation` r
LEFT JOIN `entity` ef ON ef.id = r.from_id
LEFT JOIN `entity` et ON et.id = r.to_id
GROUP BY from_entity_id, to_layer_id, unit
ORDER BY from_entity_id, to_layer_id, unit;


#SELECT * FROM
UPDATE 
    from_relation_layer rl
INNER JOIN entity et ON et.layer_id = rl.to_layer_id
INNER JOIN relation r ON r.from_id = rl.from_entity_id AND r.to_id = et.id AND r.unit = rl.unit
SET r.income_part = r.value / rl.amount;


#SELECT * FROM
UPDATE
    entity e
INNER JOIN (
    SELECT 
        r.to_id AS id, 
        SUM(ef.income * r.income_part) AS income 
    FROM
        entity ef
    LEFT JOIN relation r ON r.from_id = ef.id
    WHERE
        ef.income IS NOT NULL
    GROUP BY id
) s ON s.id = e.id
SET e.income = s.income
