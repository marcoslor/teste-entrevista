create table if not exists  users
(
    email varchar(200) not null,
    password char(60) not null,
    id int auto_increment primary key,
    name varchar(150)  not null,
    constraint users_email_uindex unique (email),
    constraint users_id_uindex unique (id)
);

create table if not exists patients
(
    name varchar(150) not null,
    age int not null,
    phone varchar(15) null,
    registration varchar(15) not null,
    id int auto_increment,
    user_id int not null,
    primary key (id, user_id),
    constraint patients_id_registration_uindex unique (id, registration),
    constraint patients_registration_id_uindex unique (registration, id),
    constraint patients_user_id_registration_uindex unique (user_id, registration),
    constraint patients_users_id_fk foreign key (user_id) references users (id) on update cascade on delete cascade
);

