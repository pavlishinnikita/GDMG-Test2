 SELECT 
     GROUP_CONCAT(anc.name ORDER BY anc.name SEPARATOR ' > ') AS path
 FROM Category AS t
   JOIN Category AS anc
     ON t.name LIKE CONCAT(anc.name, '%')
     WHERE t.id = 1
 GROUP BY
     t.id;