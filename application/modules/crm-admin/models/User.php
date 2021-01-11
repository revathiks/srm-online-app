<?php
if ( !defined ( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class User extends CI_Model
{
    protected $cacheKeys = array ();

    /**
     * User constructor.
     */
    public function __construct ()
    {
        parent::__construct ();
        // Load the database library
        

        $this->load->database ();
        //$db2_config = $this->config->item('pgsql');
        //$this->db = $this->load->database ($db2_config,TRUE);
        // $this->userTbl = 'users';
        $this->userTbl = 'users';
        $this->db->simple_query ( 'SET search_path TO usermanagement,public' );
        $this->load->driver ( 'cache' );
    }
    /*
     * Get rows from the users table
     */
    /**
     * @param bool $table
     * @param bool $prefix
     * @param bool $columns
     * @param array $params
     * @return bool
     */
    function getRows ($table = false , $prefix = false , $columns = false , $params = array ())
    {
        if ( !$table ) {
            $table = $this->userTbl;
        }
        // get cache values
        if ( is_array ( $params ) && array_key_exists ( "id" , $params ) ) {
            // $result = $this->get_cache($table.'id');
            $this->delete_cache ( $table );
            $result = $this->get_cache_by_conditions ( $table , 'id' , $params );
        }
        else {
            if ( is_array ( $params ) && array_key_exists ( "returnType" , $params ) && $params[ 'returnType' ] == 'count' ) {
                // $result = $this->get_cache($table.'count');
                $result = $this->get_cache_by_conditions ( $table , 'count' , $params );
            }
            elseif ( is_array ( $params ) && array_key_exists ( "returnType" , $params ) && $params[ 'returnType' ] == 'single' ) {
                // $result = $this->get_cache($table.'single');
                $result = $this->get_cache_by_conditions ( $table , 'single' , $params );
            }
            else {
                 $result = $this->get_cache($table.'array');
                //$result = $this->get_cache_by_conditions ( $table , 'array' , $params );
            }
        }
        // check cache value
        if ( $result !== false && $result !== '' ) {
        }
        else {
            if ( !$columns ) {
                $columns = '*';
            }
            $this->db->select ( $columns , FALSE );
            $this->db->from ( $table );
            //fetch data by conditions
            if ( is_array ( $params ) && array_key_exists ( "conditions" , $params ) ) {
                if ( !empty( $params[ 'conditions' ] ) ) {
                    foreach ($params[ 'conditions' ] as $key => $value) {
                        $this->db->where ( $key , $value );
                    }
                }
            }
            if ( is_array ( $params ) && array_key_exists ( "joins" , $params ) ) {
                if ( !empty( $params[ 'joins' ] ) ) {
                    foreach ($params[ 'joins' ] as $key => $value) {
                        $this->db->join ( $key , $value );
                    }
                }
            }
            $columnsss = explode ( ',' , $columns );
            $searchcol = preg_replace ( '/ as.*/' , '' , $columnsss );
            //filter data by searched keywords
            if ( is_array ( $params ) && !empty( $params[ 'search' ][ 'keywords' ] ) ) {
                foreach ($searchcol as $key => $value) {
                    $value = trim ( $value );
                    if ( is_array ( $params[ 'search' ][ 'keywords' ] ) && array_key_exists ( $value , $params[ 'search' ][ 'keywords' ] ) ) {
                        $this->db->or_like ( $value , $params[ 'search' ][ 'keywords' ][ $value ] );
                    }
                }
                // $this->db->like($prefix.'name',$params['search']['keywords']);
            }
            //sort data by ascending or desceding order
            if ( is_array ( $params ) && !empty( $params[ 'search' ][ 'sortBy' ] ) && !empty( $params[ 'search' ][ 'sortOrder' ] ) ) {
                $this->db->order_by ( $params[ 'search' ][ 'sortBy' ] , $params[ 'search' ][ 'sortOrder' ] );
            }
            elseif ( is_array ( $params ) && array_key_exists ( "returnType" , $params ) && $params[ 'returnType' ] != 'single' && $params[ 'returnType' ] != 'count' ) {
                $this->db->order_by ( $prefix . 'id' , 'desc' );
            }
            if ( is_array ( $params ) && array_key_exists ( "id" , $params ) ) {
                $this->db->where ( $prefix . 'id' , $params[ $prefix . 'id' ] );
                $query = $this->db->get ();
                $result = $query->row_array ();
                $this->save_cache_by_conditions ( $table , 'id' , $result , $params );
            }
            else {
                //set start and limit
                if ( is_array ( $params ) && array_key_exists ( "start" , $params ) && array_key_exists ( "limit" , $params ) ) {
                    $this->db->limit ( $params[ 'limit' ] , $params[ 'start' ] );
                }
                elseif ( is_array ( $params ) && !array_key_exists ( "start" , $params ) && array_key_exists ( "limit" , $params ) ) {
                    $this->db->limit ( $params[ 'limit' ] );
                }
                if ( is_array ( $params ) && array_key_exists ( "returnType" , $params ) && $params[ 'returnType' ] == 'count' ) {
                    $result = $this->db->count_all_results ();
                    // cache save
                    $this->save_cache_by_conditions ( $table , 'count' , $result , $params );
                }
                elseif ( is_array ( $params ) && array_key_exists ( "returnType" , $params ) && $params[ 'returnType' ] == 'single' ) {
                    $query = $this->db->get ();
                    $result = ($query->num_rows () > 0) ? $query->row_array () : false;
                    // cache save
                    $this->save_cache_by_conditions ( $table , 'single' , $result , $params );
                }
                else {
                    $query = $this->db->get ();
                    $result = ($query->num_rows () > 0) ? $query->result_array () : false;
                    // cache save
                    $this->save_cache_by_conditions ( $table , 'array' , $result , $params );
                }
            }
        }

        //return fetched data
        return $result;
    }
    /*
     * Insert user data
     */
    /**
     * @param $table
     * @param $tablePrefix
     * @param array $data
     * @return bool
     */
    public function common_insert ($table , $tablePrefix , $data = array ())
    {
        //add created and modified date if not exists
        if ( !array_key_exists ( $tablePrefix . "created_at" , $data ) ) {
            $data[ $tablePrefix . "created_at" ] = date ( "Y-m-d H:i:s" );
        }
        if ( !array_key_exists ( $tablePrefix . "modified_at" , $data ) ) {
            $data[ $tablePrefix . 'modified_at' ] = date ( "Y-m-d H:i:s" );
        }
        $this->db->insert ( $table , $data );// common insert function
        $res = $this->db->affected_rows () == 1 ? true : false;
        if ( $res === true ) {
            $this->delete_cache ( $table );
        }
        return $res;
    }
    /*
     * Update user data
     */
    /**
     * @param $table
     * @param $tablePrefix
     * @param array $data
     * @param array $where
     * @return bool
     */
    public function common_update ($table , $tablePrefix , $data = array () , $where = array ())
    {
        if ( !array_key_exists ( $tablePrefix . "modified_at" , $data ) ) {
            $data[ $tablePrefix . 'modified_at' ] = date ( "Y-m-d H:i:s" );
        }
        $this->db->where ( $where );
        $this->db->update ( $table , $data );
        $res = $this->db->affected_rows () == 1 ? true : false;
        if ( $res === true ) {
            $this->delete_cache ( $table );
        }
        return $res;
    }
    /*
     * Delete user data
     */
    /**
     * @param $table
     * @param array $where
     * @return bool
     */
    public function common_delete ($table , $where = array ())
    {
        $key = array_keys ( $where );
        $value = array_values ( $where );
        $value = array_filter ( $value );
        $delete = false;
        if ( !empty( $value ) ) {
            $this->db->where_in ( $key[ 0 ] , $value[ 0 ] );
            $delete = $this->db->delete ( $table );
            //echo $this->db->last_query();die;
        }
        //return the status
        $res = $delete ? true : false;
        if ( $res === true ) {
            $this->delete_cache ( $table );
        }
        return $res;
    }

    /**
     * @param $table
     * @param array $where
     * @param $format
     * @param $fileName
     * @param $columns
     * @return bool|string
     */
    public function common_export ($table , $where = array () , $format , $fileName , $columns)
    {
        $this->load->dbutil ();
        $strWhere = '';
        if ( !empty( $where ) ) {
            $strWhere = implode ( ' AND ' , $where );
        }
        $this->db->query ( "SET @cnt = 0" );
        $query = $this->db->query ( "SELECT (@cnt := if(@cnt IS NULL, 0,  @cnt) + 1) AS `S_no`, $columns FROM $table WHERE $strWhere" );
        if ( $format == 'xml' ) {
            $element = str_replace ( 'export' , '' , $fileName );
            $root = $element . 's';
            $config = array (
                'root' => $root ,
                'element' => $element ,
                'newline' => "\n" ,
                'tab' => "\t"
            );
            $backup = $this->dbutil->xml_from_result ( $query , $config );
        }
        if ( $format == 'csv' ) {
            $delimiter = ",";
            $newline = "\r\n";
            $enclosure = '"';
            $backup = $this->dbutil->csv_from_result ( $query , $delimiter , $newline , $enclosure );
        }
        // $this->load->helper('directory');
        $date = date ( 'Y-m-d' );
        $uploads = FCPATH . 'uploads/';
        $site_url = site_url ( 'uploads/' );
        if ( !is_dir ( $uploads ) ) {
            mkdir ( $uploads , 0777 , TRUE );
        }
        $uploads .= $date . '/';
        $site_url .= $date . '/';
        if ( !is_dir ( $uploads ) ) {
            mkdir ( $uploads , 0777 , TRUE );
        }
        $fileName = $fileName . '_' . time ();
        // Load the file helper and write the file to your server
        $this->load->helper ( 'file' );
        $filepath = $uploads . $fileName . '.' . $format;
        // echo 'filepath => '.$filepath;
        // die;
        write_file ( $filepath , $backup );
        $fileUrl = $site_url . $fileName . '.' . $format;
        if ( file_exists ( $filepath ) ) {
            // Load the download helper and send the file to your desktop
            // $this->load->helper('download');
            // force_download($filepath, $backup);
            return $fileUrl;
        }
        else {
            return false;
        }
    }

    protected function check_cache_support ()
    {
        $support = '';
        try {
            if ( is_object ( $this->cache ) ) {
                $support = $this->cache->is_supported ( 'redis' );
                log_message ( 'info' , 'redis connection was established' );
            }
        } catch (Exception $e) {
            log_message ( 'error' , 'Cache: not available (' . $e->getMessage () . ')' );
        } catch (RedisException $e) {
            log_message ( 'error' , 'Cache: redis connection was not established (' . $e->getMessage () . ')' );
        }
        return $support;
    }

    protected function get_cache ($table)
    {
        $data = '';
        if ( $this->check_cache_support () !== '' && $this->check_cache_support () !== false ) {
            $data = $this->cache->redis->get ( $table );
        }
        return $data;
    }

    protected function save_cache ($table , $data)
    {
        $cdata = '';
        if ( $this->check_cache_support () !== '' && $this->check_cache_support () !== false ) {
            $cdata = $this->cache->redis->save ( $table , $data , CACHE_EXPIRE_TIME );
        }
        return $cdata;
    }

    protected function delete_cache ($table)
    {
        $data = '';
        if ( $this->check_cache_support () !== '' && $this->check_cache_support () !== false ) {
            if ( is_array ( $this->cacheKeys ) ) {
                if ( count ( $this->cacheKeys ) ) {
                    foreach ($this->cacheKeys as $k => $v) {
                        if ( strpos ( $v , $table ) !== false ) {
                            $data = $this->cache->redis->delete ( $v );
                            unset( $this->cacheKeys[ $k ] );
                        }
                    }
                }
            }
            /*$data = $this->cache->redis->delete($table.'id');
            $data = $this->cache->redis->delete($table.'count');
            $data = $this->cache->redis->delete($table.'single');
            $data = $this->cache->redis->delete($table.'array');*/
        }
        return $data;
    }

    protected function save_cache_by_conditions ($table , $type , $result , $params = false)
    {
        if ( !empty( $params ) ) {
            foreach ($params as $key => $value) {
                if ( $key == 'search' && $key != 'conditions' ) {
                    foreach ($value as $ikey => $ivalue) {
                        if ( $ikey == 'keywords' ) {
                            $arrValue = array_values ( $ivalue );
                            $ivalue = $arrValue[ 0 ];
                        }
                        // cache save
                        $cacheKey1 = $table . $type . $key . $ikey . $ivalue;
                        $this->cacheKeys[] = $cacheKey1;
                        $this->save_cache ( $cacheKey1 , $result );
                    }
                }
                else if ( $key != 'search' && $key != 'conditions' && $key != 'joins' ) {
                    $cacheKey2 = $table . $type . $key . $value;
                    $this->cacheKeys[] = $cacheKey2;
                    $this->save_cache ( $cacheKey2 , $result );
                }
                else {
                    $cacheKey3 = $table . $type . $key;
                    $this->cacheKeys[] = $cacheKey3;
                    $this->save_cache ( $cacheKey3 , $result );
                }
            }
        }
        else {
            $cacheKey4 = $table . $type;
            $this->cacheKeys[] = $cacheKey4;
            $this->save_cache ( $cacheKey4 , $result );
        }
    }

    protected function get_cache_by_conditions ($table , $type , $params = false)
    {
        $params = array_filter ( $params );
        $result = '';
        if ( !empty( $params ) ) {
            foreach ($params as $key => $value) {
                if ( $key == 'search' || $key == 'conditions' ) {
                    foreach ($value as $ikey => $ivalue) {
                        if ( $ikey == 'keywords' ) {
                            $arrValue = array_values ( $ivalue );
                            $ivalue = $arrValue[ 0 ];
                        }
                        $cacheKey1 = $table . $type . $key . $ikey . $ivalue;
                        $result = $this->get_cache ( $cacheKey1 );
                        if ( $result !== '' && $result !== false ) {
                            break;
                        }
                        else {
                            $result = '';
                        }
                    }
                }
                else if ( ($key == 'limit' && $key == 'start') ) {
                    $cacheKey2 = $table . $type . $key . $value;
                    $result = $this->get_cache ( $cacheKey2 );
                    if ( $result !== '' && $result !== false ) {
                        break;
                    }
                    else {
                        $result = '';
                    }
                }
                else {
                    $cacheKey4 = $table . $type . $key;
                    $result = $this->get_cache ( $cacheKey4 );
                    if ( $result !== '' && $result !== false ) {
                        break;
                    }
                    else {
                        $result = '';
                    }
                }
            }
        }
        else {
            $cacheKey = $table . $type;
            $result = $this->get_cache ( $cacheKey );
        }
        return $result;
    }
}