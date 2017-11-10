insert into myepresc_prescription.clinical_impression(ID, TYPE,DESCRIPTION,chamber_id, doc_id) 
select ID,TYPE,DESCRIPTION,chamber_id, doc_id from myepresc_sroy.clinical_impression;


insert into myepresc_prescription.dose_details_master(DOSE_DETAILS_MASTER_ID, DOSE_DETAILS,chamber_id, doc_id) 
select DOSE_DETAILS_MASTER_ID, DOSE_DETAILS,chamber_id, doc_id from myepresc_sroy.dose_details_master;

insert into myepresc_prescription.dose_direction( 	DOSE_DIRECTION_ID, DIRECTION	,chamber_id, doc_id) 
select  	DOSE_DIRECTION_ID,DIRECTION	,chamber_id, doc_id from myepresc_sroy.dose_direction;


insert into myepresc_prescription.dose_timing_master(DOSE_TIMING_ID, TIMING	,chamber_id, doc_id) 
select DOSE_TIMING_ID, TIMING	,chamber_id, doc_id from myepresc_sroy.dose_timing_master;

insert into myepresc_prescription.investigation_master(ID, investigation_name,investigation_type,	unit,	STATUS	,chamber_id, doc_id) 
select ID, investigation_name,investigation_type,	unit,	STATUS	,chamber_id, doc_id from myepresc_sroy.investigation_master;

insert into myepresc_prescription.medicine_master(MEDICINE_ID, MEDICINE_NAME,	MEDICINE_DIRECTION,	MEDICINE_ENTRY_DATE_TIME,	MEDICINE_STATUS		,chamber_id, doc_id) 
select MEDICINE_ID, MEDICINE_NAME,	MEDICINE_DIRECTION,	MEDICINE_ENTRY_DATE_TIME,	MEDICINE_STATUS	,chamber_id, doc_id from myepresc_sroy.medicine_master;


insert into myepresc_prescription.patient(patient_id, GENDER,patient_first_name,patient_last_name,patient_name,patient_address,patient_city,patient_dob,age,patient_cell_num,patient_alt_cell_num,patient_email,data_entry_date	,chamber_id, doc_id) 
select patient_id, GENDER,patient_first_name,patient_last_name,patient_name,patient_address,patient_city,patient_dob,age,patient_cell_num,patient_alt_cell_num,patient_email,data_entry_date	,chamber_id, doc_id from myepresc_sroy.patient;

insert into myepresc_prescription.patient_health_details(ID, VALUE,	VISIT_ID,chamber_id, doc_id) 
select ID, VALUE,	VISIT_ID,chamber_id, doc_id from myepresc_sroy.patient_health_details;



insert into myepresc_prescription.patient_health_details_master(ID, 	NAME, 	STATUS, 	chamber_id, 	created_by_user_id, 	create_date,	doc_id) 
select ID, 	NAME, 	STATUS, 	chamber_id, 	created_by_user_id, 	create_date,	doc_id from myepresc_sroy.patient_health_details_master;


insert into myepresc_prescription.patient_investigation(patient_id,	visit_id,	investigation_id,	value,chamber_id, doc_id) 
select patient_id,	visit_id,	investigation_id,	value,chamber_id, doc_id from myepresc_sroy.patient_investigation;

insert into myepresc_prescription.precribed_medicine(MEDICINE_ID,PRESCRIPTION_ID,	MEDICINE_NAME,	MEDICINE_DIRECTION,	MEDICINE_DOSE,	MEDICINE_TIMING,chamber_id, doc_id) 
select MEDICINE_ID,PRESCRIPTION_ID,	MEDICINE_NAME,	MEDICINE_DIRECTION,	MEDICINE_DOSE,	MEDICINE_TIMING, chamber_id, doc_id from myepresc_sroy.precribed_medicine;

insert into myepresc_prescription.prescribed_cf(clinical_impression_id,	prescription_id,chamber_id, doc_id) 
select clinical_impression_id,	prescription_id,chamber_id, doc_id from myepresc_sroy.prescribed_cf;


insert into myepresc_prescription.prescribed_investigation(PRESCRIBED_INVESTIGATION_ID, PRESCRIPTION_ID,INVESTIGATION_TYPE,	INVESTIGATION_DESCRIPTION,	INVESTIGATION_ID,chamber_id, doc_id) 
select PRESCRIBED_INVESTIGATION_ID, PRESCRIPTION_ID,INVESTIGATION_TYPE,	INVESTIGATION_DESCRIPTION,	INVESTIGATION_ID, chamber_id, doc_id from myepresc_sroy.prescribed_investigation;


insert into myepresc_prescription.prescription(PRESCRIPTION_ID ,VISIT_ID,	REFERRED_TO,	DIET,	NEXT_VISIT,	ANY_OTHER_DETAILS,	STATUS,	NEXT_VISIT_DAY,chamber_id, doc_id) 
select PRESCRIPTION_ID,VISIT_ID,	REFERRED_TO,	DIET,	NEXT_VISIT,	ANY_OTHER_DETAILS,	STATUS,	NEXT_VISIT_DAY, chamber_id, doc_id from myepresc_sroy.prescription;

insert into myepresc_prescription.visit(VISIT_ID , PATIENT_ID,	VISIT_DATE,	APPOINTMENT_TO_DOC_NAME,	VISITED,chamber_id, doc_id) 
select VISIT_ID , PATIENT_ID,	VISIT_DATE,	APPOINTMENT_TO_DOC_NAME,	VISITED,chamber_id, doc_id from myepresc_sroy.visit;

insert into myepresc_prescription_1.user(user_name , user_full_name,	user_password,	role) 
select user_name , user_full_name,	user_password,	role from myepresc_prescription.user;

insert into myepresc_prescription_1.chamber_master(chamber_id,chamber_name,related_doc_name,related_rec_name,chamber_address,primary_phone_number,secondary_phone_number,chamber_header,chamber_footer) 
select chamber_id,chamber_name,related_doc_name,related_rec_name,chamber_address,primary_phone_number,secondary_phone_number,chamber_header,chamber_footer from myepresc_prescription.chamber_master

insert into myepresc_prescription_1.doctor_master(user_name,doctor_full_name,doctor_address,doctor_degree,doctor_affiliation,doctor_email,doctor_mobile,doctor_secondery_contact,doc_reg_num) 
select user_name,doctor_full_name,doctor_address,doctor_degree,doctor_affiliation,doctor_email,doctor_mobile,doctor_secondery_contact,doc_reg_num from myepresc_prescription.doctor_master

