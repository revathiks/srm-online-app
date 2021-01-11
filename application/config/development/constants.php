<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 |--------------------------------------------------------------------------
 | Display Debug backtrace
 |--------------------------------------------------------------------------
 |
 | If set to TRUE, a backtrace will be displayed along with php errors. If
 | error_reporting is disabled, the backtrace will not display, regardless
 | of this setting
 |
 */
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
 |--------------------------------------------------------------------------
 | File and Directory Modes
 |--------------------------------------------------------------------------
 |
 | These prefs are used when checking and setting modes when working
 | with the file system.  The defaults are fine on servers with proper
 | security, but you may wish (or even need) to change the values in
 | certain environments (Apache running a separate process for each
 | user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
 | always be used to set the mode correctly.
 |
 */
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
 |--------------------------------------------------------------------------
 | File Stream Modes
 |--------------------------------------------------------------------------
 |
 | These modes are used when working with fopen()/popen()
 |
 */
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
 |--------------------------------------------------------------------------
 | Exit Status Codes
 |--------------------------------------------------------------------------
 |
 | Used to indicate the conditions under which the script is exit()ing.
 | While there is no universal standard for error codes, there are some
 | broad conventions.  Three such conventions are mentioned below, for
 | those who wish to make use of them.  The CodeIgniter defaults were
 | chosen for the least overlap with these conventions, while still
 | leaving room for others to be defined in future versions and user
 | applications.
 |
 | The three main conventions used for determining exit status codes
 | are as follows:
 |
 |    Standard C/C++ Library (stdlibc):
 |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
 |       (This link also contains other GNU-specific conventions)
 |    BSD sysexits.h:
 |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
 |    Bash scripting:
 |       http://tldp.org/LDP/abs/html/exitcodes.html
 |
 */
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

defined('APP_URL') OR define('APP_URL', ($_SERVER['SERVER_PORT'] == 443 ? 'https' : 'http') . "://{$_SERVER['SERVER_NAME']}" . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']));

defined('PAGE_LIMIT') OR define('PAGE_LIMIT', 10);
defined('PAGE_OFFSET') OR define('PAGE_OFFSET', 0);

defined('SUPER_ADMIN_HASH') OR define('SUPER_ADMIN_HASH', '$2y$10$.h02aNJzRHyr1mJjjN019eQFj/TSudNtPEMwoT5QYJ1FWzBheffli'); // Srm@123

defined('USER_NAME') OR define('USER_NAME', 'SRM'); // Srm@123


// defined('SESSION_TIMEOUT_IN_MILLISECONDS') OR define('SESSION_TIMEOUT_IN_MILLISECONDS', 120000); // 2 minutes
defined('SESSION_TIMEOUT_IN_SECONDS_PHP') OR define('SESSION_TIMEOUT_IN_SECONDS_PHP', 1200); // 20 minutes




defined('USERS') OR define('USERS', "users");
defined('MASTER_ROLES') OR define('MASTER_ROLES', "master_roles");
defined('USER_ROLES') OR define('USER_ROLES', "user_roles");
defined('USERS_PREFIX') OR define('USERS_PREFIX', "ur_");

defined('LOGIN_API_REQ_MSG') OR define('LOGIN_API_REQ_MSG', "Value Cannot Be Empty..!");
defined('LOGIN_API_FAILED_MSG') OR define('LOGIN_API_FAILED_MSG', "Login Failed..! Invalid Email Or Password");
defined('INVALID_EMAIL') OR define('INVALID_EMAIL', "Invalid Email");
defined('ADMIN_LOGIN_API_FAILED_MSG') OR define('ADMIN_LOGIN_API_FAILED_MSG', "Login Failed..! Invalid Username Or Password");
// defined('LOGIN_API_REDIRECT_ERROR_MSG') OR define('LOGIN_API_REDIRECT_ERROR_MSG', "login");
// defined('LOGIN_API_REDIRECT_MSG') OR define('LOGIN_API_REDIRECT_MSG', "backend/dashboard");

defined('LOGIN_ROLE_NAME_ONE') OR define('LOGIN_ROLE_NAME_ONE', "ADMIN");
defined('LOGIN_ROLE_NAME_TWO') OR define('LOGIN_ROLE_NAME_TWO', "EMPLOYEE");

defined('LOGIN_ROLE_NAME_VALUE_OF_ONE') OR define('LOGIN_ROLE_NAME_VALUE_OF_ONE', "1");
defined('LOGIN_ROLE_NAME_VALUE_OF_TWO') OR define('LOGIN_ROLE_NAME_VALUE_OF_TWO', "2");

defined('REDIRECT_IN') OR define('REDIRECT_IN', "admin/dashboard");
defined('REDIRECT_OUT') OR define('REDIRECT_OUT', "admin/access");


// Image Upload
defined('UPLOAD_PATH') OR define('UPLOAD_PATH', "upload_path");
defined('ALLOWED_TYPES') OR define('ALLOWED_TYPES', "allowed_types");
defined('OVERWRITE') OR define('OVERWRITE', "overwrite");
defined('MAX_SIZE') OR define('MAX_SIZE', "max_size");
defined('MAX_HEIGHT') OR define('MAX_HEIGHT', "max_height");
defined('MAX_WIDTH') OR define('MAX_WIDTH', "max_width");

defined('UPLOAD_PATH_VALUE') OR define('UPLOAD_PATH_VALUE', "./uploads/");
defined('ALLOWED_TYPES_VALUE') OR define('ALLOWED_TYPES_VALUE', "gif|jpg|jpeg|pdf");
defined('OVERWRITE_VALUE') OR define('OVERWRITE_VALUE', TRUE);
defined('MAX_SIZE_VALUE') OR define('MAX_SIZE_VALUE', "2048000");
defined('MAX_HEIGHT_VALUE') OR define('MAX_HEIGHT_VALUE', "768");
defined('MAX_WIDTH_VALUE') OR define('MAX_WIDTH_VALUE', "1024");

defined('INPUT_FILE_NAME') OR define('INPUT_FILE_NAME', "userfile");

defined('LDAP_USERNAME') OR define('LDAP_USERNAME', "geethasj");
defined('LDAP_ROLE_ID') OR define('LDAP_ROLE_ID', 1);

defined('NO_RECORD_FOUND') OR define('NO_RECORD_FOUND', 'NO_RECORD_FOUND');

defined ( 'CREATED_BY' ) OR define ( 'CREATED_BY' , -1 );
defined ( 'USER_TYPE_ID' ) OR define ( 'USER_TYPE_ID' , 2 );
defined ( 'USER_ROLE_ID' ) OR define ( 'USER_ROLE_ID' , 2 );
defined ( 'RECORD_ADDED_SUCCESSFULLY' ) OR define ( 'RECORD_ADDED_SUCCESSFULLY' , 'Record Added Successfully');
defined ( 'ERROR_MSG' ) OR define ( 'ERROR_MSG' , 'Something Wrong,Please try again later.');
defined ( 'RECORD_UPDATE_SUCCESSFULLY' ) OR define ( 'RECORD_UPDATE_SUCCESSFULLY' , 'Record Update Successfully');
/*Schema Start*/
defined('SCHEMA_MASTER') OR define('SCHEMA_MASTER', "master");
defined('SCHEMA_USERMANAGEMENT') OR define('SCHEMA_USERMANAGEMENT', "usermanagement");
defined('SCHEMA_PHP_DEV') OR define('SCHEMA_PHP_DEV', "php_dev");

defined('PAYMENT_TBL_HISTORY') OR define('PAYMENT_TBL_HISTORY','payment_history');
/*Schema End*/

/*Table Start*/
defined ( 'STREAM' ) OR define ( 'STREAM' , 'stream' );
defined ( 'USER' ) OR define ( 'USER' , 'user' );
defined ( 'USER_TYPE' ) OR define ( 'USER_TYPE' , 'user_type');
defined('USER_ROLE') OR define('USER_ROLE', "user_role");
defined('ROLES') OR define('ROLES', "roles");
defined('APPLICATION_FORM') OR define('APPLICATION_FORM', "application_form");
defined('MAIL_BOX') OR define('MAIL_BOX', "mail_box");
defined('MASTER_STATE') OR define('MASTER_STATE', "state");
defined('MASTER_CITY') OR define('MASTER_CITY', "city");
defined('TABLE_VIEW_APPLICATION_DETAILS')OR define('TABLE_VIEW_APPLICATION_DETAILS','vw_applicant_details');
/*Table END*/

defined('APPLICATION_FORM_NAME') OR define('APPLICATION_FORM_NAME',
    serialize(array(array ("id"=>"1", "name"=>"Domestic Applicant" ) ,  array ("id"=>"2", "name"=>"International Applicant"))));

/*ADMIN Login page new template*/
defined ( 'ADMIN_LOGIN_PAGE_TITLE' ) OR define ( 'ADMIN_LOGIN_PAGE_TITLE' , "Login" );
defined ( 'ADMIN_LOGIN_PAGE_HEAD' ) OR define ( 'ADMIN_LOGIN_PAGE_HEAD' , "Login" );
defined ( 'ADMIN_LOGIN_ADMISSION' ) OR define ( 'ADMIN_LOGIN_ADMISSION' , "Admission 2020");
//defined('LOGIN_BUTTON') OR define('LOGIN_BUTTON', "SIGN IN");
//defined ( 'LOGIN_HEADING' ) OR define ( 'LOGIN_HEADING' , "Login Form");
defined('LOGIN_USERNAME_PLACEHOLDER') OR define('LOGIN_USERNAME_PLACEHOLDER', "Username");
defined('LOGIN_PASSWORD_PLACEHOLDER') OR define('LOGIN_PASSWORD_PLACEHOLDER', "Password");
defined('SUCCESS_LOGIN') OR define('SUCCESS_LOGIN', "You Successfully Logged..");
defined('ADMIN_ACCESS') OR define('ACCESS_ADMIN', 1);
defined('STUDENT_ACCESS') OR define('STUDENT_ACCESS', 3);
/*ADMIN Login Page new template*/

/*Login page*/
defined('USER_LOGIN_PAGE_TITLE')OR define('USER_LOGIN_PAGE_TITLE',"Login");
defined('USER_LOGIN_PAGE_TITLE_BELOW')OR define('USER_LOGIN_PAGE_TITLE_BELOW',"Admission 2020");
defined('LOGIN_BUTTON')OR define('LOGIN_BUTTON',"Login");
defined('LOGIN_HEADING')OR define('LOGIN_HEADING',"Login");
defined('LOGIN_CHECK_REMEMBER')OR define('LOGIN_CHECK_REMEMBER',"Check to remember your login details");
defined('LOGIN_USERNAME_PLACEHOLDER')OR define('LOGIN_USERNAME_PLACEHOLDER',"Username");
defined('LOGIN_PASSWORD_PLACEHOLDER')OR define('LOGIN_PASSWORD_PLACEHOLDER',"Password");
defined('SUCCESS_LOGIN')OR define('SUCCESS_LOGIN',"YouSuccessfullyLogged..");
defined('SUCCESS_LOGIN_STATUS')OR define('SUCCESS_LOGIN_STATUS',"1");
defined('SUCCESS_LOGIN_REDIRECT')OR define('SUCCESS_LOGIN_REDIRECT',"dashboard");
defined('SUCCESS_LOGIN_ADMIN_REDIRECT')OR define('SUCCESS_LOGIN_ADMIN_REDIRECT',"crm-admin/dashboard");
defined('SUCCESS_LOGIN_LOADING')OR define('SUCCESS_LOGIN_LOADING',"Loading...!");
defined('SUCCESS_LOGIN_LOADING_AJAX_SUCCESS')OR define('SUCCESS_LOGIN_LOADING_AJAX_SUCCESS',"Success...!");
defined('FAILED_LOGIN_STATUS')OR define('FAILED_LOGIN_STATUS',"0");
defined('FAILED_LOGIN_REDIRECT')OR define('FAILED_LOGIN_REDIRECT',"login");
defined('FAILED_LOGIN_ADMIN_REDIRECT')OR define('FAILED_LOGIN_ADMIN_REDIRECT',"crm-admin/login");
defined('FAILED_LOGIN_LOADING')OR define('FAILED_LOGIN_LOADING',"Failed...!");
defined('LOGIN_PASSWORD_LENGTH')OR define('LOGIN_PASSWORD_LENGTH',5);
defined ( 'VERIFY_ERR' ) OR define ( 'VERIFY_ERR' , 'Please verify your email to proceed further with your application.');
/*Login Page*/

/*CRM ADMIN Login */
defined('CRM_ADMIN_LOGIN')OR define('CRM_ADMIN_LOGIN',"CRM Login");
defined('LOGIN_CRM_BUTTON')OR define('LOGIN_CRM_BUTTON',"Login");
/* CRM ADMIN Login */

/* Temproary Profile Constant */
defined('MY_PROFILE_STATE')OR define('MY_PROFILE_STATE','Tamil Nadu');
defined('MY_PROFILE_CITY')OR define('MY_PROFILE_CITY','Chennai');
defined('MY_PROFILE_LOADING_AJAX_SUCCESS')OR define('MY_PROFILE_LOADING_AJAX_SUCCESS','Updating...!');
defined('MY_PROFILE_ALT_MOBILE_NO_MIN_LIMIT')OR define('MY_PROFILE_ALT_MOBILE_NO_MIN_LIMIT','10');
defined('MY_PROFILE_ALT_MOBILE_NO_MAX_LIMIT')OR define('MY_PROFILE_ALT_MOBILE_NO_MAX_LIMIT','10');

/* Temproary Profile Constant */

/*Change Password*/
defined ( 'PASSWORD_MAX_LENGTH' ) OR define('PASSWORD_MAX_LENGTH',12);
defined ( 'PASSWORD_MIN_LENGTH' ) OR define('PASSWORD_MIN_LENGTH',6);
defined ( 'PASSWORD_EXIST' ) OR define('PASSWORD_EXIST','Exisiting and New Password cannot be same');
defined ( 'OLD_PWD_NOTEXIST' ) OR define('OLD_PWD_NOTEXIST','Current password is incorrect');
defined ( 'PWD_UPDATE' ) OR define('PWD_UPDATE','Password Updated Successfully');
defined ( 'CHANGE_PWD_NOTIFY_SUBJECT' ) OR define('CHANGE_PWD_NOTIFY_SUBJECT','Change Password');
defined ( 'CHANGE_PWD_NOTIFY_MSG' ) OR define('CHANGE_PWD_NOTIFY_MSG','Your Password Changed Successfully ');
defined ( 'CHANGE_PWD_NOTIFY_MSG1' ) OR define('CHANGE_PWD_NOTIFY_MSG1','Changed Successfully');
defined('LOADING_AJAX_SUCCESS')OR define('LOADING_AJAX_SUCCESS','Updating...!');
defined('CHANGE_PWD_MINLENGTH')OR define('CHANGE_PWD_MINLENGTH',5);
defined('CHANGE_PWD_MAXLENGTH')OR define('CHANGE_PWD_MAXLENGTH',20);
defined('PWD_MAXLENGTH')OR define('PWD_MAXLENGTH',20);

/*Change Password*/
/*REGISTER Page*/
defined ( 'USER_REGISTER_PAGE_TITLE' ) OR define ( 'USER_REGISTER_PAGE_TITLE' , "User Register" );
defined ( 'USER_PASSWORD' ) OR define ( 'USER_PASSWORD' ,
    "$2y$10$.h02aNJzRHyr1mJjjN019eQFj/TSudNtPEMwoT5QYJ1FWzBheffli" ); /*Srm@123*/
defined ( 'REGISTER_BUTTON' ) OR define ( 'REGISTER_BUTTON' , "Save" );
defined ( 'REGISTER_HEADING' ) OR define ( 'REGISTER_HEADING' , "Register" );
defined('SUCCESS_REGISTER') OR define('SUCCESS_REGISTER', "Register Successfully..");
/*REGISTER Page*/

/*RESET PWD Page*/
defined ( 'RESET_PWD_TITLE' ) OR define ( 'RESET_PWD_TITLE' , "Forgot password" );
defined ( 'RESET_PWD_HEADING' ) OR define ( 'RESET_PWD_HEADING' , "Forgot password" );
defined ( 'RESET_PWD_BUTTON' ) OR define ( 'RESET_PWD_BUTTON' , "Submit" );
defined('FORGOT_PWD_SUBJECT') OR define('FORGOT_PWD_SUBJECT', "Password");
defined('FORGOT_PWD_MESSAGE') OR define('FORGOT_PWD_MESSAGE', "YOUR PASSWORD IS :");
defined('FORGOT_PWD_TO') OR define('FORGOT_PWD_TO', "geethasj@chn.srmtech.com");
defined('FORGOT_PWD_FROM') OR define('FORGOT_PWD_FROM', "testn9726@gmail.com");
defined('FORGOT_PWD_MINLENGTH')OR define('FORGOT_PWD_MINLENGTH',5);
defined('FORGOT_PWD_MAXLENGTH')OR define('FORGOT_PWD_MAXLENGTH',20);
defined('OTP_RESET_TIME')OR define('OTP_RESET_TIME',15);
defined('FORGOT_PWD_INVALID_EMAIL')OR define('FORGOT_PWD_INVALID_EMAIL','You have not registered with us , please register.');
defined('OTP_MINLENGTH')OR define('OTP_MINLENGTH',6);
defined('OTP_MAXLENGTH')OR define('OTP_MAXLENGTH',6);
defined('INVALID_OTP')OR define('INVALID_OTP','Invalid OTP');
defined('VALID_OTP')OR define('VALID_OTP','OTP Success');
defined('PWD_UPDATE_OTP')OR define('PWD_UPDATE_OTP','Reset Password Sent <br/> As requested, we have successfully changed your password. New password is sent on your registered email id.');
defined('OTP_EXPIRY')OR define('OTP_EXPIRY','OTP Expiry');
defined('LOADING_AJAX')OR define('LOADING_AJAX',"Loading...!");
/*RESET PWD Page*/

/* RabbitMQ Start */
defined('RABBITMQ_CLIENT_PATH') OR define('RABBITMQ_CLIENT_PATH', FCPATH . 'vendor/romainrg/rabbitmq_client');
defined('EMAIL_QUEUE') OR define('EMAIL_QUEUE', 'EMAIL_QUEUE');
// defined('EMAIL_QUEUE') OR define('EMAIL_QUEUE', 'EMAIL_QUEUE_NEW');
defined('SMS_QUEUE') OR define('SMS_QUEUE', 'SMS_QUEUE');
defined('PUSH_QUEUE') OR define('PUSH_QUEUE', 'PUSH_QUEUE');
defined('PREFETCH_SIZE') OR define('PREFETCH_SIZE', null);
defined('PREFETCH_COUNT') OR define('PREFETCH_COUNT', 10);
defined('EMAIL_EXCHANGE') OR define('EMAIL_EXCHANGE', 'emailexchange.amq');
defined('SMS_EXCHANGE') OR define('SMS_EXCHANGE', 'smsexchange.amq');
defined('PUSH_EXCHANGE') OR define('PUSH_EXCHANGE', 'pushexchange.amq');
defined('RABBIT_ROUTING') OR define('RABBIT_ROUTING', 'ERP_ROUTING');
defined('RABBIT_DEALYED_TYPE') OR define('RABBIT_DEALYED_TYPE', 'direct');
//defined('RABBIT_FROM_MAIL') OR define('RABBIT_FROM_MAIL', 'prabaharan.srm@gmail.com');
//defined('RABBIT_CC_MAIL') OR define('RABBIT_CC_MAIL', 'prabaharans@chn.srmtech.com');
//defined('RABBIT_FROM_MAIL') OR define('RABBIT_FROM_MAIL', 'prabaharan.srm@gmail.com');
defined('RABBIT_FROM_MAIL') OR define('RABBIT_FROM_MAIL', 'geethasj@chn.srmtech.com');
//defined('RABBIT_CC_MAIL') OR define('RABBIT_CC_MAIL', 'shunmugakumaranm@chn.srmtech.com');
defined('RABBIT_CC_MAIL') OR define('RABBIT_CC_MAIL', 'geethasj@chn.srmtech.com');
defined('RABBIT_TO_MAIL') OR define('RABBIT_TO_MAIL', 'geethasj@chn.srmtech.com');
defined('RABBIT_SMS_LIVE') OR define('RABBIT_SMS_LIVE', false);
defined('RABBIT_NOT_LIVE') OR define('RABBIT_NOT_LIVE', false);
defined('RABBIT_QUEUE_TYPE') OR define('RABBIT_QUEUE_TYPE', 'classic');
defined('RABBIT_QUEUE_DATA_TYPE') OR define('RABBIT_QUEUE_DATA_TYPE', 'S');
// defined('RABBIT_CC_SMS_NUMBER') OR define('RABBIT_CC_SMS_NUMBER', '919971217430');
// defined('RABBIT_CC_SMS_NUMBER') OR define('RABBIT_CC_SMS_NUMBER', '919092087485');
defined('RABBIT_CC_SMS_NUMBER') OR define('RABBIT_CC_SMS_NUMBER', '919884411439');
// defined('RABBIT_CC_SMS_NUMBER') OR define('RABBIT_CC_SMS_NUMBER', '917868891363');
/* RabbitMQ End */

/*Common*/
defined('UPDATE_SUCCESS_MSG_FORGOT_PWD') OR define('UPDATE_SUCCESS_MSG_FORGOT_PWD', "Please Check your email and logged!.");
defined('INVALID_EDIT_USER_ID') OR define('INVALID_EDIT_USER_ID', "Invalid User ID.");
defined('UPDATE_SUCCESS_MSG_USER') OR define('UPDATE_SUCCESS_MSG_USER', "Profile Details Update Successfully!.");
defined('EDIT_PROFILE_PAGE_TITLE') OR define('EDIT_PROFILE_PAGE_TITLE', "Edit profile");
defined('VIEW_PROFILE_PAGE_TITLE') OR define('VIEW_PROFILE_PAGE_TITLE', "Profile");
defined('INSERT_MESSAGE') OR define('INSERT_MESSAGE', "Message Insert Successfully.");
defined('MAIL_SENT_MESSAGE') OR define('MAIL_SENT_MESSAGE', "Email Sent Successfully.");
defined('MAIL_BOX_TITLE') OR define('MAIL_BOX_TITLE', "Mail Box");
defined('MAIL_BOX_BUTTON') OR define('MAIL_BOX_BUTTON', "Send");
defined('MAIL_BOX_HEADING') OR define('MAIL_BOX_HEADING', "Mail Box");
defined('MAIL_BOX_UNREAD') OR define('MAIL_BOX_UNREAD', 0);
defined('MAIL_BOX_READ') OR define('MAIL_BOX_READ', 1);
defined('MAIL_BOX_DRAFT') OR define('MAIL_BOX_DRAFT', 4);
defined('MAIL_BOX_TRASH') OR define('MAIL_BOX_TRASH', 4);
defined('AUDIT_LOG_USERID') OR define('AUDIT_LOG_USERID', 2);
defined('AUDIT_LOG_NAME') OR define('AUDIT_LOG_NAME', 'TestLog');

/* Compose Email */
defined('MAIL_COMPOSE_BUTTON') OR define('MAIL_COMPOSE_BUTTON', 'Compose');
defined('MAIL_COMPOSE_TO') OR define('MAIL_COMPOSE_TO', 'To');
defined('MAIL_COMPOSE_SUBJECT') OR define('MAIL_COMPOSE_SUBJECT', 'Subject');
defined('MAIL_COMPOSE_BODY') OR define('MAIL_COMPOSE_BODY', 'Body');
defined('MAIL_COMPOSE_SEND') OR define('MAIL_COMPOSE_SEND', 'Send');
defined('MAIL_COMPOSE_CLOSE') OR define('MAIL_COMPOSE_CLOSE', 'Close');
defined('MAIL_COMPOSE_EMAIL') OR define('MAIL_COMPOSE_EMAIL', 'kumar932486@gmail.com');

defined('MAILBOX_INBOX_TEXT') OR define('MAILBOX_INBOX_TEXT', 'inbox');
defined('MAILBOX_SENT_TEXT') OR define('MAILBOX_SENT_TEXT', 'sent');
defined('MAILBOX_TRASH_TEXT') OR define('MAILBOX_TRASH_TEXT', 'trash');
defined('MAIL_BOX_SENT') OR define('MAIL_BOX_SENT', 3);
defined('ADMIN_USER_ID') OR define('ADMIN_USER_ID', 3);
defined('SITE_NAME') OR define('SITE_NAME', 'SRM Online Application');

defined ( 'USER_MANAGEMENT' ) OR define ( 'SCHEMA_USER_MANAGEMENT' , 'usermanagement' );
defined ( 'MODULE' ) OR define ( 'USER_MANAGEMENT_MODULE' , 'module');
defined ( 'HRD' ) OR define ( 'SCHEMA_HRD' , 'hrd' );
defined ( 'EMPLOYEE' ) OR define ( 'HRD_EMPLOYEE' , 'employee');
defined ( 'HRD_EMP_CONTACT' ) OR define ( 'HRD_EMP_CONTACT' , 'emp_contact');
defined ( 'ACADEMICS' ) OR define ( 'SCHEMA_ACADEMICS' , 'academics' );
defined ( 'STUDENT_MASTER' ) OR define ( 'ACADEMICS_STUDENT_MASTER' , 'student_master');
defined ( 'ACADEMICS_STUD_CONTACT' ) OR define ( 'ACADEMICS_STUD_CONTACT' , 'stud_contact');
defined ( 'LOGINFO' ) OR define ( 'SCHEMA_LOGINFO' , 'loginfo' );
defined ( 'TEMPLATE' ) OR define ( 'LOGINFO_TEMPLATE' , 'template');
defined ( 'TEMPLATE_TYPE' ) OR define ( 'LOGINFO_TEMPLATE_TYPE' , 'template_type');
defined ( 'MAIL_LOG' ) OR define ( 'LOGINFO_MAIL_LOG' , 'mail_log');
defined ( 'SMS_LOG' ) OR define ( 'LOGINFO_SMS_LOG' , 'sms_log');
defined ( 'NOTIFICATION_LOG' ) OR define ( 'LOGINFO_NOTIFICATION_LOG' , 'notification_log');
defined ( 'CAPTCHA_WORD_LENGTH' ) OR define ( 'CAPTCHA_WORD_LENGTH' , 5);
defined ( 'FAIL_REGISTER_CAPTCHA_FAIL' ) OR define ( 'FAIL_REGISTER_CAPTCHA_FAIL' , 'Sorry, Captcha could not load this time, Please try again once.');
defined ( 'EMAIL_MAXLENGTH' ) OR define ( 'EMAIL_MAXLENGTH' , 100);
defined ( 'COUNTRY' ) OR define ( 'COUNTRY' , 'country');
defined ( 'DEGREE_TABLE' ) OR define ( 'DEGREE_TABLE' , 'degree');
defined ( 'PROGRAM_TABLE' ) OR define ( 'PROGRAM_TABLE' , 'program');
defined ( 'APPLN_FORM_W_PROGRAM_TABLE' ) OR define ( 'APPLN_FORM_W_PROGRAM_TABLE' , 'appln_form_w_program');
defined ( 'USER_COURSE_TABLE' ) OR define ( 'USER_COURSE_TABLE' , 'user_course');
defined ( 'DEFAULT_STREAM_ID' ) OR define ( 'DEFAULT_STREAM_ID' , 6);
defined ( 'USER_REGISTER_SUBJECT' ) OR define ( 'USER_REGISTER_SUBJECT' , 'SRM Group Of Institutions - Applicant verification');
defined ( 'USER_REGISTER_VERIFY_RESET_TIME' ) OR define ( 'USER_REGISTER_VERIFY_RESET_TIME' , 15);
defined ( 'USER_REGISTER_FROM' ) OR define ( 'USER_REGISTER_FROM' , 'testn9726@gmail.com');
defined ( 'ERROR_RECORD_ADD' ) OR define ( 'ERROR_RECORD_ADD' , 'Error occur while add the record into DB');
defined ( 'MAIL_COULD_NOT_SEND' ) OR define ( 'MAIL_COULD_NOT_SEND' , 'Sorry, Mail could not send this time');
defined ( 'INVALID_VERIFY_TEXT' ) OR define ( 'INVALID_VERIFY_TEXT' , 'Sorry, verificaion link is not valid, Please contact with SRM Group Of Institutions');
defined ( 'VERIFY_SUCCESS' ) OR define ( 'VERIFY_SUCCESS' , 'Thanks for verifying your email.');
defined ( 'VERIFY_LINK_TIME_EXPIRY' ) OR define ( 'VERIFY_LINK_TIME_EXPIRY' , 'Verification link has expired, Please contact with SRM Group Of Institutions');
defined ( 'REGISTER_SUCCESSFULLY' ) OR define ( 'REGISTER_SUCCESSFULLY' , 'Thanks! We have sent a verification link to your email. Please check and verify.');
defined ( 'CAPTCHA_IMAGE_WIDTH' ) OR define ( 'CAPTCHA_IMAGE_WIDTH' , 222);
defined ( 'CAPTCHA_IMAGE_HEIGHT' ) OR define ( 'CAPTCHA_IMAGE_HEIGHT' , 67);
defined ( 'CAPTCHA_FONT_PATH' ) OR define ( 'CAPTCHA_FONT_PATH' , FCPATH.'assets/common/uploads/captcha/fonts/verdana.ttf');
defined ( 'NATIONALITY_INDIAN' ) OR define ( 'NATIONALITY_INDIAN' , 101);
defined ( 'COURSE_TABLE' ) OR define ( 'COURSE_TABLE' , 'course');
defined ( 'SPECIALIZATION_TABLE' ) OR define ( 'SPECIALIZATION_TABLE' , 'specialization');
defined ( 'CAMPUS_TABLE' ) OR define ( 'CAMPUS_TABLE' , 'campus');
defined ( 'MASTER_BLO0D' ) OR define ( 'MASTER_BLO0D' , 'blood_group');
defined ( 'ACADEMIC_YEAR_TABLE' ) OR define ( 'ACADEMIC_YEAR_TABLE' , 'academic_year');
defined ( 'DISTRICTS' ) OR define ( 'DISTRICTS' , 'district');
defined ( 'DEFAULT_MOBILE_CODE' ) OR define ( 'DEFAULT_MOBILE_CODE' , '+91');
defined ( 'DEFAULT_MOBILE_CODE_VALUE' ) OR define ( 'DEFAULT_MOBILE_CODE_VALUE' , '101');
defined ( 'SCHEMA_ADMISSION' ) OR define ( 'SCHEMA_ADMISSION' , 'admission');
defined ( 'TABLE_APPLICANT_LOGIN' ) OR define ( 'TABLE_APPLICANT_LOGIN' , 'applicant_login');
defined ( 'TABLE_APPLICANT_PERSONAL_DET' ) OR define ( 'TABLE_APPLICANT_PERSONAL_DET' , 'applicant_personal_det');
defined ( 'TABLE_APPLICANT_ADDR_DET' ) OR define ( 'TABLE_APPLICANT_ADDR_DET' , 'applicant_addr_det');
defined ( 'MASTER_GRADUATION' ) OR define ( 'MASTER_GRADUATION' , 'graduation');
defined ( 'APPLICANT_PERSONAL_DET_TABLE' ) OR define ( 'APPLICANT_PERSONAL_DET_TABLE' , 'applicant_personal_det');
defined ( 'APPLICANT_DOCUMENT_DET_TABLE' ) OR define ( 'APPLICANT_DOCUMENT_DET_TABLE' , 'applicant_document_det');
defined ( 'APPLICANT_COORDINATOR_DET_TABLE' ) OR define ( 'APPLICANT_COORDINATOR_DET_TABLE' , 'applicant_coordinator_det');
defined ( 'DOCUMENT_TABLE' ) OR define ( 'DOCUMENT_TABLE' , 'document');
defined ( 'APPLICATION_STATUS_TABLE' ) OR define ( 'APPLICATION_STATUS_TABLE' , 'application_status');
defined ( 'APPLICANT_LOGIN_TABLE' ) OR define ( 'APPLICANT_LOGIN_TABLE' , 'applicant_login');
defined ( 'APPLICANT_LOG_TABLE' ) OR define ( 'APPLICANT_LOG_TABLE' , 'applicant_log');
defined ( 'APPLICANT_PAYMENT_DET_TABLE' ) OR define ( 'APPLICANT_PAYMENT_DET_TABLE' , 'applicant_payment_det');
defined ( 'APPLICATION_FORM_TABLE' ) OR define ( 'APPLICATION_FORM_TABLE' , 'application_form');
defined('PARENT_NAME')OR define('PARENT_NAME',100);
defined('TABLE_LOOKUP_MASTER') or define('TABLE_LOOKUP_MASTER', 'lookup_master');
defined('TABLE_LOOKUP_VALUE') or define('TABLE_LOOKUP_VALUE', 'lookup_value');
defined('LOOKUP_MASTER_WORK_CATEGORY') or define('LOOKUP_MASTER_WORK_CATEGORY', 87);
defined('LOOKUP_MASTER_WORKING_PLACE') or define('LOOKUP_MASTER_WORKING_PLACE', 89);

defined('DOCUMENT_ID_PHOTOGRAPH') or define('DOCUMENT_ID_PHOTOGRAPH', 3); //37
defined('DOCUMENT_ID_SIGNATURE') or define('DOCUMENT_ID_SIGNATURE', 4); // 38
defined('DOCUMENT_ID_TENTH_MARKSHEET') or define('DOCUMENT_ID_TENTH_MARKSHEET', 1);
defined('DOCUMENT_ID_TWELVFTH_MARKSHEET') or define('DOCUMENT_ID_TWELVFTH_MARKSHEET', 2);
defined('DOCUMENT_ID_AADHAR_CARD') or define('DOCUMENT_ID_AADHAR_CARD', 5);
defined('DOCUMENT_ID_POST_GRADUATION_MARKSHEET') or define('DOCUMENT_ID_POST_GRADUATION_MARKSHEET', 45);
defined('DOCUMENT_ID_GATE_SCORE_CARD') or define('DOCUMENT_ID_GATE_SCORE_CARD', 46);
defined('DOCUMENT_ID_UGC_SCORE_CARD') or define('DOCUMENT_ID_UGC_SCORE_CARD', 47);
defined('DOCUMENT_ID_SLET_SCORE_CARD') or define('DOCUMENT_ID_SLET_SCORE_CARD', 48);
defined('DOCUMENT_ID_NET_SCORE_CARD') or define('DOCUMENT_ID_NET_SCORE_CARD', 49);
defined('DOCUMENT_ID_SCORE_CARD') or define('DOCUMENT_ID_SCORE_CARD', 7);
defined('DOCUMENT_ID_TENTATIVE_TOPIC') or define('DOCUMENT_ID_TENTATIVE_TOPIC', 50);
defined('DOCUMENT_ID_ADDITIONAL_QUALIFICATION') or define('DOCUMENT_ID_ADDITIONAL_QUALIFICATION', 14);
defined('DOCUMENT_ID_PROVISIONAL_CERTICATE') or define('DOCUMENT_ID_PROVISIONAL_CERTICATE', 56);
defined('DOCUMENT_ID_OTHER_DOCUMENTS') or define('DOCUMENT_ID_OTHER_DOCUMENTS', 57);
defined('DOCUMENT_ID_MBBS_MARKSHEET') or define('DOCUMENT_ID_MBBS_MARKSHEET', 9);
defined('DOCUMENT_ID_MCI_REG_CERTIFICATE') or define('DOCUMENT_ID_MCI_REG_CERTIFICATE', 10);
defined('DOCUMENT_ID_WORK_EXP_CERTIFICATE') or define('DOCUMENT_ID_WORK_EXP_CERTIFICATE', 11);
defined('DOCUMENT_ID_CRRI_CERTIFICATE') or define('DOCUMENT_ID_CRRI_CERTIFICATE', 13);
defined('DOCUMENT_ID_TENTH_GRADE') or define('DOCUMENT_ID_TENTH_GRADE', 58);
defined('DOCUMENT_ID_TWELVFTH_GRADE') or define('DOCUMENT_ID_TWELVFTH_GRADE', 59);
defined('DOCUMENT_ID_BACHELORS_MARKSHEET') or define('DOCUMENT_ID_BACHELORS_MARKSHEET', 60);
defined('DOCUMENT_ID_MASTERS_MARKS_CARD') or define('DOCUMENT_ID_MASTERS_MARKS_CARD', 61);
defined('DOCUMENT_ID_TRANSCRIPTS') or define('DOCUMENT_ID_TRANSCRIPTS', 62);


define('MAX_FILE_SIZE', 200); //in KB
define('MAX_FILE_SIZE_JS', 200000); // in bytes
define('FILE_ALLOWED_TYPE', 'jpg|jpeg|png|pdf|doc|docx');
// define('MAX_FILE_SIZE_FOR_TENTATIVE_TOPIC', 500); //in KB
// define('FILE_ALLOWED_TYPE_FOR_TENTATIVE_TOPIC', 'jpg|jpeg|png|pdf|doc|docx');
define('MAX_FILE_FOR_TENTATIVE_TOPIC', 4);

define('MAX_FILE_SIZE_SCORE_CARD_KB', 5000); //in KB
define('MAX_FILE_SIZE_SCORE_CARD_KB_JS', 5000000); //in KB
define('MAX_FILE_SIZE_SCORE_CARD_MB', 5); //in MB
define('FILE_ALLOWED_TYPE_SCORE_CARD', 'jpg|jpeg|png|pdf');

define('MAX_FILE_SIZE_500_KB', 500); //in KB
define('MAX_FILE_SIZE_500_KB_JS', 500000); //in bytes


defined('PART_TIME_EXTERNAL') or define('PART_TIME_EXTERNAL', 248);
defined('COUNTRY_VALUE_DEFAULT') or define('COUNTRY_VALUE_DEFAULT', 249);
defined( 'DEFAULT_MOBILE_CODE' ) OR define ( 'DEFAULT_MOBILE_CODE' , '+91');
defined( 'DEFAULT_MOBILE_CODE_ID' ) OR define ( 'DEFAULT_MOBILE_CODE_ID' , '249');
defined('LOOKUP_MASTER_TITLE') or define('LOOKUP_MASTER_TITLE', 26);
defined('LOOKUP_MASTER_GENDER') or define('LOOKUP_MASTER_GENDER', 27);
defined('LOOKUP_MASTER_SOCIAL_STATUS') or define('LOOKUP_MASTER_SOCIAL_STATUS', 31);
defined('DEPARTMENT') or define('DEPARTMENT', 'department');
defined('FACULTY') or define('FACULTY', 'faculty');
defined('LOOKUP_MASTER_SOCIAL_STATUS') or define('LOOKUP_MASTER_SOCIAL_STATUS', 31);
defined('TABLE_OTHER_UNIVERSITY') or define('TABLE_OTHER_UNIVERSITY', 'other_university');
defined('LOOKUP_MASTER_MARKING_SCHEME') or define('LOOKUP_MASTER_MARKING_SCHEME', 14);
defined('TABLE_COMPETITIVE_EXAM') or define('TABLE_COMPETITIVE_EXAM', 'competitive_exam');
defined('UPLOAD_FILE_SEPARATOR')OR define('UPLOAD_FILE_SEPARATOR','@@SRM@@');
defined('COMP_EXAM_UGC_NET')OR define('COMP_EXAM_UGC_NET',1);
defined('COMP_EXAM_UGC_CSIR_NET')OR define('COMP_EXAM_UGC_CSIR_NET',2);
defined('COMP_EXAM_SLET')OR define('COMP_EXAM_SLET',3);
defined('COMP_EXAM_GATE')OR define('COMP_EXAM_GATE',4);
defined('COMP_EXAM_TEACHER_FELLOWSHIP_HOLDER')OR define('COMP_EXAM_TEACHER_FELLOWSHIP_HOLDER',5);

defined('APPLICANT_GRADUATION_TABLE') or define('APPLICANT_GRADUATION_TABLE', 'applicant_graduation_det');
defined('APPLICANT_OTHER_DETAILS_TABLE') or define('APPLICANT_OTHER_DETAILS_TABLE', 'applicant_other_details');
defined('APPLICANT_PROFESSIONAL_EXP_TABLE') or define('APPLICANT_PROFESSIONAL_EXP_TABLE', 'applicant_professional_exp');
defined('APPLICANT_PUBLICATION_DET_TABLE') or define('APPLICANT_PUBLICATION_DET_TABLE', 'applicant_publication_det');
defined('APPLICANT_COMPETITIVE_EXAM_DET_TABLE') or define('APPLICANT_COMPETITIVE_EXAM_DET_TABLE', 'applicant_competitive_exam_det');
defined('LOOKUP_MASTER_NATURE_DEFORMITY') or define('LOOKUP_MASTER_NATURE_DEFORMITY', 88);
defined('APP_FORM_ID_BTECH') or define('APP_FORM_ID_BTECH', 7);
defined('APP_FORM_ID_BARCH') or define('APP_FORM_ID_BARCH', 3);
defined('APP_FORM_ID_PHD') or define('APP_FORM_ID_PHD', 22);
defined('APP_FORM_ID_PHD_JAN') or define('APP_FORM_ID_PHD_JAN', 21);
defined('PHD_GRADUATION_ID') or define('PHD_GRADUATION_ID', 2);
defined('PHD_DEGREE_ID') or define('PHD_DEGREE_ID', 37);
defined('APPLICANT_APPLN') or define('APPLICANT_APPLN', 'applicant_appln_det');
/*International*/
defined('LOOKUP_MASTER_RESIDENT_CATEGORY') or define('LOOKUP_MASTER_RESIDENT_CATEGORY', 92);
defined('APP_FORM_ID_INTERNATIONAL') or define('APP_FORM_ID_INTERNATIONAL', 15);
defined('NRI_SPONSERED_VAL') or define('NRI_SPONSERED_VAL', 274);
defined('LOOKUP_MASTER_RELATION_TYPE') or define('LOOKUP_MASTER_RELATION_TYPE', 29);
defined('LOOKUP_VALUE_RELATION_TYPE_GENDER_ID') or define('LOOKUP_VALUE_RELATION_TYPE_GENDER_ID', 94);
defined('LOOKUP_VALUE_RELATION_TYPE_SPOUCE_ID') or define('LOOKUP_VALUE_RELATION_TYPE_SPOUCE_ID', 93);
defined('FN_GET_CHOICE_DROPDOWN_INTERNATIONAL_FORM') or define('FN_GET_CHOICE_DROPDOWN_INTERNATIONAL_FORM', 'fn_get_choice_dropdown_1');
defined('EXAMINATION_TABLE') or define('EXAMINATION_TABLE', 'examination');
defined('SUBJECT_MASTER_TABLE') or define('SUBJECT_MASTER_TABLE', 'subject_master');

defined('INTERNATIONAL_USER_LOGIN_PAGE_TITLE')OR define('INTERNATIONAL_USER_LOGIN_PAGE_TITLE',"International Login");
defined('INTERNATIONAL_USER_LOGIN_PAGE_TITLE_BELOW')OR define('INTERNATIONAL_USER_LOGIN_PAGE_TITLE_BELOW',"International Admission 2020");
defined('INTERNATIONAL_LOGIN_BUTTON')OR define('INTERNATIONAL_LOGIN_BUTTON',"Login");
defined('INTERNATIONAL_LOGIN_HEADING')OR define('INTERNATIONAL_LOGIN_HEADING',"International Admission Login");
defined('INTERNATIONAL_LOGIN_CHECK_REMEMBER')OR define('INTERNATIONAL_LOGIN_CHECK_REMEMBER',"Check to remember your login details");
defined('INTERNATIONAL_LOGIN_USERNAME_PLACEHOLDER')OR define('INTERNATIONAL_LOGIN_USERNAME_PLACEHOLDER',"Username");
defined('INTERNATIONAL_LOGIN_PASSWORD_PLACEHOLDER')OR define('INTERNATIONAL_LOGIN_PASSWORD_PLACEHOLDER',"Password");
defined('INTERNATIONAL_USER_REGISTER_PAGE_TITLE')OR define('INTERNATIONAL_USER_REGISTER_PAGE_TITLE',"International Form User Register");
defined('INTERNATIONAL_REGISTER_BUTTON')OR define('INTERNATIONAL_REGISTER_BUTTON',"Save");
defined('INTERNATIONAL_REGISTER_HEADING')OR define('INTERNATIONAL_REGISTER_HEADING',"International Form Register");
defined('SUCCESS_INTERNATIONAL_LOGIN_REDIRECT')OR define('SUCCESS_INTERNATIONAL_LOGIN_REDIRECT',"international_dashboard");

/*International*/
/*March*/
defined('APP_FORM_ID_MARCH') or define('APP_FORM_ID_MARCH', 17);
defined('MARCH_DEGREE_ID') or define('MARCH_DEGREE_ID', 21);
defined('MARCH_GRADUATION_ID') or define('MARCH_GRADUATION_ID', 2);
/*Mtech Research*/
defined('APP_FORM_ID_MTECH_RESEARCH') or define('APP_FORM_ID_MTECH_RESEARCH', 18);
defined('APP_FORM_ID_MTECH_RESEARCH_JAN') or define('APP_FORM_ID_MTECH_RESEARCH_JAN', 29);
defined('APP_FORM_ID_DE') or define('APP_FORM_ID_DE', 9);
defined('APP_FORM_ID_DE_JAN') or define('APP_FORM_ID_DE_JAN', 30);
defined('APPLICANT_COURSE_PREFER') or define('APPLICANT_COURSE_PREFER', 'applicant_course_prefer');
defined('APPLICANT_CAMPUS_PREFER') or define('APPLICANT_CAMPUS_PREFER', 'applicant_campus_prefer');
defined('PARENT_TYPE_ID_FATHER') or define('PARENT_TYPE_ID_FATHER',81);
defined('PARENT_TYPE_ID_MOTHER') or define('PARENT_TYPE_ID_MOTHER',82);
defined('PARENT_TYPE_ID_GUARDIAN') or define('PARENT_TYPE_ID_GUARDIAN',94);
defined('RELIGION_TABLE') or define('RELIGION_TABLE', 'religion');
defined('MOTHER_TONGUE_TABLE') or define('MOTHER_TONGUE_TABLE', 'mother_tongue');
defined('ADVERTISEMENT_SOURCE_TABLE') or define('ADVERTISEMENT_SOURCE_TABLE', 'advertisement_source');
defined('BRANCH_TABLE') or define('BRANCH_TABLE', 'branch');
defined('APPLICANT_COURSE_PREFER_TABLE') or define('APPLICANT_COURSE_PREFER_TABLE', 'applicant_course_prefer');
defined('APPLICANT_CAMPUS_PREFER_TABLE') or define('APPLICANT_CAMPUS_PREFER_TABLE', 'applicant_campus_prefer');
defined('APPLICANT_CITY_PREFER_TABLE') or define('APPLICANT_CITY_PREFER_TABLE', 'applicant_city_prefer');
defined('FN_GET_APP_OTHER_DETAIL') or define('FN_GET_APP_OTHER_DETAIL', 'fn_get_app_other_detail');
defined('FN_GET_APP_GRAD_DETAIL') or define('FN_GET_APP_GRAD_DETAIL', 'fn_get_app_grad_detail');
defined('FN_GET_APP_EXP_DETAIL') or define('FN_GET_APP_EXP_DETAIL', 'fn_get_app_exp_detail');
defined('FN_GET_APP_PUB_DETAIL') or define('FN_GET_APP_PUB_DETAIL', 'fn_get_app_pub_detail');
defined('FN_GET_APP_DOC_DETAIL') or define('FN_GET_APP_DOC_DETAIL', 'fn_get_app_doc_detail');
defined('FN_GET_APP_BASIC_DETAIL') or define('FN_GET_APP_BASIC_DETAIL', 'fn_get_app_basic_detail');
defined('FN_GET_APP_ADDRESS_DETAIL') or define('FN_GET_APP_ADDRESS_DETAIL', 'fn_get_app_address_detail');
defined('FN_GET_APP_PAYMENT_DETAIL') or define('FN_GET_APP_PAYMENT_DETAIL', 'fn_get_app_payment_detail');
defined('FN_GET_APP_APPLN_DETAIL') or define('FN_GET_APP_APPLN_DETAIL', 'fn_get_app_appln_detail');
defined('FN_GET_APP_CAMPUS_DETAIL') or define('FN_GET_APP_CAMPUS_DETAIL', 'fn_get_app_campus_detail');
defined('FN_GET_APP_CITY_DETAIL') or define('FN_GET_APP_CITY_DETAIL', 'fn_get_app_city_detail');
defined('FN_GET_APP_COURSE_DETAIL') or define('FN_GET_APP_COURSE_DETAIL', 'fn_get_app_course_detail');
defined('FN_GET_APP_PARENT_DETAIL') or define('FN_GET_APP_PARENT_DETAIL', 'fn_get_app_parent_detail');
defined('FN_GET_APP_COURSE_DETAIL') or define('FN_GET_APP_COURSE_DETAIL', 'fn_get_app_course_detail');
defined('FN_GET_APP_CAMPUS_DETAIL') or define('FN_GET_APP_CAMPUS_DETAIL', 'fn_get_app_campus_detail');
defined('FN_GET_CHOICE_DROPDOWN') or define('FN_GET_CHOICE_DROPDOWN', 'fn_get_choice_dropdown');

defined('FN_GET_CHOICE_DROPDOWN_FILTER_TEST') or define('FN_GET_CHOICE_DROPDOWN_FILTER_TEST', 
	'fn_get_choice_dropdown_filter_test');

defined('FN_GET_APP_SCHOOLING_DETAIL') or define('FN_GET_APP_SCHOOLING_DETAIL', 'fn_get_app_schooling_detail');
defined('FN_GET_APP_COMPETITIVE_EXAM_DET') or define('FN_GET_APP_COMPETITIVE_EXAM_DET', 'fn_get_app_competitive_exam_det');
defined('FN_GET_APP_COMPETITIVE_EXAM_LIST') or define('FN_GET_APP_COMPETITIVE_EXAM_LIST', 'fn_get_competitive_exam');
defined ('FN_GET_QUALIFICATION_STATUS') OR define ( 'FN_GET_QUALIFICATION_STATUS' , 'fn_get_grad_w_qualification');
defined ('FN_GET_QUALIFICATIONS') OR define ( 'FN_GET_QUALIFICATIONS' , 'fn_get_app_qualifications');
defined('APP_FORM_ID_DE') or define('APP_FORM_ID_DE', 9);
defined('LOOKUP_MASTER_MODE_OF_STUDY') or define('LOOKUP_MASTER_MODE_OF_STUDY',86);
defined('SCHEMA_COUNSELLING') or define('SCHEMA_COUNSELLING', 'counselling');
defined('SCHOOL_BOARD') or define('SCHOOL_BOARD', 'school_board');
defined('APPLICANT_SCHOOLING_TABLE') or define('APPLICANT_SCHOOLING_TABLE', 'applicant_schooling_det');
defined('SCHOOLING_ID_TENTH') or define('SCHOOLING_ID_TENTH',63);
defined('SCHOOLING_ID_TWELFTH') or define('SCHOOLING_ID_TWELFTH',64);
defined('SCHOOLING_ID_DIPLOMA') or define('SCHOOLING_ID_DIPLOMA',65);
defined('SCHOOLING_ID_EIGHTH') or define('SCHOOLING_ID_EIGHTH',264);
defined('SCHOOLING_ID_NINTH') or define('SCHOOLING_ID_NINTH',325);
defined('SCHOOLING_ID_ELEVENTH') or define('SCHOOLING_ID_ELEVENTH',270);
defined('SCHOOLING_ID_GRADUATION') or define('SCHOOLING_ID_GRADUATION',66);
defined('SCHOOL_BOARD') or define('SCHOOL_BOARD', 'school_board');
defined('SCHOOL_BOARD') or define('SCHOOL_BOARD', 'school_board');
defined('APP_FORM_ID_HCMA') or define('APP_FORM_ID_HCMA', 13);
defined('APP_FORM_ID_HSPG_DIPLOMA') or define('APP_FORM_ID_HSPG_DIPLOMA', 12);
defined('APP_FORM_ID_HSPG_EE') or define('APP_FORM_ID_HSPG_EE', 10);
defined('APP_FORM_ID_AFIH') or define('APP_FORM_ID_AFIH', 35);
defined('APP_FORM_ID_PART_TIME') or define('APP_FORM_ID_PART_TIME', 19);
defined('FORM_W_WIZARD_TABLE') or define('FORM_W_WIZARD_TABLE', 'form_w_wizard');
defined('APPLICANT_PARENT_DET_TABLE') or define('APPLICANT_PARENT_DET_TABLE', 'applicant_parent_det');
defined('OTHER_BOARD') or define('OTHER_BOARD', 26);
defined('BTECH_GRADUATION_ID') or define('BTECH_GRADUATION_ID', 1);
defined('BTECH_DEGREE_ID') or define('BTECH_DEGREE_ID', 2);
defined('BARCH_GRADUATION_ID') or define('BARCH_GRADUATION_ID', 1);
defined('BARCH_DEGREE_ID') or define('BARCH_DEGREE_ID', 11);
defined('LOOKUP_VALUE_ADDRESS_COMMUNICATION') or define('LOOKUP_VALUE_ADDRESS_COMMUNICATION', 79);
defined('LOOKUP_VALUE_PERMANENT_ADDRESS_COMMUNICATION') or define('LOOKUP_VALUE_PERMANENT_ADDRESS_COMMUNICATION', 80);
defined('LOOKUP_VALUE_TITLE_MRS_ID') or define('LOOKUP_VALUE_TITLE_MRS_ID', 73);
defined('LOOKUP_VALUE_TITLE_MS_ID') or define('LOOKUP_VALUE_TITLE_MS_ID', 74);
defined('LOOKUP_VALUE_TITLE_MR_ID') or define('LOOKUP_VALUE_TITLE_MR_ID', 72);
defined('LOOKUP_VALUE_TITLE_LATE_ID') or define('LOOKUP_VALUE_TITLE_LATE_ID', 276);
defined('APP_FORM_ID_MTECH') or define('APP_FORM_ID_MTECH', 27); // WE SHOUD CHANGE ID
defined('MTECH_GRADUATION_ID') or define('MTECH_GRADUATION_ID', 2); // WE SHOUD CHANGE ID
defined('MTECH_DEGREE_ID') or define('MTECH_DEGREE_ID', 1); // WE SHOUD CHANGE ID
defined('DOCUMENT_ID_GRADUATION_MARKSHEET') or define('DOCUMENT_ID_GRADUATION_MARKSHEET', 8);
defined('DOCUMENT_ID_COMPETITIVE_EXAM_MARKSHEET') or define('DOCUMENT_ID_COMPETITIVE_EXAM_MARKSHEET', 7);
defined('APP_FORM_ID_BSCAM') or define('APP_FORM_ID_BSCAM',6);
defined('APP_FORM_ID_BMED_MPHIL') or define('APP_FORM_ID_BMED_MPHIL', 5);
defined('HCMA_UG_COURSE') or define('HCMA_UG_COURSE', 174);
defined('OCCUPATION_TABLE') or define('OCCUPATION_TABLE', 'occupation');
defined('MAKE_PAYMENT') or define('MAKE_PAYMENT', 'Make Payment');
defined('NEXT_STEP') or define('NEXT_STEP', 'Next');
defined('GRADUATION_PG_ID') or define('GRADUATION_PG_ID',266);
defined('GRADUATION_UG_ID') or define('GRADUATION_UG_ID',66);
defined('OTHER_OCCUPATION') or define('OTHER_OCCUPATION', 7);
defined('MTECH_RESEARCH_GRADUATION_ID') or define('MTECH_RESEARCH_GRADUATION_ID', 2);
defined('MTECH_RESEARCH_DEGREE_ID') or define('MTECH_RESEARCH_DEGREE_ID', 31);
defined('MTECH_RESEARCH_COURSE_ID') or define('MTECH_RESEARCH_COURSE_ID', 3);
defined('OTHER_STREAM') or define('OTHER_STREAM', 8);
defined('OTHER_UNIVERSITY') or define('OTHER_UNIVERSITY', 36);
defined('OCCUPATION_OTHER_ID') or define('OCCUPATION_OTHER_ID', 7);
defined('INSTITUTE_UNIVERSITY_OTHER_ID') or define('INSTITUTE_UNIVERSITY_OTHER_ID', 36);


/* S&H UG Application Start */
defined('APP_FORM_ID_SHUG') or define('APP_FORM_ID_SHUG', 23);
/* S&H UG Application END */

/* S&H PG Application Start */
defined('APP_FORM_ID_SHPG') or define('APP_FORM_ID_SHPG', 23);
/* S&H PG Application END */

/* BBA Application Start */
defined('APP_FORM_ID_BBA') or define('APP_FORM_ID_BBA', 4);
/* BBA Application END */

/* MBA Application Start */
defined('APP_FORM_ID_MBA') or define('APP_FORM_ID_MBA', 26);
/* MBA Application END */

/* MBA Part Time Application Start */
defined('APP_FORM_ID_MBAPART') or define('APP_FORM_ID_MBAPART', 23);
/* MBA Part Time Application END */

/* Advanced PG DP Life Science Application Start */
defined('APP_FORM_ID_PGDPLIFE') or define('APP_FORM_ID_PGDPLIFE', 1);
/* Advanced PG DP Life Science Application END */

/* B.Tech & M.Tech Part Time Application Start */
//defined('APP_FORM_ID_BMTECH_PARTTIME') or define('APP_FORM_ID_BMTECH_PARTTIME', 19);
//defined('BMTECH_PART_TIME_GRADUATION_ID') or define('BMTECH_PART_TIME_GRADUATION_ID', 1);
//defined('BMTECH_PART_TIME_DEGREE_ID') or define('BMTECH_PART_TIME_DEGREE_ID', 2);
/* B.Tech & M.Tech Part Time Application END */

/* M.Arch / M.Des Application Start */
//defined('APP_FORM_ID_MARCHDES_PARTTIME') or define('APP_FORM_ID_MARCHDES_PARTTIME', 23);
/* M.Arch / M.Des Application END */

/* Health Science UG Application Start */
defined('APP_FORM_ID_HSUG') or define('APP_FORM_ID_HSUG', 11);
/* Health Science UG Application END */

/* Health Science DIP/CERT Application Start */
// defined('APP_FORM_ID_HSDIPCERT') or define('APP_FORM_ID_HSDIPCERT', 23);
/* Health Science DIP/CERT Application END */

/* Agri Sciences - ALL Program Application Start */
defined('APP_FORM_ID_AGRISCI') or define('APP_FORM_ID_AGRISCI', 2);
/* Agri Sciences - ALL Program Application END */

/* Law - ALL Program Application Start */
defined('APP_FORM_ID_LAW') or define('APP_FORM_ID_LAW', 16);
defined('LAW_GRADUATION_ID') or define('LAW_GRADUATION_ID', 1);
/* Law - ALL Program Application END */

/* Tamil Perayam Application Start */
defined('APP_FORM_ID_TAMIL_PERAYAM') or define('APP_FORM_ID_TAMIL_PERAYAM', 28);
/* Tamil Perayam Application END */

/* Fellowship Application Start */
defined('APP_FORM_ID_FELLOWSHIP') or define('APP_FORM_ID_FELLOWSHIP', 25);
/* Fellowship Application END */

/* Payment Process */
//defined('APPLICATION_FORM_COST') or define ('APPLICATION_FORM_COST', 1100.00);
defined('APPLICATION_FORM_COST') or define ('APPLICATION_FORM_COST', 1100);
defined('MERCHANT_KEY') or define ('MERCHANT_KEY', 'gtKFFx');
defined('MERCHANT_SALT') or define ('MERCHANT_SALT', 'eCwWELxi');
defined('PAYMENT_PROD_INFO') or define ('PAYMENT_PROD_INFO', 'SRM Online Applciation Fees');
//defined('PAYMENT_ONLINE_URL') or define ('PAYMENT_ONLINE_URL', 'https://secure.payu.in');
defined('PAYMENT_ONLINE_URL') or define ('PAYMENT_ONLINE_URL', 'https://test.payu.in');
defined('BANK') or define ('BANK', 'bank');

/*Qualification list*/
defined ('QUALIFICATION_STATUS_TABLE') OR define ( 'QUALIFICATION_STATUS_TABLE' , 'qualification_status');
defined ('GRAD_QUALIFICATION_STATUS_TABLE') OR define ( 'GRAD_QUALIFICATION_STATUS_TABLE' , 'program_level_w_status');
defined ('PG_DIPLOMA_GRAD') OR define ( 'PG_DIPLOMA_GRAD' , '3');
defined ('DIPLOMA_GRAD') OR define ( 'DIPLOMA_GRAD' , '5');
defined ('UG_GRAD') OR define ( 'UG_GRAD' , '1');
defined ('PG_GRAD') OR define ( 'PG_GRAD' , '2');
defined ('CERTIFICATE_GRAD') OR define ( 'CERTIFICATE_GRAD' , '6');
defined ('MBA_GRAD') OR define ( 'MBA_GRAD' , '2');
defined ('FN_GET_INSTRUCTION') OR define ( 'FN_GET_INSTRUCTION' , 'fn_get_instruction');
defined ('FN_GET_APPLICANT_APPLICATION_STATUS') OR define ( 'FN_GET_APPLICANT_APPLICATION_STATUS' , 'fn_get_applicant_application_status');
defined ('FN_GET_APPLICANT_APPLN_DETAIL') OR define ( 'FN_GET_APPLICANT_APPLN_DETAIL' , 'fn_get_applicant_appln_detail');

/* Form wizard Ids Start */
defined ('FORM_WIZARD_BASIC_ID') OR define ( 'FORM_WIZARD_BASIC_ID' , 1);
defined ('FORM_WIZARD_PERSONAL_ID') OR define ( 'FORM_WIZARD_PERSONAL_ID' , 2);
defined ('FORM_WIZARD_PREFERENCE_PERSONAL_ID') OR define ( 'FORM_WIZARD_PREFERENCE_PERSONAL_ID' , 3);
defined ('FORM_WIZARD_ADDRESS_ID') OR define ( 'FORM_WIZARD_ADDRESS_ID' , 4);
defined ('FORM_WIZARD_ACADEMIC_ID') OR define ( 'FORM_WIZARD_ACADEMIC_ID' , 5);
defined ('FORM_WIZARD_PARENT_ID') OR define ( 'FORM_WIZARD_PARENT_ID' , 6);
defined ('FORM_WIZARD_PARENT_ADDRESS_ID') OR define ( 'FORM_WIZARD_PARENT_ADDRESS_ID' , 7);
defined ('FORM_WIZARD_PAYMENT_ID') OR define ( 'FORM_WIZARD_PAYMENT_ID' , 8);
defined ('FORM_WIZARD_UPLOAD_ID') OR define ( 'FORM_WIZARD_UPLOAD_ID' , 9);
defined ('FORM_WIZARD_DECLARATION_ID') OR define ( 'FORM_WIZARD_DECLARATION_ID' , 10);
defined ('FORM_WIZARD_UPLOAD_DECLARATION_ID') OR define ( 'FORM_WIZARD_UPLOAD_DECLARATION_ID' , 11);
/* Form wizard Ids End */

/* Payment Mode Start */
defined('CASH') or define ('CASH', 51);
defined('DD') or define ('DD', 52);
defined('CHEQUE') or define ('CHEQUE', 53);
defined('ONLINE') or define ('ONLINE', 54);
/* Payment Mode End */

/* Application Status*/
defined ('APPLICATION_IN_PROGRESS') OR define ( 'APPLICATION_IN_PROGRESS' , 312);
defined ('APPLICATION_IN_COMPLETED') OR define ( 'APPLICATION_IN_COMPLETED' , 313);
defined ('APPLICATION_IN_REJECTED') OR define ( 'APPLICATION_IN_REJECTED' , 314);
defined ('APPLICATION_IN_APPROVED') OR define ( 'APPLICATION_IN_APPROVED' , 315);
defined ('APPLICATION_IN_CLOSED') OR define ( 'APPLICATION_IN_CLOSED' , 316);
defined ('APPLICATION_IN_OPENED') OR define ( 'APPLICATION_IN_OPENED' , 317);
/* Application Status End*/
/* sector tbl*/
defined ('JOB_SECTOR_TABLE') OR define ( 'JOB_SECTOR_TABLE' , 'sector');
/*end sector*/
/*end sector*/
defined ('OTHER_SECTOR') OR define ( 'OTHER_SECTOR' , 10);
/*end sector*/
defined ('PAYMENT_MODE_DEMAND_DRAFT_ID') OR define ( 'PAYMENT_MODE_DEMAND_DRAFT_ID' , 52);
defined ('PAYMENT_MODE_ONLINE_ID') OR define ( 'PAYMENT_MODE_ONLINE_ID' , 51);
defined ('DEFAULT_VALUE_CHECK') OR define ( 'DEFAULT_VALUE_CHECK' , 0);
/* marking scheme lookup*/
defined('LOOKUP_MASTER_MARKING_SCHEME_GRADE') or define('LOOKUP_MASTER_MARKING_SCHEME_GRADE', 57);
/*payment status*/
defined ('PAYMENT_SUCCESS') OR define ( 'PAYMENT_SUCCESS' , 100);
defined ('PAYMENT_FAILED') OR define ( 'PAYMENT_FAILED' , 101);
/* form type*/
defined ('PART_TIME_FORM_TYPE') OR define ( 'PART_TIME_FORM_TYPE' , 2);
defined ('MAX_FILE_SIZE_GRADUATION') OR define ( 'MAX_FILE_SIZE_GRADUATION' , 500);

/* Campus Available Instruction Advanced PG Diploma Life Science */
defined ('ADPGDLS_CAMPUS_AVAILABLE_AT') OR define ( 'ADPGDLS_CAMPUS_AVAILABLE_AT' , 'Advanced PG Diploma is only available in Main Campus Kattankulathur');

/* Campus Available Instruction SRM FELLOWSHIP PROGRAM */
defined ('FELLOWSHIP_CAMPUS_AVAILABLE_AT') OR define ( 'FELLOWSHIP_CAMPUS_AVAILABLE_AT' , 'Fellowship Program is only available in Main Campus Kattankulathur');

/* Campus Available Instruction BSC-AM */
defined ('BSCAM_CAMPUS_AVAILABLE_AT') OR define ( 'BSCAM_CAMPUS_AVAILABLE_AT' , 'B.Sc (Hons) Aircraft Maintenance Is Only Available In Main Campus Kattankulathur');

defined ('DEFAULT_CHOICE_NO') OR define ( 'DEFAULT_CHOICE_NO' , 1);
defined ('HSPG_DIP_EDU_PURSUING') OR define ( 'HSPG_DIP_EDU_PURSUING' , 6);
defined ('HSPG_DIP_EDU_PASSED') OR define ( 'HSPG_DIP_EDU_PASSED' , 7);
defined ('HSPG_DIP_EDU_HSC_PASSED') OR define ( 'HSPG_DIP_EDU_HSC_PASSED' , 3);
defined ('HSPG_DIP_EDU_HSC_PURSUING') OR define ( 'HSPG_DIP_EDU_HSC_PURSUING' , 2);
defined ('HSPG_EE_EDU_PASSED') OR define ( 'HSPG_EE_EDU_PASSED' , 9);
defined ('QUAL_TWELFTH') OR define ( 'QUAL_TWELFTH' , 46);
defined ('QUAL_DIPLOMA') OR define ( 'QUAL_DIPLOMA' , 265);

defined ('WORKING_PLACE_OTHER') OR define ( 'WORKING_PLACE_OTHER' , 260);
defined ('WORKING_PLACE_INDUSTRY') OR define ( 'WORKING_PLACE_INDUSTRY' , 257);
defined ('WORKING_PLACE_ORG') OR define ( 'WORKING_PLACE_ORG' , 259);
defined ('WORKING_PLACE_CLG') OR define ( 'WORKING_PLACE_CLG' , 258);
defined ('SCHEMA_CRM') OR define ( 'SCHEMA_CRM' , 'crm');
defined ('TICKET_CATEGORY_TABLE') OR define ( 'TICKET_CATEGORY_TABLE' , 'query_category');
defined ('TICKET_SUB_CATEGORY_TABLE') OR define ( 'TICKET_SUB_CATEGORY_TABLE' , 'cat_w_sub_cat');
defined ('TICKETS_TABLE') OR define ( 'TICKETS_TABLE' , 'tickets');
defined ('TICKETS_APPLICANT_TABLE') OR define ( 'TICKETS_APPLICANT_TABLE' , 'applicant_query');
defined ('TICKETS_OPEN_STATUS') OR define ( 'TICKETS_OPEN_STATUS' , 5);
defined ('TICKETS_CLOSED_STATUS') OR define ( 'TICKETS_CLOSED_STATUS' , 6);
defined ('TICKETS_INPROGRESS_STATUS') OR define ( 'TICKETS_INPROGRESS_STATUS' , 3);
defined ('STATUS_TABLE') OR define ( 'STATUS_TABLE' , 'status');

/*** Form Title ***/
defined ('SRM_FELLOWSHIP') OR define ( 'SRM_FELLOWSHIP' , 'SRM Fellowship Program');
defined ('AFIH_TITLE') OR define ( 'AFIH_TITLE' , 'AFIH');

defined ('UPDATED_SUCCESS_UPLOAD_WIZARD') OR define ( 'UPDATED_SUCCESS_UPLOAD_WIZARD' , 'Updated Successfully');

/*** FELLOWSHIP Program ***/
defined ('SRM_FELLOWSHIP_ID') OR define ( 'SRM_FELLOWSHIP_ID' , 8);
/**AFIH**/
defined('LOOKUP_VALUE_RELATION_GUARDIAN_ID') or define('LOOKUP_VALUE_RELATION_GUARDIAN_ID', 94);
defined('LOOKUP_VALUE_RELATION_MOTHER_ID') or define('LOOKUP_VALUE_RELATION_MOTHER_ID', 81);
defined('LOOKUP_VALUE_RELATION_FATHER_ID') or define('LOOKUP_VALUE_RELATION_FATHER_ID', 82);

/*Admin Session FORM Mode*/
defined('ADMIN_MODE_EDIT') or define('ADMIN_MODE_EDIT', 'edit');
defined('CRM_ADMIN_USER_ROLE_ID') or define('CRM_ADMIN_USER_ROLE_ID', 1);

defined('END_DOB_YEAR') or define('END_DOB_YEAR', '-14y');

defined('FORM_OPEN_DATE') or define('FORM_OPEN_DATE', '2020-09-17');
defined('FORM_CLOSE_DATE') or define('FORM_CLOSE_DATE', '2020-12-12');

/*COUNSELLOR*/
defined('COUNSELLOR_ROLE_ID') or define('COUNSELLOR_ROLE_ID', 2);
defined('COUNSELLOR_NAME') or define('COUNSELLOR_NAME', 'Counsellor');
defined('ADMIN_NAME') or define('ADMIN_NAME', 'Admin');
defined('COUNSELLOR_LOGIN_USERNAME') or define('COUNSELLOR_LOGIN_USERNAME', 'counsellor');
defined('COUNSELLOR_LOGIN_PWD') or define('COUNSELLOR_LOGIN_PWD', 'Srm@123');