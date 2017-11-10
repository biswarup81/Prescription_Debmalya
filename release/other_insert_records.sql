truncate myepresc_prescription1.user;
insert into myepresc_prescription1.user(user_name,user_full_name,user_password,role) 
select user_name,user_full_name,user_password,role from myepresc_prescription.user;

truncate myepresc_prescription1.chamber_master;

insert into myepresc_prescription1.chamber_master(chamber_id,chamber_name,related_doc_name,related_rec_name,chamber_address,primary_phone_number,secondary_phone_number,chamber_header,chamber_footer) 
select chamber_id,chamber_name,related_doc_name,related_rec_name,chamber_address,primary_phone_number,secondary_phone_number,chamber_header,chamber_footer from myepresc_prescription.chamber_master;

truncate myepresc_prescription1.doctor_master;
insert into myepresc_prescription1.doctor_master(salutation,user_name,doctor_full_name,doctor_address,doctor_degree,doctor_affiliation,doctor_email,doctor_mobile,doctor_secondery_contact,doc_reg_num) 
select salutation,user_name,doctor_full_name,doctor_address,doctor_degree,doctor_affiliation,doctor_email,doctor_mobile,doctor_secondery_contact,doc_reg_num from myepresc_prescription.doctor_master;

truncate myepresc_prescription1.user_master;
insert into myepresc_prescription1.user_master(GENDER,user_first_name,user_last_name,user_address,user_city,user_dob,age,user_cell_num,user_alt_cell_num,user_email) 
select GENDER,user_first_name,user_last_name,user_address,user_city,user_dob,age,user_cell_num,user_alt_cell_num,user_email from myepresc_prescription.user_master;

truncate myepresc_prescription1.chamber_owner;
insert into myepresc_prescription1.chamber_owner(chamber_id, owner_id) 
select chamber_id, owner_id from myepresc_prescription.chamber_owner;