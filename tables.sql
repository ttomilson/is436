CREATE TABLE customers (
    cus_id int UNSIGNED NOT NULL AUTO_INCREMENT,
    fName varchar(20) NOT NULL,
    lName varchar(20) NOT NULL,
    phone_num varchar(12),
    email varchar(30),
    username varchar (30),
    PRIMARY KEY (cus_id),
    CONSTRAINT c_constraint FOREIGN KEY cus_fk (username)
    REFERENCES users(username)
);


CREATE TABLE event(
    event_id INT UNSIGNED NOT NULL AUTO_INCREMENT ,
    event_type VARCHAR( 30 ) ,
    start_date VARCHAR( 15 ) ,
    end_date VARCHAR( 15 ) ,
    res_total INT,
    cus_id INT UNSIGNED,
    FOREIGN KEY cus_fk( cus_id ) REFERENCES customers( cus_id ) ,
    PRIMARY KEY ( event_id )
)


create table services (
  service_id int unsigned not null AUTO_INCREMENT,
  service_desc varchar (50),
  service_total int,
  event_id int unsigned,
  CONSTRAINT e_constraint FOREIGN KEY event_fk (event_id)
  REFERENCES event(event_id),
  primary key (service_id)
);


create table invoices (
  invoice_id int unsigned not null auto_increment,
  event_id int UNSIGNED NOT NULL,
  FOREIGN KEY invevent (event_id) REFERENCES event(event_id),
  cus_id int unsigned NOT NULL,
  FOREIGN KEY invfk (cus_id) REFERENCES customers(cus_id),
  invoice_total int,
  primary key (invoice_id)
);


create table users (
  username varchar (30) not null,
  password varchar(15),
  primary key (username)
)

CREATE TABLE customerrequests(
request_id INT UNSIGNED NOT NULL AUTO_INCREMENT ,
event_description VARCHAR( 30 ) ,
start_date VARCHAR( 30 ) ,
end_date VARCHAR( 30 ) ,
cus_id INT UNSIGNED,
CONSTRAINT cusreq_constraint FOREIGN KEY cusreq_fk( cus_id ) REFERENCES customers( cus_id ) ,
PRIMARY KEY ( request_id )
)
