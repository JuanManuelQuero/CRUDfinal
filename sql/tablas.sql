drop table profesores if exists;
drop table departamentos if exists;
-- Tablas
create table departamentos(
    id int auto_increment primary key,
    nom_dep varchar(40) not null
);
create table profesores(
    id int auto_increment primary key,
    nom_prof varchar(40) not null,
    sueldo float not null,
    fecha_prof date,
    dep int,
    constraint fk_dep_prof foreign key(dep) references departamentos(id) on delete cascade on update cascade
);
-- Valores
insert into departamentos(nom_dep) values('LETRAS');
insert into departamentos(nom_dep) values('CIENCIAS');
-- ---------------
INSERT INTO profesores(nom_prof, sueldo, fecha_prof, dep) values('ANA FERNANDEZ', 1235.45 , '1990/02/03', 1);
INSERT INTO profesores(nom_prof, sueldo, fecha_prof, dep) values('LUIS PERES', 1567.23, '1987/02/05', 1);
INSERT INTO profesores(nom_prof, sueldo, fecha_prof, dep) values('ANDRES GIL', 1800, '1982/04/09', 2);
INSERT INTO profesores(nom_prof, sueldo, fecha_prof, dep) values('MARIA LOPEZ', 1913.5, '1971/10/12', 2);