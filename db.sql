create table user (
    id int not null auto_increment,
    name varchar(255),
    email varchar(255),

    primary key (id),

    unique (email),
    unique (name)
);

create table theme (
    id int not null auto_increment,
    user_id int not null,
    name varchar(255),
    created_at int not null,

    primary key (id),

    unique (name)
);

create table submission (
    id int not null auto_increment,
    user_id int not null,
    theme_id int not null,
    url varchar(255) not null,
    created_at int not null,

    primary key (id),

    unique (user_id, theme_id),

    foreign key (user_id) references user (id),
    foreign key (theme_id) references theme (id)
);

create table guess (
    id int not null auto_increment,
    guesser_id int not null,
    submission_id int not null,
    guessed_id int not null,
    created_at int not null,

    primary key (id),

    unique (guesser_id, submission_id)

    foreign key (guesser_id) references user (id),
    foreign key (guessed_id) references user (id),
    foreign key (submission_id) references submission (id),

    check (guesser_id <> guessed_id)
);
