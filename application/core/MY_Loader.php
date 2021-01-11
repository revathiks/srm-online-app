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

/* load the MX_Loader class */
require APPPATH."third_party/MX/Loader.php";

class MY_Loader extends MX_Loader
{
    //
    public $CI;

    /**
     * An array of variables to be passed through to the
     * view, layout,....
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

        // This function returns the main CodeIgniter object.
        // Normally, to call any of the available CodeIgniter object or pre defined library classes then you need to declare.
        $CI =& get_instance();
        //$CI->load->model('Common_model');        
    }


    /*
    |--------------------------------------------------------------------------
    | Loader Class
    |--------------------------------------------------------------------------
    |
    | This class extends CI_loader class, the core class of the system.
    */

    /**
     * Database Loader
     *
     * @param   mixed   $params     Database configuration options
     * @param   bool    $return     Whether to return the database object
     * @param   bool    $query_builder  Whether to enable Query Builder
     *                  (overrides the configuration setting)
     *
     * @return  object|bool Database object if $return is set to TRUE,
     *                  FALSE on failure, CI_Loader instance in any other case
     *
     */
    public function database($params = '', $return = FALSE, $query_builder = NULL)
    {
        // Grab the super object
        $CI =& get_instance();

        // Do we even need to load the database class?
        if ($return === FALSE && $query_builder === NULL && isset($CI->db) && is_object($CI->db) && ! empty($CI->db->conn_id))
        {
            return FALSE;
        }

        require_once(BASEPATH.'database/DB.php');        
        //$this->db->query("ALTER SESSION SET CURRENT_SCHEMA = my_schema");
        // Load the DB class
        $db =& DB($params, $query_builder);

        $my_driver = config_item('subclass_prefix') . 'DB_' . $db->dbdriver . '_driver';

        $my_driver_file = APPPATH . 'core/' . $my_driver . '.php';


        if (file_exists($my_driver_file)) {
            require_once($my_driver_file);
            
            $db = new $my_driver(get_object_vars($db));
        }

        if ($return === TRUE) {
            return $db;
        }

        // Initialize the db variable. Needed to prevent
        // reference errors with some configurations
        $CI->db = '';
        $CI->db = $db;
       

        //$this->_ci_assign_to_models();
        //$this->ci->load->model('Common')->get_rows();
        //include(APPPATH . 'models/' . $model_name . '.php');
        return $this;
    }

    /*public function view($view, $vars = array(), $return = FALSE)
    {

        foreach (array('_ci_view', '_ci_vars', '_ci_path', '_ci_return') as $_ci_val)
        {
            $$_ci_val = isset($_ci_data[$_ci_val]) ? $_ci_data[$_ci_val] : FALSE;
        }

        $file_exists = FALSE;

        // Set the path to the requested file
        if (is_string($_ci_path) && $_ci_path !== '')
        {
            $_ci_x = explode('/', $_ci_path);
            $_ci_file = end($_ci_x);
        }
        else
        {
            $_ci_ext = pathinfo($_ci_view, PATHINFO_EXTENSION);
            $_ci_file = ($_ci_ext === '') ? $_ci_view.'.php' : $_ci_view;

            foreach ($this->_ci_view_paths as $_ci_view_file => $cascade)
            {
                if (file_exists($_ci_view_file.$_ci_file))
                {
                    $_ci_path = $_ci_view_file.$_ci_file;
                    $file_exists = TRUE;
                    break;
                }

                if ( ! $cascade)
                {
                    break;
                }
            }
        }

        if ( ! $file_exists && ! file_exists($_ci_path))
        {
            throw new Exception('View file '.$view.' doesn\'t exist.');
        }
        return $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => $this->_ci_prepare_view_vars($vars), '_ci_return' => $return));
    }*/

   




}
