-- import to SQLite by running: sqlite3.exe db.sqlite3 -init sqlite.sql

PRAGMA journal_mode = MEMORY;
PRAGMA synchronous = OFF;
PRAGMA foreign_keys = OFF;
PRAGMA ignore_check_constraints = OFF;
PRAGMA auto_vacuum = NONE;
PRAGMA secure_delete = OFF;
BEGIN TRANSACTION;

create table if not exists  users
(
    email TEXT not null,
    password char(60) not null,
    id integer primary key autoincrement,
    name TEXT not null,
    constraint users_email_uindex unique (email),
    constraint users_id_uindex unique (id)
);

create table if not exists patients
(
    name TEXT not null,
    age int not null,
    phone TEXT null,
    registration TEXT not null,
    user_id int not null,
    id integer primary key autoincrement,
    constraint patients_id_registration_uindex unique (id, registration),
    constraint patients_user_id_uindex unique (user_id, id),
    constraint patients_user_id_registration_uindex unique (user_id, registration),
    constraint patients_users_id_fk foreign key (user_id) references users (id) on update cascade on delete cascade
);


COMMIT;
PRAGMA ignore_check_constraints = ON;
PRAGMA foreign_keys = ON;
PRAGMA journal_mode = WAL;
PRAGMA synchronous = NORMAL;
