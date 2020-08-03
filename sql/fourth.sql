	SELECT SUM(p_count) 'unique products' FROM (
		SELECT ptc.category_id, COUNT(product_id) p_count FROM ProductToCategory ptc
		WHERE ptc.category_id IN(1, 2, 3, 8) 
		AND ptc.product_id NOT IN (
			SELECT sub_ptc.product_id FROM ProductToCategory sub_ptc
			WHERE sub_ptc.category_id IN(1, 2, 3, 8) AND sub_ptc.category_id != ptc.category_id
		)
		GROUP BY category_id
	) t1