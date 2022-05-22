create table user (
    id int not null auto_increment,
    email varchar(255),

    primary key (id),
    unique (email)
);

create table theme (
    id int not null auto_increment,
    name varchar(255),
    created_at int not null,

    primary key (id),
    unique (name)
);

create table submission (
    user_id int not null,
    theme_id int not null,
    url varchar(255) not null,
    created_at int not null,

    primary key (user_id, theme_id)
);

create table guess (
    guesser_id int not null,
    submission_id int not null,
    guessed_id int not null,
    created_at int not null,

    primary key(guesser_id, submission_id)
);
