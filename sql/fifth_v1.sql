SELECT  id, name
	FROM    (SELECT * FROM Category
	         ORDER BY parent_id, id) categories_sorted,
	         (SELECT @cat := 1) initialization
	WHERE   (find_in_set(parent_id, @cat) AND @cat := concat(@cat, ',', id)) OR id = 1 OR id = parent_id
