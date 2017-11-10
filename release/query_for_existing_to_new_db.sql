create table myepresc_prescription_1.allergy_master as select * from myepresc_hindol.allergy_master;
create table myepresc_prescription_1.lmp as select * from myepresc_hindol.lmp;
create table myepresc_prescription_1.prescribed_allergy as select * from myepresc_hindol.prescribed_allergy;
create table myepresc_prescription_1.prescribed_social_history as select * from myepresc_hindol.prescribed_social_history;
create table myepresc_prescription_1.social_history_master as select * from myepresc_hindol.social_history_master;
create table myepresc_prescription_1.past_medical_history_master as select * from myepresc_hindol.past_medical_history_master;
create table myepresc_prescription_1.prescribed_past_med_history as select * from myepresc_hindol.prescribed_past_med_history;

ALTER TABLE `allergy_master` ADD `auto_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST ,
ADD `doc_id` VARCHAR( 50 ) NOT NULL AFTER `auto_id` ,
ADD `chamber_id` VARCHAR( 50 ) NOT NULL AFTER `doc_id` ,
ADD `created_by_user_id` VARCHAR( 50 ) NOT NULL AFTER `chamber_id` ,
ADD `create_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_by_user_id` ,
ADD `isSync` TINYINT NOT NULL DEFAULT '0' AFTER `create_date` ,
ADD INDEX ( `doc_id` , `chamber_id` ) ;


ALTER TABLE `lmp` ADD `auto_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST ,
ADD `doc_id` VARCHAR( 50 ) NOT NULL AFTER `auto_id` ,
ADD `chamber_id` VARCHAR( 50 ) NOT NULL AFTER `doc_id` ,
ADD `created_by_user_id` VARCHAR( 50 ) NOT NULL AFTER `chamber_id` ,
ADD `create_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_by_user_id` ,
ADD `isSync` TINYINT NOT NULL DEFAULT '0' AFTER `create_date` ,
ADD INDEX ( `doc_id` , `chamber_id` ) ;

ALTER TABLE `prescribed_allergy` ADD `auto_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST ,
ADD `doc_id` VARCHAR( 50 ) NOT NULL AFTER `auto_id` ,
ADD `chamber_id` VARCHAR( 50 ) NOT NULL AFTER `doc_id` ,
ADD `created_by_user_id` VARCHAR( 50 ) NOT NULL AFTER `chamber_id` ,
ADD `create_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_by_user_id` ,
ADD `isSync` TINYINT NOT NULL DEFAULT '0' AFTER `create_date` ,
ADD INDEX ( `doc_id` , `chamber_id` ) ;

ALTER TABLE `prescribed_social_history` ADD `auto_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST ,
ADD `doc_id` VARCHAR( 50 ) NOT NULL AFTER `auto_id` ,
ADD `chamber_id` VARCHAR( 50 ) NOT NULL AFTER `doc_id` ,
ADD `created_by_user_id` VARCHAR( 50 ) NOT NULL AFTER `chamber_id` ,
ADD `create_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_by_user_id` ,
ADD `isSync` TINYINT NOT NULL DEFAULT '0' AFTER `create_date` ,
ADD INDEX ( `doc_id` , `chamber_id` ) ;

ALTER TABLE `social_history_master` ADD `auto_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST ,
ADD `doc_id` VARCHAR( 50 ) NOT NULL AFTER `auto_id` ,
ADD `chamber_id` VARCHAR( 50 ) NOT NULL AFTER `doc_id` ,
ADD `created_by_user_id` VARCHAR( 50 ) NOT NULL AFTER `chamber_id` ,
ADD `create_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_by_user_id` ,
ADD `isSync` TINYINT NOT NULL DEFAULT '0' AFTER `create_date` ,
ADD INDEX ( `doc_id` , `chamber_id` ) ;


update allergy_master set doc_id='hindol', chamber_id='broadview';
update lmp set doc_id='hindol', chamber_id='broadview';
update prescribed_allergy set doc_id='hindol', chamber_id='broadview';
update prescribed_social_history set doc_id='hindol', chamber_id='broadview';
update social_history_master set doc_id='hindol', chamber_id='broadview';



ALTER TABLE `prescribed_past_med_history` ADD `auto_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST ,
ADD `doc_id` VARCHAR( 50 ) NOT NULL AFTER `auto_id` ,
ADD `chamber_id` VARCHAR( 50 ) NOT NULL AFTER `doc_id` ,
ADD `created_by_user_id` VARCHAR( 50 ) NOT NULL AFTER `chamber_id` ,
ADD `create_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_by_user_id` ,
ADD `isSync` TINYINT NOT NULL DEFAULT '0' AFTER `create_date` ,
ADD INDEX ( `doc_id` , `chamber_id` ) ;



ALTER TABLE `past_medical_history_master` ADD `auto_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST ,
ADD `doc_id` VARCHAR( 50 ) NOT NULL AFTER `auto_id` ,
ADD `chamber_id` VARCHAR( 50 ) NOT NULL AFTER `doc_id` ,
ADD `created_by_user_id` VARCHAR( 50 ) NOT NULL AFTER `chamber_id` ,
ADD `create_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_by_user_id` ,
ADD `isSync` TINYINT NOT NULL DEFAULT '0' AFTER `create_date` ,
ADD INDEX ( `doc_id` , `chamber_id` ) ;

update prescribed_past_med_history set doc_id='hindol', chamber_id='broadview';
update past_medical_history_master set doc_id='hindol', chamber_id='broadview';