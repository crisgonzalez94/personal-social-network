/*==============================================================
This file shows , how i create the database project
and any inserts basic for testing
into this folder is the diagram of database.
==============================================================*/

/*Creting database*/
CREATE DATABASE john_smith;

/*Select database*/
USE john_smith;

/*=====================================================================
Make tables
======================================================================*/

/*The site has a home page with a biography , here save dates the biography dates*/
CREATE TABLE home(
  id int(10) auto_increment not null,
  title varchar(255) not null,
  biography MEDIUMTEXT not null,
  photo varchar(255) not null,

  CONSTRAINT pk_home PRIMARY KEY(id)
)Engine=InnoDb;

/*The site has links for socialnetworks and contact info , here save it*/
CREATE TABLE site_information(
  id        int(10) auto_increment not null,
  facebook_link varchar(255) null default 'null',
  instagram_link varchar(255) null default 'null',
  twitter_link varchar(255) null default 'null',
  whatsapp_number varchar(255) null default 'null',

  email varchar(255) null default 'null',
  phone_number varchar(255) null default 'null',

   CONSTRAINT pk_site_information PRIMARY KEY (id)

)ENGINE=InnoDb;

/*The site has a galery , here save title and name of photos (the photos is save into serve)*/
CREATE TABLE photos_galery(
  id        int(10) auto_increment not null,
  title varchar(255) not null,
  picture varchar(255) not null,

  CONSTRAINT pk_photo_galery PRIMARY KEY (id)

)ENGINE=InnoDb;

/*This page has login of user and the users date save here ,
there two kinds of user , normaluser and adminuser ,
the normal user can coment ,
and the admin users can coment , write post and delete post ,
upload photos and delete photos , upload podcast and delete podcast
, select or deselect other
admins and delete users*/
CREATE TABLE users(
  id        int(10) auto_increment not null,
  username varchar(255) not null,
  email varchar(255) not null,
  password varchar(255) not null,
  picture varchar(255) null default 'default-avatar-user.gif',
  admin boolean not null,

  CONSTRAINT pk_id PRIMARY KEY (id)

)ENGINE=InnoDb;

/*The users can to write posts and save here*/
CREATE TABLE posts(
  id int(10) auto_increment not null,
  title varchar(255) not null,
  short_description varchar(255) not null,
  body MEDIUMTEXT not null,
  picture varchar(255) null default 'default-blog-picture.gif',
  date_post date not null,

  CONSTRAINT pk_posts PRIMARY KEY (id)
)Engine=InnoDb;

/*The post could has coments*/
CREATE TABLE post_coments(
  id int(10) auto_increment not null,
  id_post int(10) not null,
  id_user int(10) not null,
  body MEDIUMTEXT not null,
  date_post date not null,

  CONSTRAINT pk_post_coments PRIMARY KEY (id),
  CONSTRAINT fk_id_post FOREIGN KEY(id_post) REFERENCES posts(id),
  CONSTRAINT fk_id_user FOREIGN KEY(id_user) REFERENCES users(id)

)Engine=InnoDb;

/*The admin of this site has*/
CREATE TABLE events(
  id int(10) auto_increment not null,
  title varchar(255) not null,
  short_description varchar(255) not null,
  body MEDIUMTEXT not null,
  picture_one varchar(255) null default 'default-event-picture.gif',
  picture_two varchar(255) null default 'default-event-picture.gif',
  date_post date not null,

  CONSTRAINT pk_events PRIMARY KEY (id)
)Engine=InnoDb;

/*The events can has coments*/
CREATE TABLE event_coments(
  id int(10) auto_increment not null,
  id_event int(10) not null,
  id_user int(10) not null,
  body MEDIUMTEXT not null,
  date_post date not null,

  CONSTRAINT pk_event_coments PRIMARY KEY (id),
  CONSTRAINT fk_id_event FOREIGN KEY(id_event) REFERENCES events(id),
  CONSTRAINT fk_id_user_event_coment FOREIGN KEY(id_user) REFERENCES users(id)

)Engine=InnoDb;

/*This page has podcasts*/
CREATE TABLE podcasts(
  id int(10) auto_increment not null,
  title varchar(255) not null,
  short_description varchar(255) not null,
  picture varchar(255) null default 'default-podcast-picture.gif',
  audio varchar(255) not null ,
  date_post date not null,

  CONSTRAINT pk_events PRIMARY KEY (id)

)Engine=InnoDb;

/*The users can coments the podcast*/
CREATE TABLE podcast_coments(
  id int(10) auto_increment not null,
  id_podcast int(10) not null,
  id_user int(10) not null,
  body MEDIUMTEXT not null,
  date_post date not null,

  CONSTRAINT pk_podcast_coments PRIMARY KEY (id),
  CONSTRAINT fk_id_podcast FOREIGN KEY(id_podcast) REFERENCES podcasts(id),
  CONSTRAINT fk_id_user_podcast_coment FOREIGN KEY(id_user) REFERENCES users(id)

)Engine=InnoDb;
/*============================================================================
=============================================================================*/


/*============================================================================
Insert for dev and testing
=============================================================================*/
/*Default admin ,  late we changes*/
INSERT INTO users VALUES(
  null ,
  'admin' ,
  'admin@admin.com' ,
  '1234' ,
  null ,
  True
);

INSERT INTO users VALUES(
  null ,
  'Cristian' ,
  'cristian@gmail.com' ,
  '1234' ,
  'people-04.jpg' ,
  False
);

INSERT INTO users VALUES(
  null ,
  'Marixa' ,
  'marixa@yahoo.com' ,
  '1234' ,
  'people-02.jpg' ,
  False
);

INSERT INTO users VALUES(
  null ,
  'Roxy' ,
  'roxy@hotmail.com' ,
  '1234' ,
  'people-03.jpg' ,
  False
);

INSERT INTO users VALUES(
  null ,
  'Jenny' ,
  'jenny@outlock.com' ,
  '1234' ,
  'people-05.jpg' ,
  False
);

INSERT INTO users VALUES(
  null ,
  'Carl' ,
  'carl@outlock.com' ,
  '1234' ,
  'people-06.jpg' ,
  False
);




INSERT INTO site_information VALUES(null ,
  'https://www.facebook.com/' ,
  'https://www.instagram.com/' ,
  'https://twitter.com' ,
  '1170139816' ,
  'cristiannazarenogonzalez@gmail.com' ,
  '42680754'
);

INSERT INTO photos_galery VALUES(null , "Montaña" , '1.jpg');
INSERT INTO photos_galery VALUES(null , "Rio" , '2.jpg');
INSERT INTO photos_galery VALUES(null , "Llanura" , '3.jpg');
INSERT INTO photos_galery VALUES(null , "Playa" , '4.jpg');
INSERT INTO photos_galery VALUES(null , "Volcan" , '5.jpg');
INSERT INTO photos_galery VALUES(null , "Ciudad" , '6.jpg');
