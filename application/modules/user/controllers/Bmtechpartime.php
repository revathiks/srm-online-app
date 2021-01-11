<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * CodeIgniter-HMVC-AdminLTE
 *
 * @package    CodeIgniter-HMVC-AdminLTE
 * @author     N3Cr0N (N3Cr0N@list.ru)
 * @copyright  2019 N3Cr0N
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @link       <URI> (description)
 * @version    GIT: $Id$
 * @since      Version 0.0.1
 * @todo       (description)
 *
 */

class Bmtechpartime extends FrontendController
{
	//
    public $CI;

    /**
     * An array of variables to be passed through to the
     * view, layouts, ....
     */
    protected $data = array();

    /**
     * [__construct description]
     *
     * @method __construct
     */
    public function __construct()
    {
        //
        parent::__construct();
        // This function returns the main CodeIgniter object.
        // Normally, to call any of the available CodeIgniter object or pre defined library classes then you need to declare.
        $CI =& get_instance();
        $this->load->helper('cookie');
		$this->application_year = date("Y");
		$this->user_details_data = $this->session->userdata('user_details_data');
    }
	
    public function bmtechpartime_form($view_type = false) {
   
		$this->is_exists_user_logged();
        $app_form_id = APP_FORM_ID_SHUG;
        $applicant_id = $this->user_details_data['user_details']['data'][0]['applicant_personal_det_id'];   
        $applicant_login_id=$this->user_details_data['user_details']['data'][0]['applicant_login_id'];
            $this->data['form_wizard'] = true;
            $this->data['sidebar'] = 'icon';
            $this->data['logged_applicant_id']=$applicant_id;
            $this->data['logged_applicant_login_id']=$applicant_login_id;
            $this->data['user_data'] = $this->user_details_data['user_details']['data'][0];
            $this->data['site_title'] = $this->data['page_title'] = 'B.Tech/M.Tech - Part Time Application Form';
            if($view_type == 'preview') {
                $this->data['site_title'] = $this->data['page_title'] = 'B.Tech/M.Tech - Part Time Application Form Preview';
                //$this->template('applications/form_btech_preview', $this->data, true);
				$this->template('applications/form_bmtechpartime', $this->data, true);    
            } else {
                //$this->template('applications/form_btech', $this->data, true);    
				$this->template('applications/form_bmtechpartime', $this->data, true);    
            }
		
            
        
    }

    public function get_resident_status() {
        parent::_get_resident_status(false, $this->is_admin);
    }		

   
    

}