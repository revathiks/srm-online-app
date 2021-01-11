<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> REST_controller/index
|		my-controller/my-method	-> REST_controller/REST_method
*/
$route['default_controller'] = 'user/User/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*API Start*/

/*User Student API Start*/
$route['api/login'] = 'api/Login/login';
$route['api/user_list'] = 'api/Users/list';
$route['api/upload'] = 'api/Users/upload';
$route['api/stream'] = 'api/Admission/stream';

/* Ciy & State Start */
$route['api/states'] = 'api/Master_table/states';
$route['api/states/(:num)/(:num)'] = 'api/Master_table/states/$1/$2';
$route['api/states/(:num)'] = 'api/Master_table/states/$1';
$route['api/states/(:any)'] = 'api/Master_table/states/$1';
/* Get Single Stream*/
$route['api/state'] = 'api/Master_table/state';
$route['api/state/(:any)'] = 'api/Master_table/state/$1';

$route['api/cities'] = 'api/Master_table/cities';
$route['api/cities/(:num)/(:num)'] = 'api/Master_table/cities/$1/$2';
$route['api/cities/(:num)'] = 'api/Master_table/cities/$1';
$route['api/cities/(:any)'] = 'api/Master_table/cities/$1';
/* Get Single Stream*/
$route['api/city'] = 'api/Master_table/city';
$route['api/city/(:any)'] = 'api/Master_table/city/$1';
/* Ciy & State End */

/* Districts Start */

$route['api/districts'] = 'api/Master_table/districts';
$route['api/districts/(:num)/(:num)'] = 'api/Master_table/districts/$1/$2';
$route['api/districts/(:num)'] = 'api/Master_table/districts/$1';
$route['api/districts/(:any)'] = 'api/Master_table/districts/$1';
/* Get Single Stream*/
$route['api/district'] = 'api/Master_table/district';
$route['api/district/(:any)'] = 'api/Master_table/district/$1';
/* Districts End */


/*Stream Start*/
$route['api/streams'] = 'api/Master_table/streams';
$route['api/streams/(:num)/(:num)'] = 'api/Master_table/streams/$1/$2';
$route['api/streams/(:num)'] = 'api/Master_table/streams/$1';
$route['api/streams/(:any)'] = 'api/Master_table/streams/$1';
/* Get Single Stream*/
$route['api/stream'] = 'api/Master_table/stream';
$route['api/stream/(:any)'] = 'api/Master_table/stream/$1';
/* Stream End */

/*Application Form Start*/
$route['api/programs'] = 'api/Master_table/applications_forms';
$route['api/programs/(:num)/(:num)'] = 'api/Master_table/applications_forms/$1/$2';
$route['api/programs/(:num)'] = 'api/Master_table/applications_forms/$1';
$route['api/programs/(:any)'] = 'api/Master_table/applications_forms/$1';
/* Get Single Stream*/
$route['api/program'] = 'api/Master_table/application_form';
$route['api/program/(:any)'] = 'api/Master_table/application_form/$1';
/* Application Form End */
$route['api/register'] = 'api/Users/register';
$route['api/check_verifylink'] = 'api/Users/check_verifylink';
$route['api/forgotpwd'] = 'api/Users/forgotpwd';
$route['api/otpverifyforgotpwd'] = 'api/Users/otpverifyforgotpwd';
$route['api/updatepwdotp'] = 'api/Users/updatepwdotp';


/*User Start*/
$route['api/users'] = 'api/Users/users';
$route['api/users/(:num)/(:num)'] = 'api/Users/users/$1/$2';
$route['api/users/(:num)'] = 'api/Users/users/$1';
$route['api/users/(:any)'] = 'api/Users/users/$1';
/* Get Single Stream*/
$route['api/user'] = 'api/Users/user';
$route['api/user/(:any)'] = 'api/Users/user/$1';
$route['api/edit_user']='api/Users/edituser';
/* Stream End */

/*Mail Section Start*/
$route['api/insert_mailbox']='api/Mail_box/insertmail';
$route['api/discardmail']='api/Mail_box/discardmail';
$route['api/mailboxes']='api/Mail_box/mailboxes';
$route['api/mailboxes'] = 'api/Mail_box/mailboxes';
$route['api/mailboxes/(:num)/(:num)'] = 'api/Mail_box/mailboxes/$1/$2';
$route['api/mailboxes/(:num)'] = 'api/Mail_box/mailboxes/$1';
$route['api/mailboxes/(:any)'] = 'api/Mail_box/mailboxes/$1';
/* Get Single Stream*/
$route['api/mailbox'] = 'api/Mail_box/mailbox';
$route['api/mailbox/(:any)'] = 'api/Mail_box/mailbox/$1';
/*Mail Section End*/


/* Rabbitmq start */
$route['api/queue_push'] = 'api/Rabbitmq/queue_push';
$route['api/queue_pull'] = 'api/Rabbitmq/queue_pull';
$route['api/send_sms/(:any)/(:any)'] = 'api/Rabbitmq/send_sms/$1/$2';
$route['api/send_sms'] = 'api/Rabbitmq/send_sms';
$route['api/queue_reject'] = 'api/Rabbitmq/queue_reject';
/* Rabbitmq end */

/* Mobile Code Start */
$route['api/mobile_codes'] = 'api/Master_table/mobile_codes';
$route['api/mobile_codes/(:num)/(:num)'] = 'api/Master_table/mobile_codes/$1/$2';
$route['api/mobile_codes/(:num)'] = 'api/Master_table/mobile_codes/$1';
$route['api/mobile_codes/(:any)'] = 'api/Master_table/mobile_codes/$1';
/* Get Single Mobile Code*/
$route['api/mobile_code'] = 'api/Master_table/mobile_code';
$route['api/mobile_code/(:any)'] = 'api/Master_table/mobile_code/$1';

/* Mobile Code End */

$route['api/discardcounts'] = 'api/Mail_box/discardcounts';
$route['api/discardcounts/(:num)/(:num)'] = 'api/Mail_box/discardcounts/$1/$2';
$route['api/discardcounts/(:num)'] = 'api/Mail_box/discardcounts/$1';
$route['api/discardcounts/(:any)'] = 'api/Mail_box/discardcounts/$1';
/* Get Single Stream*/
$route['api/discardcount'] = 'api/Mail_box/discardcount';
$route['api/discardcount/(:any)'] = 'api/Mail_box/discardcount/$1';
/*Mail Section End*/

/*Change Password API*/
$route['api/change_password'] = 'api/Settings/changepassword';
/*Change Password API*/

/*Degree Start*/
$route['api/degrees'] = 'api/Master_table/degrees';
$route['api/degrees/(:num)/(:num)'] = 'api/Master_table/degrees/$1/$2';
$route['api/degrees/(:num)'] = 'api/Master_table/degrees/$1';
$route['api/degrees/(:any)'] = 'api/Master_table/degrees/$1';
/* Get Single Degree*/
$route['api/degree'] = 'api/Master_table/degree';
$route['api/degree/(:any)'] = 'api/Master_table/degree/$1';
/* Degree End */

/*Dashboard API Start*/

$route['api/applicantstatus'] = 'api/Users/applicant_status_list';

/*Dashboard API End*/

/*CRM ADMIN API START*/
$route['api_crmadmin/login'] = 'api_crmadmin/Login/login';
/*CRM ADMIN API END*/

/*Nationality Start*/
$route['api/nationalities'] = 'api/Master_table/nationalities';
$route['api/nationalities/(:num)/(:num)'] = 'api/Master_table/nationalities/$1/$2';
$route['api/nationalities/(:num)'] = 'api/Master_table/nationalities/$1';
$route['api/nationalities/(:any)'] = 'api/Master_table/nationalities/$1';
/* Get Single Nationality*/
$route['api/nationality'] = 'api/Master_table/nationality';
$route['api/nationality/(:any)'] = 'api/Master_table/nationality/$1';
/* Nationality End */

/*Course Start*/
$route['api/courses'] = 'api/Master_table/courses';
$route['api/courses/(:num)/(:num)'] = 'api/Master_table/courses/$1/$2';
$route['api/courses/(:num)'] = 'api/Master_table/courses/$1';
$route['api/courses/(:any)'] = 'api/Master_table/courses/$1';
/* Get Single Course*/
$route['api/course'] = 'api/Master_table/course';
$route['api/course/(:any)'] = 'api/Master_table/course/$1';
/* Course End */

/*Specialization Start*/
$route['api/specializations'] = 'api/Master_table/specializations';
$route['api/specializations/(:num)/(:num)'] = 'api/Master_table/specializations/$1/$2';
$route['api/specializations/(:num)'] = 'api/Master_table/specializations/$1';
$route['api/specializations/(:any)'] = 'api/Master_table/specializations/$1';
/* Get Single Specialization*/
$route['api/specialization'] = 'api/Master_table/specialization';
$route['api/specialization/(:any)'] = 'api/Master_table/specialization/$1';
/* Specialization End */

/*Campus Start*/
$route['api/campuses'] = 'api/Master_table/campuses';
$route['api/campuses/(:num)/(:num)'] = 'api/Master_table/campuses/$1/$2';
$route['api/campuses/(:num)'] = 'api/Master_table/campuses/$1';
$route['api/campuses/(:any)'] = 'api/Master_table/campuses/$1';
/* Get Single Campus*/
$route['api/campus'] = 'api/Master_table/campus';
$route['api/campus/(:any)'] = 'api/Master_table/campus/$1';
/* Campus End */

/*Blood Group Start*/
$route['api/bloodgroups'] = 'api/Master_table/bloodgroups';
$route['api/bloodgroups/(:num)/(:num)'] = 'api/Master_table/bloodgroups/$1/$2';
$route['api/bloodgroups/(:num)'] = 'api/Master_table/bloodgroups/$1';
$route['api/bloodgroups/(:any)'] = 'api/Master_table/bloodgroups/$1';
/* Get Single Campus*/
$route['api/bloodgroup'] = 'api/Master_table/bloodgroup';
$route['api/bloodgroup/(:any)'] = 'api/Master_table/bloodgroup/$1';
/*Blood Group End */
/*Application B.TECH*/
$route['api/app_courses'] = 'api/Master_table/appcourses';
$route['api/app_courses/(:num)/(:num)'] = 'api/Master_table/appcourses/$1/$2';
$route['api/app_courses/(:num)'] = 'api/Master_table/appcourses/$1';
$route['api/app_courses/(:any)'] = 'api/Master_table/appcourses/$1';
/* Get Single Program Application Based*/
$route['api/app_course/(:any)'] = 'api/Master_table/appcourse/$1';
$route['api/app_course'] = 'api/Master_table/app_course';
/*Application B.TECH*/
/* Graduation Start */
$route['api/graduations'] = 'api/Master_table/graduations';
$route['api/graduations/(:num)/(:num)'] = 'api/Master_table/graduations/$1/$2';
$route['api/graduations/(:num)'] = 'api/Master_table/graduations/$1';
$route['api/graduations/(:any)'] = 'api/Master_table/graduations/$1';
/* Get Single Graduation*/
$route['api/graduation/(:any)'] = 'api/Master_table/graduation/$1';
$route['api/graduation'] = 'api/Master_table/graduation';
/*Graduation End*/

/* competitive exam Start */
$route['api/competitive_exams'] = 'api/Master_table/competitive_exams';
$route['api/competitive_exams/(:num)/(:num)'] = 'api/Master_table/competitive_exams/$1/$2';
$route['api/competitive_exams/(:num)'] = 'api/Master_table/competitive_exams/$1';
$route['api/competitive_exams/(:any)'] = 'api/Master_table/competitive_exams/$1';
/* Get Single competitive exam*/
$route['api/competitive_exam/(:any)'] = 'api/Master_table/competitive_exam/$1';
$route['api/competitive_exam'] = 'api/Master_table/competitive_exam';
/*competitive exam End*/

/* applicant_graduation Start */
$route['api/applicant_graduations'] = 'api/Applications/applicant_graduations';
$route['api/applicant_graduations/(:num)/(:num)'] = 'api/Applications/applicant_graduations/$1/$2';
$route['api/applicant_graduations/(:num)'] = 'api/Applications/applicant_graduations/$1';
$route['api/applicant_graduations/(:any)'] = 'api/Applications/applicant_graduations/$1';
/* Get Single applicant_graduation*/
$route['api/applicant_graduation/(:any)'] = 'api/Applications/applicant_graduation/$1';
$route['api/applicant_graduation'] = 'api/Applications/applicant_graduation';
/*applicant_graduation End*/

/* applicant_prof_exp Start */
$route['api/applicant_prof_exps'] = 'api/Applications/applicant_prof_exps';
$route['api/applicant_prof_exps/(:num)/(:num)'] = 'api/Applications/applicant_prof_exps/$1/$2';
$route['api/applicant_prof_exps/(:num)'] = 'api/Applications/applicant_prof_exps/$1';
$route['api/applicant_prof_exps/(:any)'] = 'api/Applications/applicant_prof_exps/$1';
/* Get Single applicant_prof_exp*/
$route['api/applicant_prof_exp/(:any)'] = 'api/Applications/applicant_prof_exp/$1';
$route['api/applicant_prof_exp'] = 'api/Applications/applicant_prof_exp';
/*applicant_prof_exp End*/

/* applicant_publication_det Start */
$route['api/applicant_publication_dets'] = 'api/Applications/applicant_publication_dets';
$route['api/applicant_publication_dets/(:num)/(:num)'] = 'api/Applications/applicant_publication_dets/$1/$2';
$route['api/applicant_publication_dets/(:num)'] = 'api/Applications/applicant_publication_dets/$1';
$route['api/applicant_publication_dets/(:any)'] = 'api/Applications/applicant_publication_dets/$1';
/* Get Single applicant_publication_det*/
$route['api/applicant_publication_det/(:any)'] = 'api/Applications/applicant_publication_det/$1';
$route['api/applicant_publication_det'] = 'api/Applications/applicant_publication_det';
/*applicant_publication_det End*/

/* applicant_other_detail Start */
$route['api/applicant_other_details'] = 'api/Applications/applicant_other_details';
$route['api/applicant_other_details/(:num)/(:num)'] = 'api/Applications/applicant_other_details/$1/$2';
$route['api/applicant_other_details/(:num)'] = 'api/Applications/applicant_other_details/$1';
$route['api/applicant_other_details/(:any)'] = 'api/Applications/applicant_other_details/$1';
/* Get Single applicant_other_detail*/
$route['api/applicant_other_detail/(:any)'] = 'api/Applications/applicant_other_detail/$1';
$route['api/applicant_other_detail'] = 'api/Applications/applicant_other_detail';
/*applicant_other_detail End*/

/* applicant_comp_exams Start */
$route['api/applicant_comp_exams'] = 'api/Applications/applicant_comp_exams';
$route['api/applicant_comp_exams/(:num)/(:num)'] = 'api/Applications/applicant_comp_exams/$1/$2';
$route['api/applicant_comp_exams/(:num)'] = 'api/Applications/applicant_comp_exams/$1';
$route['api/applicant_comp_exams/(:any)'] = 'api/Applications/applicant_comp_exams/$1';
/* Get Single applicant_comp_exams*/
$route['api/applicant_comp_exam/(:any)'] = 'api/Applications/applicant_comp_exam/$1';
$route['api/applicant_comp_exam'] = 'api/Applications/applicant_comp_exam';
/*applicant_comp_exams End*/

/* religions Start */
$route['api/religions'] = 'api/Master_table/religions';
$route['api/religions/(:num)/(:num)'] = 'api/Master_table/religions/$1/$2';
$route['api/religions/(:num)'] = 'api/Master_table/religions/$1';
$route['api/religions/(:any)'] = 'api/Master_table/religions/$1';
/* Get Single religions*/
$route['api/religion/(:any)'] = 'api/Master_table/religion/$1';
$route['api/religion'] = 'api/Master_table/religion';
/*religions End*/
/* mother_tongues Start */
$route['api/mother_tongues'] = 'api/Master_table/mother_tongues';
$route['api/mother_tongues/(:num)/(:num)'] = 'api/Master_table/mother_tongues/$1/$2';
$route['api/mother_tongues/(:num)'] = 'api/Master_table/mother_tongues/$1';
$route['api/mother_tongues/(:any)'] = 'api/Master_table/mother_tongues/$1';
/* Get Single mother_tongues*/
$route['api/mother_tongue/(:any)'] = 'api/Master_table/mother_tongue/$1';
$route['api/mother_tongue'] = 'api/Master_table/mother_tongue';
/*mother_tongues End*/
/* advertisement_source Start */
$route['api/advertisement_sources'] = 'api/Master_table/advertisement_sources';
$route['api/advertisement_sources/(:num)/(:num)'] = 'api/Master_table/advertisement_sources/$1/$2';
$route['api/advertisement_sources/(:num)'] = 'api/Master_table/advertisement_sources/$1';
$route['api/advertisement_sources/(:any)'] = 'api/Master_table/advertisement_sources/$1';
/* Get Single advertisement_source */
$route['api/advertisement_source/(:any)'] = 'api/Master_table/advertisement_source/$1';
$route['api/advertisement_source'] = 'api/Master_table/advertisement_source';
/*advertisement_source End*/

/* branch Start */
$route['api/branchs'] = 'api/Master_table/branchs';
$route['api/branchs/(:num)/(:num)'] = 'api/Master_table/branchs/$1/$2';
$route['api/branchs/(:num)'] = 'api/Master_table/branchs/$1';
$route['api/branchs/(:any)'] = 'api/Master_table/branchs/$1';
/* Get Single branch */
$route['api/branch/(:any)'] = 'api/Master_table/branch/$1';
$route['api/branch'] = 'api/Master_table/branch';
/*branch End*/


/*Mtech Research API Start*/
/*CampusMtech*/
$route['api/get_mtechrecampusprefer']='api/Master_table/get_mtechrecampusprefer';
$route['api/get_mtechrecampusprefer/(:num)/(:num)'] = 'api/Master_table/get_mtechrecampusprefer/$1/$2';
$route['api/get_mtechrecampusprefer/(:num)'] = 'api/Master_table/get_mtechrecampusprefer/$1';
$route['api/get_mtechrecampusprefer/(:any)'] = 'api/Master_table/get_mtechrecampusprefer/$1';
/*Single*/
$route['api/get_mtechrecampusprefer_single']='api/Master_table/get_mtechrecampusprefer_single';
$route['api/get_mtechrecampusprefer_single/(:any)'] = 'api/Master_table/get_mtechrecampusprefer_single/$1';
/*CampusMtech*/
/*SpecializationMtech*/
$route['api/get_mtechrespecializationprefer']='api/Master_table/get_mtechrespecializationprefer';
$route['api/get_mtechrespecializationprefer/(:num)/(:num)'] = 'api/Master_table/get_mtechrespecializationprefer/$1/$2';
$route['api/get_mtechrespecializationprefer/(:num)'] = 'api/Master_table/get_mtechrespecializationprefer/$1';
$route['api/get_mtechrespecializationprefer/(:any)'] = 'api/Master_table/get_mtechrespecializationprefer/$1';
/*Single*/
$route['api/get_mtechrespecializationprefer_single']='api/Master_table/get_mtechrespecializationprefer_single';
$route['api/get_mtechrespecializationprefer_single/(:any)'] = 'api/Master_table/get_mtechrespecializationprefer_single/$1';
/*SpecializationMtech*/
/*Religion*/
$route['api/get_mtechrereligion']='api/Master_table/get_mtechrereligion';
$route['api/get_mtechrereligion/(:num)/(:num)'] = 'api/Master_table/get_mtechrereligion/$1/$2';
$route['api/get_mtechrereligion/(:num)'] = 'api/Master_table/get_mtechrereligion/$1';
$route['api/get_mtechrereligion/(:any)'] = 'api/Master_table/get_mtechrereligion/$1';
/*Single*/
$route['api/get_mtechrereligion_single']='api/Master_table/get_mtechrereligion_single';
$route['api/get_mtechrereligion_single/(:any)'] = 'api/Master_table/get_mtechrereligion_single/$1';
/*Religion*/
/*Mother tongue*/
$route['api/get_mtechremothertong']='api/Master_table/get_mtechremothertong';
$route['api/get_mtechremothertong/(:num)/(:num)'] = 'api/Master_table/get_mtechremothertong/$1/$2';
$route['api/get_mtechremothertong/(:num)'] = 'api/Master_table/get_mtechremothertong/$1';
$route['api/get_mtechremothertong/(:any)'] = 'api/Master_table/get_mtechremothertong/$1';
/*Single*/
$route['api/get_mtechremothertong_single']='api/Master_table/get_mtechremothertong_single';
$route['api/get_mtechremothertong_single/(:any)'] = 'api/Master_table/get_mtechremothertong_single/$1';
/*Mother tongue*/

/*country*/
$route['api/countries']='api/Master_table/countries';
$route['api/countries/(:num)/(:num)'] = 'api/Master_table/countries/$1/$2';
$route['api/countries/(:num)'] = 'api/Master_table/countries/$1';
$route['api/countries/(:any)'] = 'api/Master_table/countries/$1';
/*Single*/
$route['api/country']='api/Master_table/country';
$route['api/country/(:any)'] = 'api/Master_table/country/$1';
/*country*/
$route['api/mtechreearchbasicdet']='api/Mtech_research/mtechreearchbasicdet';
/*Personal Detail*/
$route['api/mtechresearch_personal_detail'] = 'api/Mtech_research/mtechresearch_personal_detail';
/*Personal Detail*/
/*Academic Detail*/
$route['api/mtechresearch_acdemic_dtl'] = 'api/Mtech_research/mtechresearch_acdemic_dtl';
$route['api/mtechresearch_declaration_dtl'] = 'api/Mtech_research/mtechresearch_declaration_dtl';
/*Academic Detail*/
/*Parent Detail*/
$route['api/mtechresearch_parent_detail'] = 'api/Mtech_research/mtechresearch_parent_detail';
/*Parent Detail*/


/*CoordinatorMtech*/
$route['api/coordinatordetails']='api/Master_table/coordinatordetails';
$route['api/coordinatordetails/(:num)/(:num)'] = 'api/Master_table/coordinatordetails/$1/$2';
$route['api/coordinatordetails/(:num)'] = 'api/Master_table/coordinatordetails/$1';
$route['api/coordinatordetails/(:any)'] = 'api/Master_table/coordinatordetails/$1';
/*Single*/
$route['api/singlecoordinator']='api/Master_table/singlecoordinator';
$route['api/singlecoordinator/(:any)'] = 'api/Master_table/singlecoordinator/$1';
/*CoordinatorMtech*/

/*Mtech Research API End*/

/*BArch_design API Start*/
$route['api/barch_basic_detail'] = 'api/Barch/barch_basic_detail';
$route['api/barch_personal_detail'] = 'api/Barch/barch_personal_detail';
$route['api/barch_parent_detail'] = 'api/Barch/barch_parent_detail';
$route['api/barch_acdemic_dtl'] = 'api/Barch/barch_acdemic_dtl';
$route['api/get_applicantid'] = 'api/Master_table/get_applicantid';
$route['api/barch_declaration_detail'] = 'api/Barch/barch_declaration_detail';
/*BArch_design API End*/

/*MArch_design API Start*/
$route['api/march_basic_detail'] = 'api/March_design/march_basic_detail';
$route['api/march_personal_detail'] = 'api/March_design/march_personal_detail';
$route['api/march_parent_detail'] = 'api/March_design/march_parent_detail';
$route['api/march_acdemic_dtl'] = 'api/March_design/march_acdemic_dtl';
$route['api/march_declaration_detail'] = 'api/March_design/march_declaration_detail';
$route['api/upload_final_step'] = 'api/March_design/upload_final_step';
/*MArch_design API Start*/

/*Law API Start*/
$route['api/law_basic_detail'] = 'api/Law/law_basic_detail';
$route['api/law_personal_detail'] = 'api/Law/law_personal_detail';
$route['api/law_parent_detail'] = 'api/Law/law_parent_detail';
$route['api/law_acdemic_dtl'] = 'api/Law/law_acdemic_dtl';
$route['api/law_declaration_detail'] = 'api/Law/law_declaration_detail';
/*Law API END*/

$route['api/upload_files'] = 'api/Master_table/upload_files';

$route['api/upload_filelist/(:num)/(:num)'] = 'api/Master_table/upload_filelist/$1/$2';
$route['api/upload_filelist/(:num)'] = 'api/Master_table/upload_filelist/$1';
$route['api/upload_filelist']='api/Master_table/upload_filelist';

$route['api/other_universities']='api/Master_table/other_universities';
$route['api/other_universities/(:num)'] = 'api/Master_table/other_universities/$1';
$route['api/other_universities/(:num)/(:num)'] = 'api/Master_table/other_universities/$1/$2';

$route['api/user_marking_scheme']='api/Master_table/user_marking_scheme';

$route['api/addressdet']='api/Applications/addressdet';
$route['api/applicant_details']='api/Applications/applicant_details';
$route['api/applicant'] = 'api/Applications/applicantdet';
$route['api/applicant/(:any)'] = 'api/Applications/applicantdet/$1';
$route['api/del_upload_file']='api/Master_table/del_upload_file';
$route['api/phd_acdemic_dtl']='api/Phd/phd_acdemic_dtl';
$route['api/phd_final_step']='api/Phd/phd_final_step';
$route['api/wizard_api']='api/Phd/wizard_api';

/* DB function call start */
$route['api/db_func_other_detail']='api/Applications/db_func_other_detail';
$route['api/db_func_grad_detail']='api/Applications/db_func_grad_detail';
$route['api/db_func_exp_detail']='api/Applications/db_func_exp_detail';
$route['api/db_func_pub_detail']='api/Applications/db_func_pub_detail';
$route['api/db_func_doc_detail']='api/Applications/db_func_doc_detail';
$route['api/db_func_basic_detail']='api/Applications/db_func_basic_detail';
$route['api/db_func_address_detail']='api/Applications/db_func_address_detail';
$route['api/db_func_payment_detail']='api/Applications/db_func_payment_detail';
$route['api/db_func_appln_detail']='api/Applications/db_func_appln_detail';
$route['api/db_func_campus_prefer_detail']='api/Applications/db_func_campus_prefer_detail';
$route['api/db_func_city_prefer_detail']='api/Applications/db_func_city_prefer_detail';
$route['api/db_func_course_prefer_detail']='api/Applications/db_func_course_prefer_detail';
$route['api/db_func_parent_detail']='api/Applications/db_func_parent_detail';
$route['api/db_func_course_detail']='api/Applications/db_func_course_detail';
$route['api/db_func_campus_detail']='api/Applications/db_func_campus_detail';

$route['api/db_func_choice_dropdown']='api/Applications/db_func_choice_dropdown';
$route['api/db_func_schooling_detail']='api/Applications/db_func_schooling_detail';
$route['api/get_appln_form_id']='api/Applications/get_appln_form_id';
$route['api/parent_titles']='api/Master_table/parent_titles';
$route['api/db_func_regcourse_dropdown']='api/Applications/db_func_regcourse_dropdown';


// $route['api/db_func_schooling_detail']='api/Applications/db_func_schooling_detail';
$route['api/db_func_competitive_detail']='api/Applications/db_func_competitive_detail';
$route['api/db_func_instruction']='api/Applications/db_func_instruction';
$route['api/db_func_applicant_appln_detail']='api/Applications/db_func_applicant_appln_detail';
/* DB function call end */
/*User Student API END*/



/*CRM ADMIN API START*/
$route['api_crmadmin/login'] = 'api_crmadmin/Login/login';
/*CRM ADMIN API END*/

/*International Form API START*/
$route['api/international_personal_detail']='api/International_application/international_personal_detail';
$route['api/international_basic_detail']='api/International_application/international_basic_detail';
$route['api/international_basic_detail']='api/International_application/international_basic_detail';
$route['api/international_parent_detail']='api/International_application/international_parent_detail';
$route['api/international_academic_detail']='api/International_application/international_academic_detail';
$route['api/international_address_detail']='api/International_application/international_address_detail';
$route['api/declaration_intl']='api/International_application/declaration_intl';
$route['api/db_func_choice_dropdown_international']='api/International_application/db_func_choice_dropdown_international';
$route['api/resident_category']='api/Master_table/user_resident_category';
$route['api/relation_sponsor']='api/Master_table/user_relation_sponsor';
$route['api/international_register']='api/International_application/register';
$route['api/international_login']='api/International_application/login';

$route['api/examination_list']='api/Master_table/examination_list';
$route['api/examination_list/(:num)/(:num)'] = 'api/Master_table/examination_list/$1/$2';
$route['api/examination_list/(:num)'] = 'api/Master_table/examination_list/$1';
$route['api/examination_list/(:any)'] = 'api/Master_table/examination_list/$1';
$route['api/examination'] = 'api/Master_table/examination';
$route['api/examination/(:any)'] = 'api/Master_table/examination/$1';

$route['api/subject_list']='api/Master_table/subject_list';
$route['api/subject_list/(:num)/(:num)'] = 'api/Master_table/subject_list/$1/$2';
$route['api/subject_list/(:num)'] = 'api/Master_table/subject_list/$1';
$route['api/subject_list/(:any)'] = 'api/Master_table/subject_list/$1';
$route['api/subject'] = 'api/Master_table/subject';
$route['api/subject/(:any)'] = 'api/Master_table/subject/$1';

$route['api/resident_category']='api/Master_table/user_resident_category';
$route['api/relation_sponsor']='api/Master_table/user_relation_sponsor';
/*International Form API End*/

/*Form Wizard Details list*/

$route['api/form_wizards_list'] = 'api/Master_table/form_wizards_list';
$route['api/form_wizards_list/(:num)/(:num)'] = 'api/Master_table/form_wizards_list/$1/$2';
$route['api/form_wizards_list/(:num)'] = 'api/Master_table/form_wizards_list/$1';
$route['api/form_wizards_list/(:any)'] = 'api/Master_table/form_wizards_list/$1';
$route['api/form_wizard_list'] = 'api/Master_table/form_wizard_list';
$route['api/form_wizard_list/(:any)'] = 'api/Master_table/form_wizard_list/$1';

$route['api/appln_wizard_dtl'] = 'api/Master_table/appln_wizard_dtl';


/*API End*/

/*User Student Start*/
$route['login'] = 'user/User/login';
$route['login/(:num)/(:num)'] = 'user/User/login/$1/$2';
$route['login/(:num)'] = 'user/User/login/$1';
$route['login/(:any)'] = 'user/User/login/$1';
// $route['user/dashboard'] = 'user/User/dashboard';
$route['dashboard'] = 'user/User/dashboard';
// $route['user/register'] = 'user/User/register';
$route['register'] = 'user/User/register';
$route['register/(:num)/(:num)'] = 'user/User/register/$1/$2';
$route['register/(:num)'] = 'user/User/register/$1';
$route['register/(:any)'] = 'user/User/register/$1';
$route['regcourse_dropdown'] = 'user/User/get_regcourse_dropdown';
$route['regcourse_dropdown/(:any)'] = 'user/User/get_regcourse_dropdown/$1';



$route['check_verifylink'] = 'user/User/check_verifylink';
$route['check_verifylink/(:any)'] = 'user/User/check_verifylink/$1';
$route['check_verifylink/(:any)/(:any)'] = 'user/User/check_verifylink/$1/$2';
$route['check_verifylink/(:any)/(:any)/(:any)'] = 'user/User/check_verifylink/$1/$2/$3';
$route['check_email_templates'] = 'user/User/check_email_templates';
// $route['user/logout'] = 'user/User/logout';
$route['logout'] = 'user/User/logout';
$route['forgot_password']='user/User/forgot_password';
$route['user/edit_profile']='user/User/edit_profile';
$route['create_captcha']='user/User/create_captcha';
$route['profile']='user/Profile/index';

$route['change-password'] = 'user/Profile/change_password';
$route['get_mobile_codes'] = 'user/User/get_mobile_codes';
$route['get_states'] = 'user/User/get_states';
$route['get_cities'] = 'user/User/get_cities';
$route['get_district'] = 'user/User/get_district';
$route['get_degrees'] = 'user/User/get_degrees';
$route['check_user_exists'] = 'user/User/check_user_exists';
$route['check_captcha'] = 'user/User/check_captcha';

/*MailBox Start*/
$route['mail_box/compose']='user/Mail_box/compose';
$route['mail_box/compose_discard']='user/Mail_box/compose_discard';
$route['mail_box/list']='user/Mail_box/list';
$route['mail_box/inbox']='user/Mail_box/list_inbox';
$route['mail_box/discard_count']='user/Mail_box/discard_count';
/*MailBox End*/

/*Form Preview Start*/
$route['phd-preview']='user/Applications/phd_form_preview';
$route['phd-preview/(:any)/(:any)/(:any)']='user/Applications/phd_form_preview/$1/$2/$3';//CRM ADMIN
/*Form Preview End*/

/*Forgot Password API*/
//$route['forgot_password'] = 'user/User/forgot_password';
$route['otp_forgotpassword'] = 'user/User/otp_forgotpassword';
$route['otp_updateforgotpassword'] = 'user/User/otp_updateforgotpassword';
/*Forgot Password API*/

/* Application Form API */
$route['all-application']='user/Applications/all';
$route['application-form']='user/Applications/form';
$route['application-hs-ug-srmjeeh-form']='user/Applications/form_hs_ug_srmjeeh';
$route['distance-education-application-form']='user/Applications/form_dis_edu';
$route['application/(:any)']='user/Applications/index/$1';
$route['get_nationalities'] = 'user/Applications/get_nationalities';
$route['get_courses'] = 'user/Applications/get_courses';
$route['get_specializations'] = 'user/Applications/get_specializations';
$route['get_campuses'] = 'user/Applications/get_campuses';
$route['get_bloodgroups'] = 'user/Applications/get_bloodgroups';
$route['get_appcourses'] = 'user/Applications/get_appcourses';
$route['get_graduations'] = 'user/Applications/get_graduations';
$route['get_gender_title'] = 'user/Applications/get_gender_title';
$route['get_gender'] = 'user/Applications/get_gender';
$route['get_social_status'] = 'user/Applications/get_social_status';
$route['get_nature_of_deformity'] = 'user/Applications/get_nature_of_deformity';
$route['get_percentage_of_deformity'] = 'user/Applications/get_percentage_of_deformity';
//$route['application-btech']='user/Applications/form_btech';
//$route['application-mtechresearch-form']='user/Applications/form_mtechresearch';

/* Application Form API */

/* PHD Application Starts */
$route['phd']='user/Applications/phd_form';
$route['phd/(:any)/(:any)/(:any)']='user/Applications/phd_form/$1/$2/$3';//CRM ADMIN
$route['get_qualifying_degree']='user/Applications/get_qualifying_degree';
$route['get_spec_qualifying_degree']='user/Applications/get_spec_qualifying_degree';
$route['get_working_dsc']='user/Applications/get_working_dsc';
$route['get_faculty']='user/Applications/get_faculty';
$route['get_work_category']='user/Applications/get_work_category';
$route['get_are_you_employed']='user/Applications/get_are_you_employed';
$route['get_working_place']='user/Applications/get_working_place';
$route['get_are_you_differently_abled']='user/Applications/get_are_you_differently_abled';
$route['api/user_work_category']='api/Master_table/user_work_category';
$route['api/user_working_place']='api/Master_table/user_working_place';
$route['api/user_gender_title']='api/Master_table/user_gender_title';
$route['api/user_gender']='api/Master_table/user_gender';
$route['api/user_social_status']='api/Master_table/user_social_status';

$route['get_institute_university']='user/Applications/get_institute_university';
$route['get_user_marking_scheme']='user/Applications/get_user_marking_scheme';
$route['get_competitive_exams']='user/Applications/get_competitive_exams';
$route['upload-file']='user/Applications/upload_file';
$route['del-uploaded-file']='user/Applications/del_uploaded_file';
$route['get_have_you_taken_any_competitive_exam']='user/Applications/get_have_you_taken_any_competitive_exam';
/* PHD Application Ends */


/* B.Tech Application Start */
$route['btech']='user/Btech/btech_form';
$route['btech/(:any)/(:any)/(:any)']='user/Btech/btech_form/form/$1/$2/$3';//CRM ADMIN
$route['get_studied_from_india']='user/Btech/get_studied_from_india';
$route['get_religions']='user/Btech/get_religions';
$route['get_mother_tongues']='user/Btech/get_mother_tongues';
$route['get_hostel_accommodation']='user/Btech/get_hostel_accommodation';
$route['get_advertisement_source']='user/Btech/get_advertisement_source';
$route['get_branchs']='user/Btech/get_branchs';
$route['get_countries']='user/Btech/get_countries';
$route['get_choice_dropdown']='user/Btech/get_choice_dropdown';

$route['api/btech_basic_detail']='api/Btech/btech_basic_detail';
$route['api/btech_personal_detail']='api/Btech/btech_personal_detail';
$route['api/btech_parent_detail']='api/Btech/btech_parent_detail';
$route['api/btech_academic_detail']='api/Btech/btech_academic_detail';
$route['api/btech_declaration_detail']='api/Btech/btech_declaration_detail';
$route['btech-preview']='user/Btech/btech_form/preview';
$route['btech-preview/(:any)/(:any)/(:any)']='user/Btech/btech_form/preview/$1/$2/$3';//CRM ADMIN

/* B.Tech Application End */
/*User End*/

/*Qualifying Degree Start*/
$route['api/qualifying_degrees'] = 'api/Master_table/qualifying_degrees';
$route['api/qualifying_degrees/(:num)/(:num)'] = 'api/Master_table/qualifying_degrees/$1/$2';
$route['api/qualifying_degrees/(:num)'] = 'api/Master_table/qualifying_degrees/$1';
$route['api/qualifying_degrees/(:any)'] = 'api/Master_table/qualifying_degrees/$1';
/* Get Single Degree*/
$route['api/qualifying_degree'] = 'api/Master_table/qualifying_degree';
$route['api/qualifying_degree/(:any)'] = 'api/Master_table/qualifying_degree/$1';
/*Qualifying Degree End */

/*Specialization Qualifying Degree Start*/
$route['api/spec_qualifying_degrees'] = 'api/Master_table/spec_qualifying_degrees';
$route['api/spec_qualifying_degrees/(:num)/(:num)'] = 'api/Master_table/spec_qualifying_degrees/$1/$2';
$route['api/spec_qualifying_degrees/(:num)'] = 'api/Master_table/spec_qualifying_degrees/$1';
$route['api/spec_qualifying_degrees/(:any)'] = 'api/Master_table/spec_qualifying_degrees/$1';
/* Get Single Specialization Degree*/
$route['api/spec_qualifying_degree'] = 'api/Master_table/spec_qualifying_degree';
$route['api/spec_qualifying_degree/(:any)'] = 'api/Master_table/spec_qualifying_degree/$1';
/*Specialization Qualifying Degree End */


/*Deparments Start*/
$route['api/departments'] = 'api/Master_table/departments';
$route['api/departments/(:num)/(:num)'] = 'api/Master_table/departments/$1/$2';
$route['api/departments/(:num)'] = 'api/Master_table/departments/$1';
$route['api/departments/(:any)'] = 'api/Master_table/departments/$1';
/* Get Single Deparment */
$route['api/department'] = 'api/Master_table/department';
$route['api/department/(:any)'] = 'api/Master_table/department/$1';
/*Deparments End */

/*Deparments Start*/
$route['api/faculties'] = 'api/Master_table/faculties';
$route['api/faculties/(:num)/(:num)'] = 'api/Master_table/faculties/$1/$2';
$route['api/faculties/(:num)'] = 'api/Master_table/faculties/$1';
$route['api/faculties/(:any)'] = 'api/Master_table/faculties/$1';
/* Get Single Faculty */
$route['api/faculty'] = 'api/Master_table/faculty';
$route['api/faculty/(:any)'] = 'api/Master_table/faculty/$1';
/*Deparments End */

/*Deparments Start*/
$route['api/personal_details'] = 'api/Master_table/personal_details';
$route['api/personal_details/(:num)/(:num)'] = 'api/Master_table/personal_details/$1/$2';
$route['api/personal_details/(:num)'] = 'api/Master_table/personal_details/$1';
$route['api/personal_details/(:any)'] = 'api/Master_table/personal_details/$1';
/* Get Single Faculty */
$route['api/personal_detail'] = 'api/Master_table/personal_detail';
$route['api/personal_detail/(:any)'] = 'api/Master_table/personal_detail/$1';
/*Deparments End */

$route['api/user_nature_deformity']='api/Master_table/user_nature_deformity';
$route['api/get_nationality']='api/Master_table/get_nationality';

/*Deparments Start*/
$route['api/get_nationality'] = 'api/Master_table/get_nationality';
$route['api/get_nationality/(:num)/(:num)'] = 'api/Master_table/get_nationality/$1/$2';
$route['api/get_nationality/(:num)'] = 'api/Master_table/get_nationality/$1';
$route['api/get_nationality/(:any)'] = 'api/Master_table/get_nationality/$1';
/* Get Single Faculty */
$route['api/get_nationality_single'] = 'api/Master_table/get_nationality_single';
$route['api/get_nationality_single/(:any)'] = 'api/Master_table/get_nationality_single/$1';
/*Deparments End */

/*Mtech Research Start*/
$route['mtechresearch']='user/Mtech_Research/mtechresearch_form';
$route['mtechresearch/(:any)/(:any)/(:any)']='user/Mtech_Research/mtechresearch_form/form/$1/$2/$3';//CRM ADMIN
$route['get_mtechrecampus_preference']='user/Mtech_Research/get_mtechrecampus_preference';
$route['get_mtechrespecialization_preference']='user/Mtech_Research/get_mtechrespecialization_preference';
$route['get_mtechrereligion']='user/Mtech_Research/get_mtechrereligion';
$route['get_mtechremothertong']='user/Mtech_Research/get_mtechremothertong';
/*Form Preview*/
$route['mtechresearch-preview'] = 'user/Mtech_Research/mtechresearch_form/preview';
$route['mtechresearch-preview/(:any)/(:any)/(:any)']='user/Mtech_Research/mtechresearch_form/preview/$1/$2/$3';//CRM ADMIN
/*Form Preview*/
/*Mtech Research End*/

/*BArch BDesign Form*/
$route['barch']='user/BArch_design/barchdesign_form';
$route['barch/(:any)/(:any)/(:any)']='user/BArch_design/barchdesign_form/$1/$2/$3';//CRM ADMIN
$route['get_compexam_qualifiedstatus']='user/BArch_design/get_compexam_qualifiedstatus';
$route['barch_form_preview']='user/BArch_design/barch_form_preview';
$route['barch_form_preview/(:any)/(:any)/(:any)']='user/BArch_design/barch_form_preview/$1/$2/$3';//CRM ADMIN
/*BArch BDesign Form*/

/*MArch MDesign Form*/
$route['march']='user/March_design/marchdesign_form';
$route['march/(:any)/(:any)/(:any)']='user/March_design/marchdesign_form/$1/$2/$3';//CRM ADMIN
$route['march_form_preview']='user/March_design/march_form_preview';
$route['march_form_preview/(:any)/(:any)/(:any)']='user/March_design/march_form_preview/$1/$2/$3';//CRM ADMIN
/*MArch MDesign Form*/

// Distance Education Start
$route['dis-education']='user/Deducation/dist_edu_form';
$route['dis-education/(:any)/(:any)/(:any)']='user/Deducation/dist_edu_form/$1/$2/$3';//CRM ADMIN
$route['get_current_resident']='user/Deducation/get_current_resident';
$route['get_parent_title'] = 'user/Deducation/get_parent_title';
$route['get_mother_title'] = 'user/Deducation/get_mother_title';
$route['get_parent_occupation'] = 'user/Deducation/get_parent_occupation';
$route['get_eco_weaker_section'] = 'user/Deducation/get_eco_weaker_section';
$route['get_course_prefer']='user/Deducation/get_course_prefer';
// Distance API
$route['api/wizard_api_parent']='api/Distance/wizard_api_parent';
$route['api/wizard_api_dist_edu']='api/Distance/wizard_api_dist_edu';
$route['api/dis_edu_academic_api']='api/Distance/dis_edu_academic_api';
$route['api/declaration_dde']='api/Distance/declaration_dde';

$route['api/user_boards'] = 'api/Master_table/user_boards';
$route['api/user_boards/(:num)/(:num)'] = 'api/Master_table/user_boards/$1/$2';
$route['api/user_boards/(:num)'] = 'api/Master_table/user_boards/$1';
$route['api/user_boards/(:any)'] = 'api/Master_table/user_boards/$1';
$route['api/user_board'] = 'api/Master_table/user_board';
$route['api/user_board/(:any)'] = 'api/Master_table/user_board/$1';

$route['api/db_func_call_dde'] = 'api/Distance/db_func_call_dde';
$route['api/db_func_call_dde/(:num)/(:num)'] = 'api/Distance/db_func_call_dde/$1/$2';
$route['api/db_func_call_dde/(:num)'] = 'api/Distance/db_func_call_dde/$1';
$route['api/db_func_call_dde/(:any)'] = 'api/Distance/db_func_call_dde/$1';

$route['api/db_func_call_dde_campus'] = 'api/Distance/db_func_call_dde_campus';
$route['api/db_func_call_dde_campus/(:num)/(:num)'] = 'api/Distance/db_func_call_dde_campus/$1/$2';
$route['api/db_func_call_dde_campus/(:num)'] = 'api/Distance/db_func_call_dde_campus/$1';
$route['api/db_func_call_dde_campus/(:any)'] = 'api/Distance/db_func_call_dde_campus/$1';

$route['get_board']='user/Deducation/get_board';
$route['get_mode_of_study']='user/Deducation/get_mode_of_study';
$route['get_current_qualification_status']='user/Deducation/get_current_qualification_status';
$route['get_course_preference']='user/Deducation/get_course_preference';
$route['get_campus_preference']='user/Deducation/get_campus_preference';
$route['get_yr_of_passing_schooling']='user/Deducation/get_yr_of_passing_schooling';
$route['api/user_mode_of_study'] = 'api/Master_table/user_mode_of_study';
//$route['api/db_func_call_dde'] = 'api/Users/db_func_call_dde';
//HCMA -hotel catering managemnt application
/* course-branch Start */
$route['api/hcma_branchs'] = 'api/Master_table/hcma_branchs';
$route['api/hcma_branchs/(:num)/(:num)'] = 'api/Master_table/hcma_branchs/$1/$2';
$route['api/hcma_branchs/(:num)'] = 'api/Master_table/hcma_branchs/$1';
$route['api/hcma_branchs/(:any)'] = 'api/Master_table/hcma_branchs/$1';

$route['api/hcma_preference'] = 'api/Hcma/hcma_preference';

$route['api/hcma_basic_detail']='api/Hcma/hcma_basic_detail';
$route['api/hcma_personal_detail']='api/Hcma/hcma_personal_detail';
$route['api/hcma_parent_detail']='api/Hcma/hcma_parent_detail';
$route['api/hcma_addressdet']='api/Hcma/hcma_addressdet';
$route['api/hcma_academicdet']='api/Hcma/hcma_academicdet';
$route['api/hcma_declaration']='api/Hcma/hcma_declaration';
$route['api/parent_occupation']='api/Applications/parent_occupation';

$route['hcma']='user/Hcatering/hcma_form';
$route['hcma/(:any)/(:any)/(:any)']='user/Hcatering/hcma_form/$1/$2/$3';//CRM ADMIN
$route['get_hcma_studied_from_india']='user/Hcatering/get_studied_from_india';
$route['get_hcma_branchs']='user/Hcatering/get_hcma_branchs';
$route['get_resident_status']='user/Hcatering/get_resident_status';
$route['get_sslc_result_status']='user/Hcatering/get_sslc_result_status';
$route['get_cur_edu_status']='user/Hcatering/get_cur_edu_status';
$route['get_hcma_preference']='user/Hcatering/get_hcma_preference';

$route['parent_occupation'] = 'user/Hcatering/parent_occupation';
/*Form Preview Start*/
$route['hcma_preview']='user/Hcatering/hcma_form_preview';
$route['hcma_preview/(:any)/(:any)/(:any)']='user/Hcatering/hcma_form_preview/$1/$2/$3';//CR
/*Form Preview End*/
//HCMA end

$route['thank_you']='user/Applications/thank_you';
$route['get_streams']='user/Deducation/get_streams';

$route['api/learn_second_lang'] = 'api/Master_table/learn_second_lang';
$route['api/grad_univ'] = 'api/Master_table/grad_univ';
$route['dde_form_preview']='user/Deducation/dde_form_preview';
$route['dde_form_preview/(:any)/(:any)/(:any)']='user/Deducation/dde_form_preview/$1/$2/$3';//CRM ADMIN

$route['api/check_applicant_appln']='api/Applications/check_applicant_appln';

/*Mtech Application Start*/
$route['api/mtech_basic_detail']='api/Mtech/mtech_basic_detail';
$route['api/mtech_personal_detail'] = 'api/Mtech/mtech_personal_detail';
$route['api/mtech_parent_detail'] = 'api/Mtech/mtech_parent_detail';
$route['api/mtech_academic_detail'] = 'api/Mtech/mtech_academic_detail';
$route['api/mtech_declaration_detail'] = 'api/Mtech/mtech_declaration_detail';
// $route['application-form/mtech_form']='user/Mtech/mtech_form';
// $route['application-form/mtech_form_preview']='user/Mtech/mbtech_form/preview';
$route['mtech']='user/Mtech/mtech_form';
$route['mtech/(:any)/(:any)/(:any)']='user/Mtech/mtech_form/form/$1/$2/$3';//CRM ADMIN
$route['mtech-preview']='user/Mtech/mtech_form/preview';
$route['mtech-preview/(:any)/(:any)/(:any)']='user/Mtech/mtech_form/preview/$1/$2/$3';//CRM ADMIN
$route['get_comp_exam_qualified_status']='user/Mtech/get_comp_exam_qualified_status';
$route['get_is_work_experience_status']='user/Mtech/get_is_work_experience_status';
/*Mtech Application End*/

// B.sc Hons Aircraft Maintenance Starts
$route['bsc-am']='user/Bscam/bsc_hons_am_form';
$route['bsc-am/(:any)/(:any)/(:any)']='user/Bscam/bsc_hons_am_form/$1/$2/$3';//CRM ADMIN

$route['get_bsc_hons_am_studied_from_india']='user/Bscam/get_studied_from_india';
$route['bscam_preview']='user/Bscam/bscam_form_preview';
$route['bscam_preview/(:any)/(:any)/(:any)']='user/Bscam/bscam_form_preview/$1/$2/$3';//CRM ADMIN
$route['get_spl_preferences_bsc']='user/Bscam/get_spl_preferences_bsc';
$route['get_campus_bsc']='user/Bscam/get_campus_bsc';

//BSC AM API
$route['api/basic_detail_bsc_am']='api/Bscam/basic_detail_bsc_am';
$route['api/personal_detail_bsc_am']='api/Bscam/personal_detail_bsc_am';
$route['api/bsc_parent_detail']='api/Bscam/bsc_parent_detail';
$route['api/bsc_academic_detail']='api/Bscam/bsc_academic_detail';
$route['api/declaration_bscam']='api/Bscam/declaration_bscam';
$route['api/db_func_call_bsc']='api/Bscam/db_func_call_bsc';
$route['api/db_func_call_bsc_campus']='api/Bscam/db_func_call_bsc_campus';
//Bed Med Mphil  application
/* course-branch Start */
$route['api/bmed_mphil_courses'] = 'api/Bmed_mphil/bmed_mphil_courses';

$route['api/bmed_basic_detail']='api/Bmed_mphil/bmed_basic_detail';
$route['api/bmed_personal_detail']='api/Bmed_mphil/bmed_personal_detail';
$route['api/bmed_parent_detail']='api/Bmed_mphil/bmed_parent_detail';
$route['api/bmed_addressdet']='api/Bmed_mphil/bmed_addressdet';
$route['api/bmed_academicdet']='api/Bmed_mphil/bmed_academicdet';
$route['api/bmed_declaration']='api/Bmed_mphil/bmed_declaration';

$route['b-ed-m-ed-m-phil']='user/Bmed_mphil/Bmed_mphil_form';
$route['b-ed-m-ed-m-phil/(:any)/(:any)/(:any)']='user/Bmed_mphil/Bmed_mphil_form/$1/$2/$3';//CRM ADMIN
$route['get_bmed_studied_from_india']='user/Bmed_mphil/get_studied_from_india';

$route['get_bmed_resident_status']='user/Bmed_mphil/get_resident_status';
$route['get_sslc_result_status']='user/Bmed_mphil/get_sslc_result_status';
$route['bmed_edu_status']='user/Bmed_mphil/bmed_edu_status';
$route['bmed_mphil_courses']='user/Bmed_mphil/bmed_mphil_courses';
/*Form Preview Start*/
$route['b-ed-m-ed-m-phil_preview']='user/Bmed_mphil/bmed_form_preview';
$route['b-ed-m-ed-m-phil_preview/(:any)/(:any)/(:any)']='user/Bmed_mphil/bmed_form_preview/$1/$2/$3';//CR
/*Form Preview End*/
//Bed Med Mphil end


/* S&H UG Application Start */
$route['api/shug_basic_detail']='api/Shug/shug_basic_detail';
$route['api/shug_personal_detail']='api/Shug/shug_personal_detail';
$route['api/shug_parent_detail']='api/Shug/shug_parent_detail';
$route['api/shug_addressdet']='api/Shug/shug_addressdet';
$route['api/shug_academicdet']='api/Shug/shug_academicdet';
$route['api/shug_declaration']='api/Shug/shug_declaration';
$route['api/shug_preference'] = 'api/Shug/shug_preference';

$route['shug']='user/Shug/shug_form';
$route['shug/(:any)/(:any)/(:any)']='user/Shug/shug_form/$1/$2/$3';//CRM ADMIN
$route['shug_edu_status']='user/Shug/shug_edu_status';
$route['get_shug_preference']='user/Shug/shug_preference';
/*Form Preview Start*/
$route['shug_preview']='user/Shug/shug_preview';
$route['shug_preview/(:any)/(:any)/(:any)']='user/Shug/shug_preview/$1/$2/$3';//CR

/* S&H UG Application End */

/* S&H UG Application Start */
$route['api/shpg_basic_detail']='api/Shpg/basic_detail';
$route['api/shpg_personal_detail']='api/Shpg/personal_detail';
$route['api/shpg_parent_detail']='api/Shpg/parent_detail';
$route['api/shpg_addressdet']='api/Shpg/addressdet';
$route['api/shpg_academicdet']='api/Shpg/academicdet';
$route['api/shpg_declaration']='api/Shpg/declaration';
$route['api/shpg_preference'] = 'api/Shpg/preference';

$route['shpg']='user/Shpg/shpg_form';
$route['shpg_edu_status']='user/Shpg/shpg_edu_status';
$route['get_shpg_preference']='user/Shpg/shpg_preference';
/*Form Preview Start*/
$route['shpg_preview']='user/Shpg/shpg_preview';
/* S&H UG Application End */

/* S&H UG Application Start */
$route['shpg']='user/Shpg/shpg_form';
/* S&H UG Application End */

/* BBA Application Starts */
$route['api/bba_basic_detail']='api/Bba/basic_detail';
$route['api/bba_personal_detail']='api/Bba/personal_detail';
$route['api/bba_parent_detail']='api/Bba/parent_detail';
$route['api/bba_addressdet']='api/Bba/addressdet';
$route['api/bba_academicdet']='api/Bba/academicdet';
$route['api/bba_declaration']='api/Bba/declaration';

$route['bba']='user/Bba/bba_form';
$route['bba/(:any)/(:any)/(:any)']='user/Bba/bba_form/$1/$2/$3';//CRM ADMIN

$route['bba_edu_status']='user/Bba/bba_edu_status';

/*Form Preview Start*/
$route['bba_preview']='user/Bba/bba_preview';
$route['bba_preview/(:any)/(:any)/(:any)']='user/Bba/bba_preview/$1/$2/$3';//CRM ADMIN
/* BBA Application Ends */

/* common controller and apis*/
$route['api/course_preference'] = 'api/Master_table/course_preference';
$route['api/qualification_status'] = 'api/Master_table/qualification_status';
$route['api/competitive_exam_list'] = 'api/Master_table/competitive_exam_list';
$route['api/job_sectors'] = 'api/Master_table/job_sectors';
$route['api/db_func_qualification_status']='api/Master_table/db_func_qualification_status';
$route['api/upload_final'] = 'api/Master_table/upload_final';
$route['api/fn_get_app_qualifications']='api/Master_table/fn_get_app_qualifications';


$route['studied_from_india']='user/Common_control/get_studied_from_india';
$route['resident_status']='user/Common_control/get_resident_status';
$route['course_preference']='user/Common_control/course_preference';
$route['qualification_status']='user/Common_control/qualification_status';
$route['competitive_exam_list']='user/Common_control/competitive_exam_list';
$route['job_sectors']='user/Common_control/job_sectors';
$route['high_education']='user/Common_control/get_high_education';
$route['form_list']='user/Common_control/form_list';

/* end common controller and apis*/

/* MBA Application Starts */
$route['api/mba_basic_detail']='api/Mba/basic_detail';
$route['api/mba_personal_detail']='api/Mba/personal_detail';
$route['api/mba_parent_detail']='api/Mba/parent_detail';
$route['api/mba_addressdet']='api/Mba/addressdet';
$route['api/mba_academicdet']='api/Mba/academicdet';
$route['api/mba_declaration']='api/Mba/declaration';

$route['mba']='user/Mba/mba_form';
$route['mba/(:any)/(:any)/(:any)']='user/Mba/mba_form/$1/$2/$3';//CRM ADMIN
/*Form Preview Start*/
$route['mba_preview']='user/Mba/mba_preview';
$route['mba_preview/(:any)/(:any)/(:any)']='user/Mba/mba_preview/$1/$2/$3';//CRM ADMIN

/* MBA Application Ends */

/* MBA PART TIME Application Starts */
$route['api/part_time_ug_pg_basic_detail']='api/Mbaparttime/basic_detail';
$route['api/part_time_ug_pg_personal_detail']='api/Mbaparttime/personal_detail';
$route['api/part_time_ug_pg_parent_detail']='api/Mbaparttime/parent_detail';
$route['api/part_time_ug_pg_addressdet']='api/Mbaparttime/addressdet';
$route['api/part_time_ug_pg_academicdet']='api/Mbaparttime/academicdet';
$route['api/part_time_ug_pg_declaration']='api/Mbaparttime/declaration';

$route['part-time-ug-pg-courses']='user/Mbaparttime/mbaparttime_form';
$route['part-time-ug-pg-courses/(:any)/(:any)/(:any)']='user/Mbaparttime/mbaparttime_form/$1/$2/$3';//CRM ADMIN
/*Form Preview Start*/
$route['part-time-ug-pg_preview']='user/Mbaparttime/mbaparttime_preview';
$route['part-time-ug-pg_preview/(:any)/(:any)/(:any)']='user/Mbaparttime/mbaparttime_preview/$1/$2/$3';//CRM ADMIN
/* MBA PART TIME Application Ends */

/* Advanced PG DP Life Science Application Starts */
$route['pgdplifescience']='user/Pgdplifescience/pgdplifescience_form';
$route['pgdplifescience/(:any)/(:any)/(:any)'] ='user/Pgdplifescience/pgdplifescience_form/$1/$2/$3'; //CRM ADMIN
/* Advanced PG DP Life Science Application Ends */

/* Advanced B.Tech & M.Tech Part Time Application Starts */
$route['bmtechpartime']='user/Bmtechpartime/bmtechpartime_form';
$route['get_bmtechpartime_resident_status']='user/Bmtechpartime/get_resident_status';
/* Advanced B.Tech & M.Tech Part Time Application Ends */

/* Advanced M.Arch / M.Des Application Starts */
$route['marchdes']='user/Marchdes/marchdes_form';
/* Advanced M.Arch / M.Des Application Ends */

/* Health Science UG Application Start Starts */
$route['hsug']='user/Hsug/hsug_form';
$route['hsug/(:any)/(:any)/(:any)']='user/Hsug/hsug_form/$1/$2/$3';
$route['hsug_preview']='user/Hsug/hsug_preview';
$route['hsug_preview/(:any)/(:any)/(:any)']='user/Hsug/hsug_preview/$1/$2/$3';
/* Health Science UG Application Ends */

/* Health Science DIP/CERT Application Starts */
$route['hsdipcert']='user/Hsdipcert/hsdipcert_form';
/* Health Science DIP/CERT Application Ends */

/* Health Science DIP/CERT Application Starts -non entrance */
$route['api/hspg_diploma_basic_detail']='api/Hspgdiploma/basic_detail';
$route['api/hspg_diploma_personal_detail']='api/Hspgdiploma/personal_detail';
$route['api/hspg_diploma_parent_detail']='api/Hspgdiploma/parent_detail';
$route['api/hspg_diploma_addressdet']='api/Hspgdiploma/addressdet';
$route['api/hspg_diploma_academicdet']='api/Hspgdiploma/academicdet';
$route['api/hspg_diploma_declaration']='api/Hspgdiploma/declaration';

$route['hspg_diploma']='user/Hspgdiploma/hspg_diploma_form';
$route['hspg_diploma/(:any)/(:any)/(:any)']='user/Hspgdiploma/hspg_diploma_form/$1/$2/$3';//CRM ADMIN
$route['hspg_edu_status']='user/Shug/shug_edu_status';
/*Form Preview Start*/
$route['hspg_diploma_preview']='user/Hspgdiploma/hspg_diploma_preview';
$route['hspg_diploma_preview/(:any)/(:any)/(:any)']='user/Hspgdiploma/hspg_diploma_preview/$1/$2/$3';//CRM ADMIN
/* Health Science DIP/CERT Application Starts -non entrance End */
/* Health Science PG */
$route['api/hspg_ee_basic_detail']='api/Hspgee/basic_detail';
$route['api/hspg_ee_personal_detail']='api/Hspgee/personal_detail';
$route['api/hspg_ee_parent_detail']='api/Hspgee/parent_detail';
$route['api/hspg_ee_addressdet']='api/Hspgee/addressdet';
$route['api/hspg_ee_academicdet']='api/Hspgee/academicdet';
$route['api/hspg_ee_declaration']='api/Hspgee/declaration';
$route['hspg_ee']='user/Hspgee/hspg_ee_form';
$route['hspg_ee/(:any)/(:any)/(:any)']='user/Hspgee/hspg_ee_form/$1/$2/$3';//CRM ADMIN

/*Form Preview Start*/
$route['hspg_ee_preview']='user/Hspgee/hspg_ee_preview';
$route['hspg_ee_preview/(:any)/(:any)/(:any)']='user/Hspgee/hspg_ee_preview/$1/$2/$3';//CRM ADMIN
/* Health Science PG End */

/* Agri Sciences - ALL Program Application Starts */
$route['agrisci']='user/Agrisci/agrisci_form';
$route['agrisci/(:any)/(:any)/(:any)']='user/Agrisci/agrisci_form/$1/$2/$3';//CRM ADMIN
$route['get_agrsci_pgm_level']='user/Agrisci/get_agrsci_pgm_level';
$route['get_agrisci_course_preference']='user/Agrisci/get_agrisci_course_preference';
$route['get_agrisci_cur_edu_status']='user/Agrisci/get_agrisci_cur_edu_status';
$route['agrisci_form_preview']='user/Agrisci/agrisci_form_preview';
$route['agrisci_form_preview/(:any)/(:any)/(:any)']='user/Agrisci/agrisci_form_preview/$1/$2/$3';//CRM ADMIN

/* API Start */
$route['api/basic_details_agrisci']='api/Agrisci/basic_details_agrisci';
$route['api/personal_detail_agrisci']='api/Agrisci/personal_detail_agrisci';
$route['api/agrisci_parent_detail']='api/Agrisci/agrisci_parent_detail';
$route['api/agrisci_academic_detail']='api/Agrisci/agrisci_academic_detail';
$route['api/declaration_agrisci']='api/Agrisci/declaration_agrisci';
$route['api/db_func_call_agrisci_pgm_level']='api/Agrisci/db_func_call_agrisci_pgm_level';
$route['api/db_func_call_agrisci_course']='api/Agrisci/db_func_call_agrisci_course';
/* API End */
/* Agri Sciences - ALL Program Application Ends */

/* Law - ALL Program Application Start */
$route['law']='user/Law/law_form';
$route['law/(:any)/(:any)/(:any)']='user/Law/law_form/$1/$2/$3';//CRM ADMIN
$route['law_edu_status']='user/Law/law_edu_status';
$route['law_form_preview']='user/Law/law_form_preview';
$route['law_form_preview/(:any)/(:any)/(:any)']='user/Law/law_form_preview/$1/$2/$3';//CRM ADMIN
/* Law - ALL Program Application Ends */
/*User Student End*/


/* Tamil Perayam Application Starts */
$route['tamilperayam']			       = 'user/Tamilperayam/tamilperayam_form';
$route['tamilperayam/(:any)/(:any)/(:any)']='user/Tamilperayam/tamilperayam_form/$1/$2/$3';//CRM ADMIN
$route['api/basic_details_tamil']      = 'api/Tamil/basic_details_tamil';
$route['api/personal_detail_tamil']    = 'api/Tamil/personal_detail_tamil';
$route['api/tamil_parent_detail']      = 'api/Tamil/tamil_parent_detail';
$route['api/tamil_academic_detail']    = 'api/Tamil/tamil_academic_detail';
$route['api/declaration_tamil']	       = 'api/Tamil/declaration_tamil';
$route['tamilperayam_form_preview']    = 'user/Tamilperayam/tamilperayam_form_preview';
$route['tamilperayam_form_preview/(:any)/(:any)/(:any)']='user/Tamilperayam/tamilperayam_form_preview/$1/$2/$3';//CRM ADMIN
$route['get_tamilperayam_degree_list'] = 'user/Tamilperayam/get_tamilperayam_degree_list';
$route['get_tamilperayram_course_preference'] = 'user/Tamilperayam/get_tamilperayram_course_preference';
$route['api/db_func_call_tamil_course']		  ='api/Tamil/db_func_call_tamil_course';
/* Tamil Perayam Application Ends */

/* CRM Route Start */
$route['crm-admin/view_applicant'] = 'crm-admin/Grid/view_applicant';
$route['crm-admin/grid_demo_new'] = 'crm-admin/Grid/demo_new';
$route['crm-admin/user_applicant'] = 'crm-admin/Grid/user_applicant';
$route['api_crmadmin/get_user'] = 'api_crmadmin/Master_table/get_user';
/* CRM Route End */

/*CRM ADMIN START*/
$route['crm-admin/login'] = 'crm-admin/Admin/login';
$route['crm-admin/dashboard'] = 'crm-admin/Admin/dashboard';
$route['crm-admin/logout'] = 'crm-admin/Admin/logout';
$route['crm-admin/edit_profile'] = 'crm-admin/Admin/edit_profile';
$route['crm-admin/chart'] = 'crm-admin/Chart/index';
/*CRM ADMIN END*/


/* Advanced PG Diploma Life Science Application Starts */
$route['api/basic_details_apg']='api/Apg/basic_details_apg';
$route['api/personal_detail_apg']='api/Apg/personal_detail_apg';
$route['api/apg_parent_detail']='api/Apg/apg_parent_detail';
$route['api/apg_academic_detail']='api/Apg/apg_academic_detail';
$route['api/declaration_apg']='api/Apg/declaration_apg';

// Select Course and Campus Preference API
$route['api/db_func_call_apg_course']='api/Apg/db_func_call_apg_course';
$route['api/db_func_call_apg_campus']='api/Apg/db_func_call_apg_campus';

$route['get_apg_campus_preference']='user/Pgdplifescience/get_apg_campus_preference';
$route['get_apg_course_preference']='user/Pgdplifescience/get_apg_course_preference';
$route['advanced_pg_dp_form_preview']='user/Pgdplifescience/advanced_pg_dp_ls_form_preview';
$route['advanced_pg_dp_form_preview/(:any)/(:any)/(:any)'] ='user/Pgdplifescience/advanced_pg_dp_ls_form_preview/$1/$2/$3'; //CRM ADMIN
/* Advanced PG Diploma Life Science Application End */


/* Health Science UG Start  Here */
$route['api/hsug_basic_detail']='api/Hsug/basic_detail';
$route['api/hsug_personal_detail']='api/Hsug/personal_detail';
$route['api/hsug_parent_detail']='api/Hsug/parent_detail';
$route['api/hsug_addressdet']='api/Hsug/addressdet';
$route['api/hsug_academicdet']='api/Hsug/academicdet';
$route['api/hsug_declaration']='api/Hsug/declaration';
/* Health Science UG End Here */


/* API Tab Wise */
$route['api/tab_w_percentage']='api/Applications/tab_w_percentage';
$route['user/get_percentage_w_tab']='user/Deducation/get_percentage_w_tab';

/************* PAYMENT API & CONTROLLER START *************/
/*Bank API*/
$route['api/bank_lists']='api/Payment/bank_lists';
$route['api/bank_lists/(:num)/(:num)'] = 'api/Payment/bank_lists/$1/$2';
$route['api/bank_lists/(:num)'] = 'api/Payment/bank_lists/$1';
$route['api/bank_lists/(:any)'] = 'api/Payment/bank_lists/$1';

/*Single*/
$route['api/bank_list']='api/Payment/bank_list';
$route['api/bank_list/(:any)'] = 'api/Payment/bank_list/$1';

/*Bank API*/
$route['get_banks']='user/Common_control/get_banks';
$route['api/payment_details'] = 'api/Payment/payment_details';
$route['user/payment_details'] = 'user/Payment/payment_details';
$route['user/payment_thank_you']='user/Common_control/payment_thank_you';

/* Online Payment Start */
$route['user/payment_process']        = 'user/Payment/payment_process';
$route['user/payment_details_online'] = 'user/Payment/payment_details_online';
$route['api/payment_details_failure'] = 'api/Payment/payment_details_failure';

/************* PAYMENT API & CONTROLLER END *************/

$route['get_schooling_details'] = 'user/Shug/get_schooling_details';


/************** Thank You Show API *****************/
$route['api/thankyou_data'] = 'api/Applications/thankyou_data';

/************** International Form *****************/
$route['international_form'] = 'user/International_application/international_form';
$route['international_form/(:any)/(:any)/(:any)'] ='user/International_application/international_form/$1/$2/$3'; //CRM ADMIN
$route['get_resident_category'] = 'user/International_application/get_resident_category';
$route['get_relation_sponsor'] = 'user/International_application/get_relation_sponsor';
$route['get_choice_dropdown_international'] = 'user/International_application/get_choice_dropdown_international';
$route['get_examination_list'] = 'user/International_application/get_examination_list';
$route['get_subject_list'] = 'user/International_application/get_subject_list';
$route['international-form-preview'] = 'user/International_application/international_form_preview';
$route['international-form-preview/(:any)/(:any)/(:any)'] ='user/International_application/international_form_preview/$1/$2/$3'; //CRM ADMIN
$route['get_resident_international_category'] = 'user/International_application/get_resident_international_category';
$route['get_relation_international_sponsor'] = 'user/International_application/get_relation_international_sponsor';
$route['get_international_percentage_w_tab'] = 'user/International_application/get_international_percentage_w_tab';
$route['get_international_title']='user/International_application/get_international_title';
$route['get_international_mobile_codes'] = 'user/International_application/get_international_mobile_codes';
$route['get_international_gender'] = 'user/International_application/get_international_gender';
$route['get_international_nationality']= 'user/International_application/get_international_nationality';
$route['get_international_countries']= 'user/International_application/get_international_countries';
$route['get_international_parent_occupation']= 'user/International_application/get_international_parent_occupation';
$route['get_international_states']= 'user/International_application/get_international_states';
$route['get_international_cities']= 'user/International_application/get_international_cities';
$route['get_international_marking_scheme']= 'user/International_application/get_international_marking_scheme';
$route['get_international_banks']='user/International_application/get_international_banks';
$route['form_international_list']= 'user/International_application/form_international_list';
//$route[''] = 'user/International_application/';
/*Login & register International*/
$route['forgot_pwd_international']='user/International_user/forgot_pwd_international';
$route['international_dashboard'] = 'user/International_user/international_dashboard';
$route['international_logout'] = 'user/International_user/international_logout';
$route['internationaluser/edit_profile'] = 'user/International_user/edit_profile';
$route['international-form/register'] = 'user/International_user/register';
$route['international-form/login'] = 'user/International_user/login';
$route['get_reg_choice_dropdown_international'] = 'user/International_user/get_reg_choice_dropdown_international';
$route['internationaluser_change_password'] = 'user/International_user/change_password';

$route['api/check_demo'] = 'api/Applications/check_demo';

/****Queries****/
$route['queries']='user/Queries/index';
$route['queries/(:num)/(:num)'] = 'user/Queries/index/$1/$2';
$route['queries/(:num)'] = 'user/Queries/$1';
$route['queries/(:any)'] = 'user/Queries/$1';

$route['create_query']='user/Queries/create_query';
$route['create_query/(:any)']='user/Queries/create_query/$1';
$route['ticket_details/(:num)']='user/Queries/show_ticket/$1';
$route['ticket_details']='user/Queries/show_ticket';

$route['api/save_query'] = 'api/Queries/save_query';
$route['api/query_categories']='api/Master_table/query_categories';
$route['api/form_list']='api/Master_table/form_list';
$route['api/form_list/(:any)']='api/Master_table/form_list/$1';
$route['api/mytickets']='api/Master_table/mytickets';
$route['api/ticket_detail']='api/Master_table/ticket_detail';
$route['api/ticket_conversations']='api/Queries/ticket_conversations';
$route['api/save_conversation'] = 'api/Queries/save_conversation';
$route['api/ticket_detail']='api/Master_table/ticket_detail';


/********** SRM Fellowship Program **********/
$route['fellowship']='user/Fellowship/fellowship_form';
$route['fellowship/(:any)/(:any)/(:any)']='user/Fellowship/fellowship_form/$1/$2/$3';//CRM ADMIN

/* Fellowship API Start */
$route['api/basic_details_fellowship']='api/Fellowship/basic_details_fellowship';
$route['api/personal_detail_fellowship']='api/Fellowship/personal_detail_fellowship';
$route['api/fellowship_parent_detail']='api/Fellowship/fellowship_parent_detail';
$route['api/fellowship_academic_detail']='api/Fellowship/fellowship_academic_detail';
$route['api/declaration_fellowship']='api/Fellowship/declaration_fellowship';
$route['api/db_func_call_fellowship_course']='api/Fellowship/db_func_call_fellowship_course';
$route['api/db_func_call_fellowship_campus']='api/Fellowship/db_func_call_fellowship_campus';
/* Fellowship API End 	*/

// Select Course and Campus Preference API
$route['get_fellowship_campus_preference']='user/Fellowship/get_fellowship_campus_preference';
$route['get_fellowship_course_preference']='user/Fellowship/get_fellowship_course_preference';
$route['fellowship_preview']='user/Fellowship/fellowship_form_preview';
$route['fellowship_preview/(:any)/(:any)/(:any)'] ='user/Fellowship/fellowship_form_preview/$1/$2/$3'; //CRM ADMIN

/********** SRM Fellowship End **********/
/* AFIH Start */
$route['api/afih_basic_detail']='api/Afih/basic_detail';
$route['api/afih_personal_detail']='api/Afih/personal_detail';
$route['api/afih_parent_detail']='api/Afih/parent_detail';
$route['api/afih_addressdet']='api/Afih/addressdet';
$route['api/afih_academicdet']='api/Afih/academicdet';
$route['api/afih_declaration']='api/Afih/declaration';

$route['afih']='user/Afih/afih_form';
$route['afih/(:any)/(:any)/(:any)']='user/Afih/afih_form/$1/$2/$3';//CRM ADMIN
$route['relationships'] = 'user/Afih/get_relationship_types';
$route['api/guardian_relationships']='api/Master_table/guardian_relationships';


/*Form Preview Start*/
$route['afih_preview']='user/Afih/afih_preview';
$route['afih_preview/(:any)/(:any)/(:any)']='user/Afih/afih_preview/$1/$2/$3';//CRM ADMIN
/* AFIH End */

/* PHD JAN Application Starts */
$route['phd-jan']='user/Phd_jan/phd_jan_form';
$route['phd-jan/(:any)/(:any)/(:any)']='user/Phd_jan/phd_jan_form/$1/$2/$3';//CRM ADMIN

$route['api/phd_jan_acdemic_dtl']='api/Phd_jan/acdemic_dtl';
$route['api/phd_jan_final_step']='api/Phd_jan/final_step';
$route['api/wizard_api_phd_jan']='api/Phd_jan/wizard_api_phd_jan';

/*Form Preview Start*/
$route['phd-jan-preview']='user/Phd_jan/phd_jan_form_preview';
$route['phd-jan-preview/(:any)/(:any)/(:any)']='user/Phd_jan/phd_jan_form_preview/$1/$2/$3';//CRM ADMIN
/*Form Preview End*/
/* PHD JAN Application Ends */

// Distance JAN Education Start
$route['dis-education-jan']='user/Deducation_jan/dist_edu_jan_form';
$route['dis-education-jan/(:any)/(:any)/(:any)']='user/Deducation_jan/dist_edu_jan_form/$1/$2/$3';//CRM ADMIN
$route['dde_jan_form_preview']='user/Deducation_jan/dde_jan_form_preview';
$route['dde_jan_form_preview/(:any)/(:any)/(:any)']='user/Deducation_jan/dde_jan_form_preview/$1/$2/$3';//CRM ADMIN
// Distance API
$route['api/wizard_api_parent_edu']='api/Distance_jan/wizard_api_parent_edu';
$route['api/wizard_api_dist_edu_jan']='api/Distance_jan/wizard_api_dist_edu';
$route['api/dis_edu_academic_jan']='api/Distance_jan/dis_edu_academic';
$route['api/declaration_dde_jan']='api/Distance_jan/declaration_dde';
// Distance JAN Education Start END

/*Mtech Research jan Start*/
$route['mtechresearch-jan']='user/Mtech_research_jan/mtechresearch_form';
$route['mtechresearch-jan/(:any)/(:any)/(:any)']='user/Mtech_research_jan/mtechresearch_form/form/$1/$2/$3';//CRM ADMIN
/*Form Preview*/
$route['mtechresearch-jan-preview'] = 'user/Mtech_research_jan/mtechresearch_form/preview';
$route['mtechresearch-jan-preview/(:any)/(:any)/(:any)']='user/Mtech_research_jan/mtechresearch_form/preview/$1/$2/$3';//CRM ADMIN
/*Form Preview*/

$route['api/mtechreearchbasicdet_jan']='api/Mtech_research_jan/mtechreearchbasicdet';
$route['api/mtechresearch_personal_detail_jan'] = 'api/Mtech_research_jan/mtechresearch_personal_detail';
$route['api/mtechresearch_acdemic_dtl_jan'] = 'api/Mtech_research_jan/mtechresearch_acdemic_dtl';
$route['api/mtechresearch_declaration_jan'] = 'api/Mtech_research_jan/mtechresearch_declaration_dtl';
$route['api/mtechresearch_parent_detail_jan'] = 'api/Mtech_research_jan/mtechresearch_parent_detail';
/*Mtech Research jan End*/


// CRM API
$route['api_crmadmin/applicant_details_crm'] = 'api_crmadmin/Crm/applicant_details_crm';

//CRM CHARTS
$route['crm-admin/chart-demo'] = 'crm-admin/Chart/form_applications';

//CRM CHARTS
$route['crm-admin/chart-demo'] = 'crm-admin/Chart/form_applications';
//CRM DEMO CHARTS
$route['crm-admin/chart-demo'] = 'crm-admin/Chart/form_applications';
$route['crm-admin/chart-demo2'] = 'crm-admin/Chart/demo2';
$route['crm-admin/bar-chart'] = 'crm-admin/Chart/demo3';
$route['crm-admin/bar-line-chart'] = 'crm-admin/Chart/demo4';
$route['crm-admin/doughnut-chart'] = 'crm-admin/Chart/demo5';
$route['crm-admin/time-chart'] = 'crm-admin/Chart/demo6';

/* CRM DEMO GRID */
$route['crm-admin/table_demo'] = 'crm-admin/Grid/table_demo';
$route['crm-admin/tickets'] = 'crm-admin/Queries/tickets';
// CRM API
/* Manage Query Routes */
$route['api_crmadmin/alltickets'] = 'api_crmadmin/Queries/tickets';
$route['api_crmadmin/ticketscount']='api_crmadmin/Queries/ticketscount';

$route['crm-admin/queries'] = 'crm-admin/Queries/queries';

$route['crm-admin/ticket_details/(:num)/(:num)/(:num)']='crm-admin/Queries/show_ticket/$1';
$route['crm-admin/ticket_details']='crm-admin/Queries/show_ticket';

/* Manage Qury Routes End*/
/*Payment History Start*/
$route['crm-admin/payment_history'] = 'crm-admin/Payment_history/payment_history';
$route['crm-admin/grid_payment_history'] = 'crm-admin/Payment_history/grid_payment_history';
$route['api_crmadmin/payment_history'] = 'api_crmadmin/Payment_history/payment_history';
/*Payment History End*/
/* CRM Route End */