create table watch_properties
(
	id int auto_increment
		primary key,
	watch_id int null,
	properties_id int null,
	constraint watch_properties_ibfk_1
		foreign key (watch_id) references watches (id),
	constraint fk_watch_properties_watch
		foreign key (watch_id) references watches (id)
			on delete cascade,
	constraint watch_properties_ibfk_2
		foreign key (properties_id) references properties (id)
);

create index properties_id
	on watch_properties (properties_id);

