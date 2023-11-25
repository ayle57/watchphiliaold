create table watch_section
(
	id int auto_increment
		primary key,
	watch_id int null,
	section_id int null,
	constraint watch_section_ibfk_1
		foreign key (watch_id) references watches (id),
	constraint watch_section_ibfk_2
		foreign key (section_id) references sections (id)
);

create index section_id
	on watch_section (section_id);

create index watch_id
	on watch_section (watch_id);

