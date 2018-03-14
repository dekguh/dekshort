# dekshort
Dekshort - URL Short

Created by dekguh<br>
email: kadekteguhmahesa@gmail.com<br>
Name: Dekshort 1<br>
Template using bootstrap 3<br>

Edit Define login, Web and database on db/db.php, if you found some error you can contact me

query create table database:<br>
CREATE TABLE `short` (
 `id` varchar(10) COLLATE latin7_general_cs NOT NULL,<br>
 `tanggal` varchar(25) COLLATE latin7_general_cs NOT NULL,<br>
 `url` varchar(545) COLLATE latin7_general_cs NOT NULL,<br>
 `short` varchar(24) COLLATE latin7_general_cs NOT NULL,<br>
 PRIMARY KEY (`id`)<br>
) ENGINE=InnoDB DEFAULT CHARSET=latin7 COLLATE=latin7_general_cs<br>
