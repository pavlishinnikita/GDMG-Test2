SELECT id, category_id, count(product_id) as 'products in category'
FROM ProductToCategory
WHERE category_id IN (1, 2)
GROUP BY category_id