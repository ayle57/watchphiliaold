create table posts
(
	id int auto_increment
		primary key,
	title varchar(255) not null,
	content text null,
	created_at timestamp default CURRENT_TIMESTAMP null
);

