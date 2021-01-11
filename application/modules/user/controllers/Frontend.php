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

class Frontend extends FrontendController
{
	public $CI;

	public function __construct()
    {
        //
        parent::__construct();
        // This function returns the main CodeIgniter object.
        // Normally, to call any of the available CodeIgniter object or pre defined library classes then you need to declare.
        $CI =& get_instance();
    }

    public function index()
    {
        $this->is_exists_main_cookie();
    	echo 'frontend';
    	die;
    }

    public function is_exists_main_cookie() {
        // if($this->input->cookie('lockscreen',true) && $this->session->tempdata('lockscreen')) {
        if($this->session->tempdata('lockscreen')) {
            return true;
        } else {
            redirect('lockscreen', 'refresh');
        }
    }
}