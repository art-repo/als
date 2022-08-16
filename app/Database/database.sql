-- for producing backups, and archives --
SELECT oi.oscya_id, om.user_id, oi.lastname, oi.firstname, oi.middlename, oi.extension, oi.birthdate, oi.age, oi.gender, oi.civil_status, oi.religion, 
oc.email, oc.contact, oc.facebook, oc.street, oc.brgy, og.fullname, og.email AS g_email, og.contact AS g_contact, og.facebook AS g_facebook, 
om.lrn, om.educ_attainment, om.reason, om.other_reason, om.disability, om.is_pwd, om.has_pwd_id, om.other_disability, om.disease, om.is_employed, 
om.is_fps_member, om.is_interested, om.mapping_date FROM oscya_info oi INNER JOIN  oscya_contact oc USING(oscya_id) INNER JOIN oscya_guardian og
USING(oscya_id) INNER JOIN oscya_mapping om USING(oscya_id) WHERE 1


