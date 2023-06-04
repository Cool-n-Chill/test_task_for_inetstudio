SELECT g.id, g.name
FROM goods g
WHERE g.id IN (SELECT gt.goods_id
                   FROM goods_tags gt
                   GROUP BY gt.goods_id
                   HAVING COUNT(gt.goods_id) = (SELECT COUNT(t.id) FROM tags t));


SELECT DISTINCT department_id
FROM evaluations
WHERE gender = true AND value > 5;