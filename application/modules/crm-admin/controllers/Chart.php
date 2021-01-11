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

class Chart extends BackendController
{
	public $CI;

	public function __construct()
    {
        //
        parent::__construct();
        // This function returns the main CodeIgniter object.
        // Normally, to call any of the available CodeIgniter object or pre defined library classes then you need to declare.
        $CI =& get_instance();
		$this->load->helper('security');
		// Load model
		$this->load->model('User_model');
    }

     /**
     * Index page
     *
     * @param username , password
     * @return json response of user details have or not
     * @author
     */
     public function index()
     {
        
     }
     public function form_applications()
     {
         $this->is_exists_user_logged();
         $this->data['site_title'] = $this->data['page_title'] = 'Form Vs Applications';
         $this->template('charts\form_app', $this->data, true);
     }
     public function demo2()
     {
         $this->is_exists_user_logged();
         $this->data['site_title'] = $this->data['page_title'] = 'State Vs Applications';
         $this->template('charts\demo2', $this->data, true);
     }
     public function demo3()
     {
         $this->is_exists_user_logged();
         $this->data['site_title'] = $this->data['page_title'] = 'Counseller Wise Lead Applications';
         $this->template('charts\bar_chart', $this->data, true);
     }
     public function demo4()
     {
         $this->is_exists_user_logged();
         $this->data['site_title'] = $this->data['page_title'] = 'Lead Engagement Chart';
         $this->template('charts\bar_line_chart', $this->data, true);
     }
     public function demo5()
     {
         $this->is_exists_user_logged();
         $this->data['site_title'] = $this->data['page_title'] = 'Leads Chart';
         $this->template('charts\doughnut_chart', $this->data, true);
     }
 }