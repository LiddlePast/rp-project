# Проект
## SQL
```sql
drop database if exists project;
create database if not exists project;
use project;
create table `users` (
	user_id int unsigned auto_increment,
    email varchar(255) not null unique,
    login varchar(255) not null unique,
    `password` text not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    primary key (user_id)
);
create table courses (
	course_id int unsigned auto_increment,
    name varchar(255) not null,
    description text not null,
    price decimal(10,2) not null,
    dates datetime null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    primary key (course_id)
);
create table reviews (
	review_id int unsigned auto_increment,
    course_id int unsigned,
    user_id int unsigned,
    content text not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    primary key (review_id),
    foreign key (course_id) references courses (course_id) on delete cascade on update cascade,
    foreign key (user_id) references users (user_id) on delete cascade on update cascade
);

create table bids (
	bid_id int unsigned auto_increment,
    user_id int unsigned,
    course_id int unsigned,
    `status` enum('new', 'in_process', 'done') default 'new',
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    primary key (bid_id),
    foreign key (user_id) references users (user_id) on delete cascade on update cascade,
    foreign key (course_id) references courses (course_id) on delete cascade on update cascade
);
```