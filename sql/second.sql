SELECT product_id
FROM ProductToCategory
WHERE category_id IN (
	SELECT  id
	FROM    (SELECT * FROM Category
	         ORDER BY parent_id, id) categories_sorted,
	         (SELECT @cat := 2) initialization
	WHERE   (find_in_set(parent_id, @cat) AND @cat := concat(@cat, ',', id)) OR id = 2 OR id = parent_id
	)