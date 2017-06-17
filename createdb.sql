/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  davide
 * Created: 17-giu-2017
 */
create database if not exists registrations;

grant all on registrations.* to 'regapp'@'localhost' identified by 'caic89900e'; 

CREATE TABLE `conference` (
  `id` int(11) NOT NULL,
  `title` varchar(128) COLLATE utf8_bin NOT NULL,
  `code` varchar(128) COLLATE utf8_bin NOT NULL,
  `open` int(11) NOT NULL
);

ALTER TABLE `conference`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `conference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

create table regType (
    id int(11) NOT NULL,
    conference_id int,
    title varchar(128),
    cost float,
    has_workshop smallint,
    available smallint
);

ALTER TABLE `regType`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `regType`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE regType ADD FOREIGN KEY conference_fk (conference_id)
REFERENCES conference (id) ON UPDATE CASCADE;

create table workshop(
    id int(11) NOT NULL,
    conference_id int,
    title varchar(256)
);

ALTER TABLE `workshop`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `workshop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE workshop ADD FOREIGN KEY workshop_conference_fk (conference_id)
REFERENCES conference (id) ON UPDATE CASCADE;

create table extra(
    id int(11) NOT NULL,
    conference_id int,
    title varchar(256),
    cost float
);

ALTER TABLE `extra`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `extra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE extra ADD FOREIGN KEY extra_conference_fk (conference_id)
REFERENCES conference (id) ON UPDATE CASCADE;


create table participant(
    id int(11) NOT NULL,
    regtype_id int, 
    email varchar(128),
    prefix varchar(128),
    firstname varchar(128),
    middlename varchar(128),
    lastname varchar(128),
    jobtitle varchar(128),
    badge varchar(128),
    company varchar(128),
    country varchar(128),
    addressline1 varchar(128),
    addressline2 varchar(128),
    city varchar(128),
    zip varchar(128),
    taxid varchar(128),
    acm varchar(128),
    meatfree smallint,
    fishfree smallint,
    shellfishfree smallint,
    eggfree smallint, 
    milkfree smallint, 
    animalfree smallint, 
    glutenfree smallint,
    peanutfree smallint,
    wheatfree smallint, 
    soyfree smallint,
    additionaldiet varchar(512),
    state int
);

ALTER TABLE `participant`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `participant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE participant ADD FOREIGN KEY participant_regtype_fk (regtype_id)
REFERENCES regtype (id) ON UPDATE CASCADE;


insert into conferences (id, title, code, open) values
(default, 'CHItaly 2017', 'chitaly2017', 1);

INSERT INTO `regType`(`id`, `conference_id`, `title`, `cost`, `has_workshop`, `available`) VALUES 
(default, 1, 'Main conference (early), ACM Member, with workshops', 340.0, 1, 1),
(default, 1, 'Main conference (early), Non-ACM Member, with workshops', 400.0, 1, 1),
(default, 1, 'Main conference (early), student, with workshops', 270.0, 1, 1),
(default, 1, 'Main conference (early), ACM Member, no workshops', 300.0, 1, 1),
(default, 1, 'Main conference (early), Non-ACM Member, no workshops', 360.0, 1, 1),
(default, 1, 'Main conference (early), student, no workshops', 230.0, 1, 1),
(default, 1, 'Workshop only (early)', 110.0, 1, 1);

INSERT INTO `regType`(`id`, `conference_id`, `title`, `cost`, `has_workshop`, `available`) VALUES 
(default, 1, 'Main conference, ACM Member, with workshops', 410.0, 1, 0),
(default, 1, 'Main conference, Non-ACM Member, with workshops', 470.0, 1, 0),
(default, 1, 'Main conference, student, with workshops', 310.0, 1, 0),
(default, 1, 'Main conference, ACM Member, no workshops', 360.0, 1, 0),
(default, 1, 'Main conference, Non-ACM Member, no workshops', 420.0, 1, 0),
(default, 1, 'Main conference, student, no workshops', 260.0, 1, 0),
(default, 1, 'Workshop only', 120.0, 1, 0);
