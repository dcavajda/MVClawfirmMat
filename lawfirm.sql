
/*
c:\xampp\mysql\bin\mysql -uedunova -pedunova --default_character_set=utf8 < "C:\LawFirm\LawFirm.sql"
*/

drop database if exists LawFirm;
create database LawFirm default character set utf8;
use LawFirm;

 create table operater(
operater_id int not null primary key auto_increment,
firstname varchar (50),
lastname varchar (50),
email varchar (50),
password varchar (60)
);
INSERT INTO operater
(firstname, lastname, email, password)
VALUES
('Damir', 'Čavajda', 'dcavajda@edunova.hr', '$2y$12$Lt6Q93g3wRpalZ3TSD8Pi.IrcywISe7ctwSFCYMptjN8pRuIoFM72');
 
 
create table legal_case(
legal_case_id int not null primary key auto_increment,
lawyer_id int NOT NULL,
client_id int NOT NULL,
case_date_start date,
case_date_end date
);
create table lawyer(
lawyer_id int not null primary key auto_increment,
firstname varchar (50),
lastname varchar(50),
OIB char (11),
IBAN varchar (32)
);
create table client (
client_id int not null primary key auto_increment,
firstname varchar (50),                                                                                                                                              
lastname varchar (50),
IBAN varchar (32),
OIB char (11)
);
create table legal_trainee (
legal_trainee_id int not null primary key auto_increment,
firstname varchar (50),
lastname varchar (50),
IBAN varchar (32),
OIB char (11)
);
CREATE TABLE legal_case_trainee (
legal_case_id int not null,
legal_trainee_id int not null
);

ALTER TABLE legal_case ADD FOREIGN KEY (lawyer_id) REFERENCES lawyer (lawyer_id);
ALTER TABLE legal_case ADD FOREIGN KEY (client_id) REFERENCES client (client_id);

ALTER TABLE legal_case_trainee ADD FOREIGN KEY (legal_case_id) REFERENCES legal_case (legal_case_id);
ALTER TABLE legal_case_trainee ADD FOREIGN KEY (legal_trainee_id) REFERENCES legal_trainee (legal_trainee_id);

INSERT INTO client
(firstname, lastname, `IBAN`, `OIB`)
VALUES
('Ivan', 'Horvat', 'HR1234567891234567890', '04150008463'),
('Ivana', 'Babić', 'HR1234567891234512345', '00765012345');

INSERT INTO lawyer
(firstname, lastname, `OIB`, `IBAN`)
VALUES
('Čedo', 'Prodanović', '12345698765', 'HR1236547896541235478'),
('Jadranka', 'Sloković', '12345698725', 'HR0216547896541235410');

INSERT INTO legal_trainee
(firstname, lastname, `IBAN`, `OIB`)
VALUES
('Đuro', 'Prtenjača', 'HR3216549874563214568', '98752364178'),
('Žaneta', 'Zgombić', 'HR3216549874563215462', '00752364100');

INSERT INTO legal_case
(lawyer_id, client_id, case_date_start, case_date_end)
VALUES
(1,1, '1999.05.22', '2000.05.22');



