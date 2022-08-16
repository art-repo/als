<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->add('GeneratePDF/htmlToPDF', 'GeneratePDF::htmlToPDF');
$routes->add('GeneratePDF/generate_word', 'GeneratePDF::generate_word');

$routes->group('administrator', function($routes){
    $routes->add('login', 'Administrator::login');
    $routes->add('dashboard', 'Administrator::dashboard');
});
$routes->group('teacher', function($routes){
    $routes->add('account', 'Teacher::account');
    $routes->post('edit_credentials', 'Teacher::edit_credentials');
    $routes->post('edit_contact_details', 'Teacher::edit_contact_details');
    $routes->post('edit_info_details', 'Teacher::edit_info_details');
    $routes->post('edit_picture', 'Teacher::edit_picture');
    $routes->post('update_password', 'Teacher::update_password');
    $routes->post('osy_admission', 'Teacher::osy_admission');
    $routes->add('osy_counselling', 'Teacher::osy_counselling');
    $routes->add('generate_task/(:any)', 'Teacher::generate_task/$1');
    $routes->add('filter_by', 'Teacher::filter_by');
    $routes->add('generate_osy_mapping/(:any)', 'Teacher::generate_osy_mapping/$1');
    $routes->add('generate_ae_pdf/(:any)', 'Teacher::generate_ae_pdf/$1');
    $routes->add('download_ae_pdf/(:any)', 'Teacher::download_ae_pdf/$1');
    $routes->add('generate_oscya_detail/(:any)', 'Teacher::generate_oscya_detail/$1');
    $routes->add('view_oscya_details/(:any)', 'Teacher::view_oscya_details/$1');
    $routes->add('view_oscya_record/(:any)', 'Teacher::view_oscya_record/$1');
    $routes->add('staff_records/(:any)', 'Teacher::staff_records/$1');
    $routes->add('task', 'Teacher::task');
    $routes->add('records', 'Teacher::records');
    $routes->add('login', 'Teacher::login');
    $routes->add('logout', 'Teacher::logout');
    $routes->add('forgot_password', 'Teacher::forgot_password');
    $routes->add('reset_password/(:any)', 'Teacher::reset_password/$1');
    $routes->add('home', 'Teacher::dashboard');
    $routes->add('barangay/(:any)', 'Teacher::barangay/$1');
    $routes->add('activate/(:any)', 'Teacher::activate/$1');
    $routes->add('activation', 'Teacher::activation');
    $routes->add('save_personal_detail', 'Teacher::save_personal_detail');
    $routes->add('save_contact_detail', 'Teacher::save_contact_detail');
    $routes->add('save_guardian_detail','Teacher::save_guardian_detail');
    $routes->add('save_mapping_details', 'Teacher::save_mapping_details');
});
$routes->group('alscoordinator', function($routes){
    $routes->add('reports/(:any)', 'Alscoordinator::reports/$1');
    $routes->add('generate_pdf_report/(:any)', 'Alscoordinator::generate_pdf_report/$1');
    $routes->post('generate_report/(:any)', 'Alscoordinator::generate_report/$1');
    $routes->post('migrate_data/(:any)', 'Alscoordinator::migrate_data/$1');
    $routes->post('edit_email/(:any)', 'Alscoordinator::edit_email/$1');
    $routes->post('edit_coord_acc/(:any)', 'Alscoordinator::edit_coord_acc/$1');
    $routes->post('edit_barangay_info/(:any)', 'Alscoordinator::edit_barangay_info/$1');
    $routes->post('edit_cover_photo/(:any)', 'Alscoordinator::edit_cover_photo/$1');
    $routes->post('edit_logo/(:any)', 'Alscoordinator::edit_logo/$1');
    $routes->add('barangay_settings/(:any)', 'Alscoordinator::barangay_settings/$1');
    $routes->add('email_temp/(:any)','Alscoordinator::email_temp/$1');
    $routes->add('teacher', 'Alscoordinator::teacher');
    $routes->add('view_tasks/(:any)', 'Alscoordinator::view_tasks/$1');
    $routes->add('olcm', 'Alscoordinator::olcm');
    $routes->add('district_settings', 'Alscoordinator::district_settings');
    $routes->post('edit_info', 'Alscoordinator::edit_info');
    $routes->post('edit_contact', 'Alscoordinator::edit_contact');
    $routes->post('edit_password', 'Alscoordinator::edit_password');
    $routes->post('edit_picture', 'Alscoordinator::edit_picture');
    $routes->add('my_account', 'Alscoordinator::my_account');
    $routes->add('coordinator_account/(:any)', 'Alscoordinator::coordinator_account/$1');
    $routes->add('coordinator', 'Alscoordinator::coordinator');
    $routes->post('assign_task/(:any)', 'Alscoordinator::assign_task/$1');
    // $routes->add('teacher_tasks', 'Alscoordinator::teacher_tasks');
    $routes->add('task', 'Alscoordinator::task');
    $routes->add('teacher', 'Alscoordinator::teacher');
    $routes->add('add_teacher', 'Alscoordinator::add_teacher');
    $routes->add('teacher_registration','Alscoordinator::view_teacher_registration');
    $routes->add('teacher_registration_info/(:any)', 'Alscoordinator::view_teacher_registration_detail/$1');
    $routes->add('teacher_evaluated', 'Alscoordinator::teacher_evaluated');
    $routes->add('task/(:any)', 'Alscoordinator::task/$1');
    $routes->add('report/(:any)', 'Alscoordinator::report/$1');
    $routes->add('record/(:any)', 'Alscoordinator::record/$1');
    $routes->post('save_brgy_coord', 'Alscoordinator::save_brgy_coord');
    $routes->get('add_brgy_coord', 'Alscoordinator::add_brgy_coord');
    $routes->get('view_staff_report/(:any)', 'Alscoordinator::view_staff_report/$1');
    $routes->get('view_staff_records/(:any)', 'Alscoordinator::view_staff_records/$1');
    $routes->get('view_barangay/(:any)', 'Alscoordinator::view_barangay/$1');
    $routes->post('save_registration', 'Alscoordinator::save_registration');
    $routes->get('view_registration/(:any)', 'Alscoordinator::view_registration/$1');
    $routes->add('registration', 'Alscoordinator::registration');
    $routes->add('barangay', 'Alscoordinator::barangay');
    $routes->add('dashboard', 'Alscoordinator::dashboard');
    $routes->add('reset', 'Alscoordinator::reset');
    $routes->add('reset_password/(:any)', 'Alscoordinator::reset_password/$1');
    $routes->add('forgot_password', 'Alscoordinator::forgot_password');
    $routes->add('logout', 'Alscoordinator::logout');
    $routes->add('login', 'Alscoordinator::index');
    $routes->post('validation', 'Alscoordinator::validation');
    
});
$routes->group('oscya', function($routes){
    
    $routes->get('before_proceeding', 'Oscya::index');
    $routes->get('mapping_form', 'Oscya::oscya_form');
    $routes->post('save', 'Oscya::submit');
});
$routes->group('staff', function($routes){
    $routes->add('search_oscya/(:any)', 'Staff::search_oscya/$1');
    $routes->add('login', 'Staff::index'); //created
    $routes->add('logout', 'Staff::logout');//created
    $routes->add('submit', 'Staff::auth');//created
    $routes->add('forgot_password', 'Staff::forgot_password');
    $routes->add('reset_password/(:any)', 'Staff::reset_password/$1');
    $routes->add('activation', 'Staff::activation');
    $routes->add('activate/(:any)', 'Staff::activate/$1');
    $routes->get('home', 'Staff::dashboard');//created
    $routes->add('add_oscya', 'Staff::add_oscya');
    $routes->add('data_privacy', 'Staff::data_privacy');
    $routes->post('save_oscya', 'Staff::submit');
    $routes->get('view_oscya', 'Staff::view_oscya');
    $routes->get('oscya_detail/(:any)', 'Staff::oscya_detail/$1');
    $routes->post('save_personal_detail', 'Staff::save_personal_detail');
    $routes->post('save_contact_detail', 'Staff::save_contact_detail');
    $routes->post('save_guardian_detail', 'Staff::save_guardian_detail');
    $routes->post('save_mapping_details', 'Staff::save_mapping_details');
    $routes->get('account', 'Staff::credentials'); 
    $routes->post('edit_credentials', 'Staff::edit_credentials');
    $routes->post('edit_contact_details', 'Staff::edit_contact_details');
    $routes->post('edit_info_details', 'Staff::edit_info_details');
    $routes->post('edit_picture', 'Staff::edit_picture');
    $routes->add('generate_osy_mapping_form/(:any)', 'Staff::generate_osy_mapping_form/$1');
    $routes->add('download_osy_mapping_form/(:any)', 'Staff::download_osy_mapping_form/$1');
    $routes->add('generate_osy_detail/(:any)', 'Staff::generate_osy_detail/$1');
    
});
$routes->group('registration', function($routes){
    $routes->add('email_temp/(:any)', 'Registration::email_temp/$1');
    $routes->add('brgy_staff', 'Registration::register_brgy_staff');
    $routes->add('update_id/(:any)', 'Registration::update_id/$1');
    $routes->add('update_coordinator_id/(:any)', 'Registration::update_coordinator_id/$1');
    $routes->add('update_teacher_id/(:any)', 'Registration::update_teacher_id/$1');
    $routes->add('brgy_coordinator', 'Registration::register_brgy_coord');
    $routes->post('save_als_coord', 'Registration::save_als_coord');
    $routes->get('als_coordinator', 'Registration::register_als_coord');
    $routes->add('als_teacher', 'Registration::register_teacher');
});
$routes->group('coordinator', function($routes){
    $routes->add('email_temp/(:any)', 'Teacher::email_temp/$1');
    $routes->add('generate_backup', 'Coordinator::generate_backup');
    $routes->add('generate_pdf_report(:any)', 'Coordinator::generate_pdf_report/$1/$2/$3');
    $routes->add('generate_report', 'Coordinator::generate_report');
    $routes->add('migrate_data', 'Coordinator::migrate_data');
    $routes->add('migration', 'Coordinator::migration');
    $routes->add('backup', 'Coordinator::backup');
    $routes->get('notification', 'Coordinator::notification');
    $routes->post('edit_facility', 'Coordinator::edit_facility');
    $routes->add('save_facility', 'Coordinator::save_facility');
    $routes->add('facility', 'Coordinator::facility');
    $routes->add('schedules/(:any)', 'Coordinator::schedules/$1');
    $routes->add('edit_schedules/(:any)', 'Coordinator::edit_schedules/$1');
    $routes->add('save_activity', 'Coordinator::save_activity');
    $routes->add('delete_schedules', 'Coordinator::delete_schedules');
    $routes->add('reports', 'Coordinator::reports');
    $routes->post('edit_cover_photo', 'Coordinator::edit_cover_photo');
    $routes->post('edit_logo', 'Coordinator::edit_logo');
    $routes->post('edit_settings', 'Coordinator::edit_settings');
    $routes->add('settings', 'Coordinator::settings');
    $routes->post('edit_credentials', 'Coordinator::edit_credentials');
    $routes->post('edit_contact_details', 'Coordinator::edit_contact_details');
    $routes->post('edit_info_details', 'Coordinator::edit_info_details');
    $routes->post('edit_picture', 'Coordinator::edit_picture');
    $routes->post('update_password', 'Coordinator::update_password');
    $routes->add('account','Coordinator::my_account');
    $routes->add('create_announcement', 'Coordinator::create_announcement');
    $routes->add('edit_announcement/(:any)', 'Coordinator::edit_announcement/$1');
    $routes->add('edit_announcement_content/(:any)', 'Coordinator::edit_announcement_content/$1');
    $routes->add('edit_announcement_image/(:any)', 'Coordinator::edit_announcement_image/$1');
    $routes->add('announcement', 'Coordinator::announcement');
    $routes->post('save_changes', 'Coordinator::save_changes');
    $routes->post('chat', 'Coordinator::chat');
    $routes->add('message/(:any)', 'Coordinator::message/$1');
    $routes->post('save', 'Coordinator::save_staff');

    $routes->add('view_teacher/(:any)', 'Coordinator::view_teacher/$1');    
    $routes->add('teacher', 'Coordinator::teacher');    

    $routes->post('search_staff/(:any)', 'Coordinator::search_staff/$1');
    $routes->add('assign_task', 'Coordinator::assign_task');
    $routes->add('view_staff/(:any)', 'Coordinator::view_staff/$1');
    $routes->add('add_staff', 'Coordinator::create_staff');
    $routes->post('save_evaluation', 'Coordinator::save_evaluation');
    $routes->add('view_registration/(:any)', 'Coordinator::view_registration/$1');
    $routes->add('validate_staff', 'Coordinator::validate_staff');
    $routes->add('staff', 'Coordinator::staff');
    $routes->add('home', 'Coordinator::dashboard');
    $routes->post('submit', 'Coordinator::auth');
    $routes->add('logout', 'Coordinator::logout');
    $routes->add('reset_password/(:any)', 'Coordinator::reset_password/$1');
    $routes->add('forgot_password', 'Coordinator::forgot_password');
    $routes->add('activation', 'Coordinator::activation');
    $routes->add('activate/(:any)', 'Coordinator::activate/$1');
    $routes->add('create_account', 'Coordinator::create_account');
    $routes->add('login', 'Coordinator::index');
    
    
});

$routes->add('about', 'Home::about');
$routes->add('faqs', 'Home::faqs');
$routes->add('enroll', 'Home::enroll');
$routes->add('barangay', 'Home::barangay');

$routes->add('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
