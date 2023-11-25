create table watch_subsection
(
	id int auto_increment
		primary key,
	watch_id int null,
	subsection_id int null,
	constraint watch_subsection_ibfk_1
		foreign key (watch_id) references watches (id),
	constraint watch_subsection_ibfk_2
		foreign key (subsection_id) references subsections (id)
);

create index subsection_id
	on watch_subsection (subsection_id);

create index watch_id
	on watch_subsection (watch_id);

