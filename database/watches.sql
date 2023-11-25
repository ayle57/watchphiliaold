create table watches
(
	id int auto_increment
		primary key,
	name varchar(255) null,
	identification_number varchar(50) null,
	properties_id int null,
	section_id int null,
	subsection_id int null,
	description longtext null,
	image_url longtext null
);

