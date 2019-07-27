
DELIMITER $$
CREATE PROCEDURE most_popular ()
BEGIN

$this->db->query('P.*, COUNT(0.id) as total' 
	
	from orders as O 
	
	inner join products 
	
	on O.id=P.id 
	
	group by O.id 
	
	order by desc );

END

