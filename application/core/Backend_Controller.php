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
 * @filesource
 * @todo       (description)
 *
 */

class BackendController extends MY_Controller
{
    //
    public $CI;

    /**
     * An array of variables to be passed through to the
     * view, layout, ....
     */
    protected $data = array();

    /**
     * [__construct description]
     *
     * @method __construct
     */
    public function __construct()
    {
        // To inherit directly the attributes of the parent class.
        parent::__construct();

        // CI profiler
        $this->output->enable_profiler(false);

        // This function returns the main CodeIgniter object.
        // Normally, to call any of the available CodeIgniter object or pre defined library classes then you need to declare.
        $CI =& get_instance();

        //Example data
        // Site name
        $this->data['sitename'] = 'CRM-ADMIN';

        //Example data
        // Browser tab
        $this->data['site_title'] = ucfirst('Admin Dashboard');
    }

   /**
     * Template loading function for AdminLTE
     *
     * @method template
     *
     * @param  string   $template_name The template name
     * @param  array    $data          All extra datas you want to display
     * @param  boolean  $return        Load the complete template structure
     *                                 with the menues, sidebar, ... or only the page template
     *
     * @return [type]                  Display the template
     */
    protected function template($template_name, $data, $return)
    {        
        
        if ($return === true){
            //$content  = $this->load->view('templates/header', $this->data);
            $sidebar = 'default';
            if(isset($this->data['sidebar'])) {
                if($this->data['sidebar']) {
                    $sidebar = $this->data['sidebar'];
                }
            }
            
            $this->data['body'] = $this->set_layout($sidebar);
            
            $content  = $this->load->view('templates/header_crm_login', $this->data);
            
            // echo 'body => '.$body;
            if($sidebar == 'login'){
                $content .= $this->load->view('templates/header_crm_login_inner_content', $this->data);
            } elseif($template_name == 'applications/form_preview'){
            }else {
                $content .= $this->load->view('templates/page_inner_content_header', $this->data);
            }
            $content .= $this->load->view($template_name, $this->data);

            if($sidebar == 'login'){
                $content .= $this->load->view('templates/page_inner_crm_footer_login', $this->data);    
            } else {
                $content .= $this->load->view('templates/app_page_inner_footer', $this->data);
                $content .= $this->load->view('templates/footer', $this->data);
            }
            $content .= $this->load->view('templates/inner_crm_footer_scripts_login', $this->data);
            if(isset($this->data['form_wizard'])) {
                if($this->data['form_wizard'] == true) {
                    $content .= $this->load->view('templates/wizard_scripts', $this->data);
                }
            }
            $current_module = $this->router->fetch_module();
            $script_file_path = APPPATH.'modules/'.$current_module.'/views/'.$template_name.'_scripts'.EXT;
            if(file_exists($script_file_path))
            {
                $content .= $this->load->view($template_name.'_scripts', $this->data);
            }
            $content .= $this->load->view('templates/footer_final', $this->data);
            return $content;
        }
        else {
            $this->load->view($template_name, $this->data);
        }
    }

    protected function set_layout($sidebar = null){
        $html = '';
        // echo 'sidebar =>'.$sidebar;
        switch ($sidebar) {
            case 'compact':
                $html = '<body data-sidebar="dark" data-sidebar-size="small">';
                break;
            case 'icon':
                $html = '<body data-sidebar="dark" data-keep-enlarged="true" class="vertical-collpsed">';
                break;
            case 'boxed':
                $html = '<body data-sidebar="dark" data-keep-enlarged="true" class="vertical-collpsed" data-layout-size="boxed">';
                break; 
            case 'login':
                $html = '<body class="account-pages">';
                break;        
            default:
                $html = '<body data-sidebar="dark">';
                break;
        }
        return $html;
    }
}
