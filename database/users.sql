create table users
(
	id int auto_increment
		primary key,
	firstname varchar(255) null,
	lastname varchar(255) null,
	username varchar(255) null,
	age varchar(255) null,
	email varchar(255) null,
	phone_number varchar(20) null,
	password varchar(255) null,
	password_confirmation varchar(255) null,
	role varchar(255) default 'ROLE_USER' null,
	created_at timestamp default CURRENT_TIMESTAMP null
);

