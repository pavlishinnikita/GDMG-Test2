SELECT Category.name, product_id, category_id 
FROM ProductToCategory LEFT JOIN Category ON ProductToCategory.category_id = Category.id
WHERE product_id IN (1,3)