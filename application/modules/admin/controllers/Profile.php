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

class Profile extends BackendController
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
    }
	
	public function do_upload_view()
    {	
		$this->data['session_userdata'] = $this->session_userdata();
		// Display page with the template function from REST_Controller
		$this->template('profile/upload', $this->data, true);	
	}

    /**
     * [index description]
     *
     * @method index
     *
     * @return [type] [description]
     */
    public function do_upload()
    {
        $this->is_exists_main_cookie();
		$upload = array();
		$config = array(
			UPLOAD_PATH => UPLOAD_PATH_VALUE,
			ALLOWED_TYPES => ALLOWED_TYPES_VALUE,
			OVERWRITE => OVERWRITE_VALUE,
			MAX_SIZE => MAX_SIZE_VALUE, // Can be set to particular file size , here it is 2 MB(2048 Kb)
			MAX_HEIGHT => MAX_HEIGHT_VALUE,
			MAX_WIDTH => MAX_WIDTH_VALUE,
		);

		$this->load->library('upload', $config);
		if($this->upload->do_upload('userfile'))
		{
			$data = array('upload_data' => $this->upload->data());
			$upload['upload_success_data'] = 'File Uploaded';
			$upload['upload_data'] = $data;
			echo json_encode($upload);
		}else{
			$this->data = array();
			$upload['upload_error_data'] ='Invalid Format Or File Not Uploaded';
			echo json_encode($upload);
		}
    }

    /**
     * [index description]
     *
     * @method index
     *
     * @return [type] [description]
     */
    public function index()
    {
        $this->is_exists_admin_logged();
        $this->data['title'] = 'Profile';
        // Display page with the template function from REST_Controller
        $this->template('profile/index', $this->data, true);
    }

    /**
     * [change_password description]
     *
     * @method change_password
     *
     * @return [type] [description]
     */
    public function change_password()
    {
        $this->is_exists_admin_logged();
        $this->data['title'] = 'Change Password';
        // Display page with the template function from REST_Controller
        $this->template('profile/change_password', $this->data, true);
    }
}
