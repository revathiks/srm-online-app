<?php
if ( !defined ( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/*
* @Author           : Prabaharan.S.
* @Created Date     : 19/06/2019
* @Version          : 0.1
* @Description      : Common model for insert/update/delete/select
* Model Name        : Common.php
*/
class Common extends CI_Model
{

public $otherdb;

    /**
     * Common constructor.
     */
    public function __construct ()
    {
        parent::__construct ();

        // Load the database library
        $this->load->database();
        //$otherdb = $this->load->database('another_db', TRUE);
        //$this->otherdb = $this->load->database('another_db', TRUE);
        
        $this->user_tbl = 'users';
    }

    /*
     * Get rows from the table
     */
    /**
     * @param bool $table
     * @param bool $prefix
     * @param bool $columns
     * @param array $params
     * @return bool
     */
    function get_rows($table = false, $prefix = false, $columns = false, $params = array()){
        if(!$table) {
            $table = $this->user_tbl;
        }
        /*echo '<pre>';
        print_r($params);
        echo '</pre>';
        die;*/
        /* unique dropdown for filters start */
        $is_unique = false;
        
        //Group by
        if(is_array($params) && !empty($params['group']))
        {
            $params['group'] = preg_replace('/ as.*/', '', $params['group']);
            $this->db->group_by($params['group']); 
        }

        //Distinct
        if(is_array($params) && !empty($params['distinct']))
        {
           $this->db->distinct($params['distinct']); 
           $is_unique = true;
        }
        /* unique dropdown for filters end */
        if($is_unique == false) {
            if ( !$columns ) {
                $columns = '*';
            } else {
                //$this->db->query('SET @count:=0');
                //$columns = '(@count:=@count+1) AS serial_number, '.$columns;    
            }
        }

        $this->db->select ( $columns , FALSE );
        $this->db->from ( $table );
        
        //fetch data by conditions
        if ( is_array ( $params ) && array_key_exists ( "conditions" , $params ) ) {	
            if ( !empty( $params[ 'conditions' ] ) ) {
                foreach ($params[ 'conditions' ] as $key => $value) {
                    // echo '$key => '.$key."\n";
                    if(!is_numeric($key)) {
                        if($key != 'where_not_in' && $key != 'or_not_like' && $key != 'not_like' && $key != 'where_in') {
                            $this->db->where ( $key , $value );
                        } else if($key == 'where_in') {
                            if($value) {
                                foreach($value as $k=>$v) {
                                    $this->db->where_in ( $k , $v );
                                }
                            }
                        } else if($key == 'where_not_in') {
                            if($value) {
                                $value_or = false;
                                if(array_key_exists('or', $value)) {
                                    $this->db->group_start();
                                    $value_or = $value['or'];
                                    unset($value['or']);
                                }
                                foreach($value as $k=>$v) {
                                    $this->db->where_not_in ( $k , $v );
                                }
                                if($value_or) {
                                    $this->db->or_where ( $value_or );
                                    $this->db->group_end();
                                }
                            }
                        } else if($key == 'or_not_like') {
                            if($value) {
                                $this->db->group_start();
                                foreach($value as $k=>$v) {
                                    if(is_array($v)) {
                                        foreach($v as $k1=>$v1) {
                                            if(is_array($v1)) {
                                                foreach($v1 as $k2=>$v2) {
                                                    if ( is_array ( $params ) && array_key_exists ( "or_not_like" , $params ) ) {
                                                        if ( !empty( $params[ 'or_not_like' ] ) ) {
                                                            if($params[ 'or_not_like' ] == 'date') {
                                                                $this->db->or_not_like ( 'DATE_FORMAT('.$k.', "'.$k1.'")', $v2 );
                                                            }
                                                        } else {
                                                            $this->db->or_not_like ( $k , $v2 );
                                                        }
                                                    }
                                                }
                                            } else {
                                                $this->db->or_not_like ( $k , $v1 );
                                            }
                                        }
                                    } else {
                                        $this->db->or_not_like ( $k , $v );
                                    }
                                }
                                $this->db->group_end();
                            }
                        } else if($key == 'not_like') {
                            if($value) {
                                $this->db->group_start();
                                $value_or = false;
                                if(array_key_exists('or', $value)) {
                                    $value_or = $value['or'];
                                    unset($value['or']);
                                }
                                foreach($value as $k=>$v) {
                                    if(is_array($v)) {
                                        foreach($v as $k1=>$v1) {
                                            if(is_array($v1)) {
                                                foreach($v1 as $k2=>$v2) {
                                                    if ( is_array ( $params ) && array_key_exists ( "not_like" , $params ) ) {
                                                        if ( !empty( $params[ 'not_like' ] ) ) {
                                                            if($params[ 'not_like' ] == 'date') {
                                                                $this->db->not_like ( 'DATE_FORMAT('.$k.', "'.$k1.'")', $v2 );
                                                            }
                                                        } else {
                                                            $this->db->not_like ( $k , $v2 );
                                                        }
                                                    }
                                                }
                                            } else {
                                                $this->db->not_like ( $k , $v1 );
                                            }
                                        }
                                    } else {
                                        $this->db->not_like ( $k , $v );
                                    }
                                }
                                if($value_or) {
                                    $this->db->or_where ( $value_or );
                                }
                                $this->db->group_end();
                            }
                        } else {
                            $this->db->where ( $value );
                        }
                    } else {
                        $this->db->where ( $value );
                    }
                }
            }
        }

        if ( is_array ( $params ) && array_key_exists ( "joins" , $params ) ) {
            if ( !empty( $params[ 'joins' ] ) ) {
                foreach ($params[ 'joins' ] as $key => $value) {
                    $this->db->join ( $value['table'] , $value['condition'] ,$value['jointype'] );
                }
            }
        }

        if(is_array($params) && !empty($params['in_cond']))
        {
             foreach($params['in_cond'] as $key => $value){
                    if(!is_numeric($key)) {
                        $this->db->where_in($key,$value);
                    } else {
                        $this->db->where($value);
                    }
                }
        }
        
        if(strpos($columns, 'CONCAT') !== false) {
            $columns = str_replace('CONCAT', '', $columns);
            $columns = str_replace(')', '', $columns);
            $columns = str_replace('(', '', $columns);
            $columns = str_replace('," ",', ',', $columns);
            // $res_matches = preg_match_all('/[CONCAT\(.*\)]+/', $columns, $matches );
        }
        
        $columnsss = (strpos($columns, ',') !== false)?explode(',', $columns):'';
        $searchcol = preg_replace('/ as.*/', '', $columnsss);
        //filter data by searched keywords
		if ( is_array ( $params ) && !empty( $params[ 'search' ][ 'keywords' ] ) ) {
            $this->db->group_start();
            foreach ($searchcol as $key => $value) {
                $value = trim ( $value );
                if ( is_array ( $params[ 'search' ][ 'keywords' ] ) && array_key_exists ( $value , $params[ 'search' ][ 'keywords' ] ) ) {
                    //$this->db->or_like ( $value , $params[ 'search' ][ 'keywords' ][ $value ] );
                    $this->db->or_like ( 'LOWER(CAST('.$value.' as TEXT))'  , strtolower($params[ 'search' ][ 'keywords' ][ $value ]) );
                }
            }

            // $this->db->or_like ( $value , $params[ 'search' ][ 'keywords' ][ $value ] );
            $this->db->group_end();
        }

        //sort data by ascending or desceding order
		if ( is_array ( $params ) && !empty( $params[ 'search' ][ 'sort_by' ] ) && !empty( $params[ 'search' ][ 'sort_order' ] ) && !( $params[ 'search' ][ 'sort_condition' ] ) ) {
            $this->db->order_by ( $params[ 'search' ][ 'sort_by' ], $params[ 'search' ][ 'sort_condition' ] );
        }
        else if ( is_array ( $params ) && !empty( $params[ 'search' ][ 'sort_by' ] ) && !empty( $params[ 'search' ][ 'sort_order' ] ) && ( $params[ 'search' ][ 'sort_condition' ] ) ) {
            $this->db->order_by ( $params[ 'search' ][ 'sort_by' ] , $params[ 'search' ][ 'sort_order' ], $params[ 'search' ][ 'sort_condition' ] );
        }
        else {
            $this->db->order_by ( $params[ 'pk' ] , 'desc' );
        } 
        
        if ( is_array ( $params ) && array_key_exists ( "id" , $params ) ) {
            $this->db->where ( $prefix . 'id' , $params[ $prefix . 'id' ] );
            $query = $this->db->get ();
            $result = $query->row_array ();
        }
        else {
            //set start and limit
            if(is_array($params) && array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(is_array($params) && !array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            
            if(is_array($params) && array_key_exists("return_type",$params) && $params['return_type'] == 'count'){
                $result = $this->db->count_all_results();    
            }elseif(is_array($params) && array_key_exists("return_type",$params) && $params['return_type'] == 'single'){
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->row_array():false;
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():false;
            }
        }
		//print_r($this->db->last_query());
		//exit;
		//  return fetched data
        return $result;
    }

    /*
     * Insert data
     */

    /**
     * @param $table
     * @param $table_prefix
     * @param array $data
     * @return bool
     */
    public function common_insert($table, $table_prefix, $data = array()) {
        //add created and modified date if not exists
        if(!array_key_exists($table_prefix."created_at", $data)){
                $data[$table_prefix."created_at"] = date("Y-m-d H:i:s");
            }
        /*if(!array_key_exists($table_prefix."modified_at", $data)){
        $data[$table_prefix.'modified_at'] = date("Y-m-d H:i:s");
        }*/
        $table_pk_id = $data['table_pk_id'];
        unset($data['table_pk_id']);

        $table_schema = $data['table_schema'];
        unset($data['table_schema']);

        $this->set_schema($table_schema);

        $this->db->insert ( $table , $data );// common insert function 
        // echo 'insert_string => '.$this->db->insert_string($table , $data)."\n";
        if($table_pk_id) {
            $id = $this->db->insert_id($table_schema.'.'.$table."_".$table_pk_id.'_seq');
        } else {
            $id = $this->db->insert_id();
        }
        return $this->db->affected_rows () == 1 ? $id : false;
    }

    public function _get_last_insert_id($table_schema, $table, $table_pk_id) {
        return $this->db->insert_id($table_schema.'.'.$table."_".$table_pk_id.'_seq');
    }

    /*
     * Update data
     */
    /**
     * @param $table
     * @param $table_prefix
     * @param array $data
     * @param array $where
     * @return bool
     */
    public function common_update($table, $table_prefix, $data = array(), $where = array() )
    {
        $this->db->trans_start();

        if(!array_key_exists($table_prefix."modified_at", $data)){
        $data[$table_prefix.'updated_at'] = date("Y-m-d H:i:s");
        }
        if(array_key_exists("where_in", $data) === true) {
            $where_col = array_keys($where);
            $where_val = array_values($where);
            $this->db->where_in($where_col[0], $where_val[0]);
            unset($data['where_in']);    
        } else {
            $this->db->where ( $where );    
        }

        $table_schema = $data['table_schema'];
        unset($data['table_schema']);

        $this->set_schema($table_schema);

        $this->db->update ( $table , $data );
        // echo 'update_string => '.$this->db->update_string($table , $data, $where)."\n";
		 // print_r($this->db->last_query());
		//exit;

         //store the affected_row value here
        $affectedRows=$this->db->affected_rows();

        $this->db->trans_complete();     

        if ($this->db->trans_status() === FALSE) {
            return true;
        } else if ($this->db->trans_status() === TRUE) {
            //recall the stored value here
            if($affectedRows > 0 ) {
                return true;
            } else {
                return false;
            }
        }
    }


    /*
     * Delete data
     */

    /**
     * @param $table
     * @param array $where
     * @return bool
     */
    public function common_delete ($table , $where = array ())
    {
        $table_schema = $where['table_schema'];
        unset($where['table_schema']);

        $key = array_keys ( $where );
        $value = array_values ( $where );
        $value = array_filter ( $value );

        $delete = false;
        if ( !empty( $value ) ) {
            $this->db->where_in ( $key[ 0 ] , $value[ 0 ] );
            $this->set_schema($table_schema);
            $delete = $this->db->delete ( $table );
        }
				// print_r($this->db->last_query());
		//exit;
        //return the status
        return $delete ? true : false;
    }
	
	/**
     * @param $table
     * @param array $where
     * @return bool
     */
    public function common_delete_new ($table , $where = array ())
    {
        $delete = false;
        if ( !empty( $where ) ) {
            $table_schema = $where['table_schema'];
            unset($where['table_schema']);
            $this->db->where ( $where );
            $this->set_schema($table_schema);
            $delete = $this->db->delete ( $table );
        }
				// print_r($this->db->last_query());
		//exit;
        //return the status
        return $delete ? true : false;
    }

    /**
     * @param $table
     * @param array $where
     * @param $format
     * @param $file_name
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

        
        if($format == 'xml') {
            $element = str_replace('export','',$file_name);
            $root = $element.'s';
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
        $this->load->helper('file');
        $filepath = $uploads.$file_name.'.'.$format;

        write_file($filepath, $backup);
        $fileUrl = $site_url.$file_name.'.'.$format;
        if(file_exists($filepath)) {
            // Load the download helper and send the file to your desktop
            // $this->load->helper('download');
            // force_download($filepath, $backup);
            return $fileUrl;
        }
        else {
            return false;
        }
    }

    protected function set_schema($table_schema) {
        if(!$table_schema) {
            return false;
        }
        if($this->db->dbdriver == 'postgre' && $table_schema) {
            $this->db->simple_query('SET search_path TO ' . $table_schema . ',public');
        }    
    }

    public function db_func_call_old($table_schema, $db_func_name, $id) {
        if(is_array($id)) {
            $id = array_values($id);
            // $id = array_filter($id);
            $ids = '';
            foreach($id as $k=>$v) {
                if(!$v) {
                    $v = 'null';
                }
                $ids .= $v;
                if(array_key_last($id) > $k) {
                    $ids .= ',';
                }
            }
            // $id = implode(',', $id);
            // $id=implode(", ",array_filter($id,create_function('$v','return !is_null($v);')));

        } else {
            $ids = $id;
        }
        $sql = 'select * from '.$table_schema.'.'.$db_func_name.'('.$ids.')';
        $query = $this->db->query($sql);
        $result = ($query->num_rows() > 0)?$query->result_array():false;
        return $result;
    }

     public function db_func_call($table_schema, $db_func_name, $id, $columns = false, $sort_by = false, $sort_order = false, $arr_param_where = array()) {
        if(is_array($id)) {
            $id = array_values($id);
            // $id = array_filter($id);
            $ids = '';
            foreach($id as $k=>$v) {
                if(!$v) {
                    $v = 'null';
                }
                $ids .= $v;
                $keys = array_keys($id);
                $last = end($keys);

                if($last > $k) {
                    $ids .= ',';
                }


            }
            // $id = implode(',', $id);
            // $id=implode(", ",array_filter($id,create_function('$v','return !is_null($v);')));

        } else {
            $ids = $id;
        }

        $keywords=$this->input->post('keywords',true);
        $keywords=isset($keywords)?$keywords:'';
        $is_distinct=$this->input->post('is_distinct',true);
        $is_distinct=isset($is_distinct)?$is_distinct:'';
        $ecamp=$this->input->post('ecamp',true);
        $ecamp=isset($ecamp)?$ecamp:'';
        
        $fields="*";
        $columnval=array();
        $searchcol =array();
        $defaultcol =array();
        if(is_array($columns)) {
            foreach ($columns as $k => $col){
                $columnval[]=$col ." as ".$k;
                if($k!="id"){
                    $searchcol[]=" LOWER(".$col .") LIKE '%".$keywords."%'";
                    $defaultcol[]=" LOWER(".$col .") IS NOT NULL";
                }
                
            }
            $fields=implode(",", $columnval);
            $searchcols=implode(" AND", $searchcol);
            $defaultcols=implode(" AND", $defaultcol);
        }
        
        $where=$campusWhere=$keywordwhere=$order_by="";
       
        if(!empty($keywords) && $fields!="*" && !empty($searchcols)){
            $keywordwhere= " ".$searchcols;
        }
        if(!empty($ecamp)){
            $campusWhere= " campus_id NOT IN (".$ecamp.")";
        }

        $arr_where = array();
        if($arr_param_where) {
            foreach($arr_param_where as $k=>$v) {
                $arr_where[] = $k.' '.$v;
            }
        }
        
        if(!empty($defaultcols)){
            $arr_where[] = $defaultcols;
        }
        if(!empty($keywordwhere) || !empty($campusWhere)){
            $arr_where[] = $keywordwhere.$campusWhere;
        }
        if(count($arr_where) > 0) {
            $where = " WHERE ".implode(" AND ", $arr_where);
        }
        $distinct = '';
        if($is_distinct) {
            $distinct = ' DISTINCT ';    
        }

        //sort data by ascending or desceding order
        if ( $sort_by != false && $sort_order != false) {
            // $this->db->order_by ( $sort_by, $sort_order );
            $order_by = ' ORDER BY '.$sort_by.' '.$sort_order.' '; 
        }

        $sql = 'select '.$distinct.' '.$fields.' from '.$table_schema.'.'.$db_func_name.'('.$ids.')'. $where.$order_by;
        // echo '$sql => '.$sql."\n";
        $query = $this->db->query($sql);
        $result = ($query->num_rows() > 0)?$query->result_array():false;

        return $result;
    } 
	
	public function db_func_call_dde($table_schema,$db_func_name,$id,$col_one,$col_two) {
        if(is_array($id)) {
            $id = array_values($id);
            // $id = array_filter($id);
            $ids = '';
            foreach($id as $k=>$v) {
                if(!$v) {
                    $v = 'null';
                }
                $ids .= $v;
                if(array_key_last($id) > $k) {
                    $ids .= ',';
                }
            }
            // $id = implode(',', $id);
            // $id=implode(", ",array_filter($id,create_function('$v','return !is_null($v);')));

        } else {
            $ids = $id;
        }
        $sql = 'select distinct '.$col_one.' as id,'.$col_two.' as name from '.$table_schema.'.'.$db_func_name.'('.$ids.')';
        $query = $this->db->query($sql);
        $result = ($query->num_rows() > 0)?$query->result_array():false;
        return $result;
    }
    
    public function db_distinct_func_call($table_schema, $db_func_name, $arguments,$column) {
       //$params = 'null,null,null,null,null';
       $params = 'null,null,null,null';
        if(is_array($arguments)) {
            $args = array_values($arguments); 
            foreach($args as $k=>$v) {
                if(!$v) {
                    $v = 'null';
                }
                $param[]= $v;
            }
            if(!empty($param)){
                $params=implode(",",$param);
            }
            
        }
        
        $keywords=$_GET['keywords'];
        $keywords=isset($keywords)?$keywords:'';
        $ecamp=$_GET['ecamp'];
        $ecamp=isset($ecamp)?$ecamp:'';
        $ecourse=$_GET['ecourse'];
        $ecourse=isset($ecourse)?$ecourse:'';
        
        $fields="*";
        $columnval=array();
        $searchcol =array();
        if(is_array($column)) {
            foreach ($column as $k => $col){
                $columnval[]=$col ." as ".$k;
                if($k!="id"){
                 $searchcol[]=" lower(".$col .") like '%".$keywords."%'";
                }
            }
            $fields=implode(",", $columnval);
            $searchcols=implode(" AND", $searchcol);
        }
        
        $where=$campusWhere=$keywordwhere="";
       
        if(!empty($keywords) && $fields!="*" && !empty($searchcols)){
            $keywordwhere= " ".$searchcols;
        }
        if(!empty($ecamp)){
            $campusWhere= " campus_id not in (".$ecamp.")";
        }
        if(!empty($ecourse)){
            $courseWhere= " prog_id not in (".$ecourse.")";
        }
        if(!empty($keywordwhere) || !empty($campusWhere) || !empty($ecourse)){
            $where = " where ".$keywordwhere.$campusWhere.$courseWhere;
        }
        $sql = 'select distinct '.$fields.' from '.$table_schema.'.'.$db_func_name.'('.$params.')'.$where;
        $query = $this->db->query($sql);
        $result = ($query->num_rows() > 0)?$query->result_array():false;
        return $result;
        
    }
    
    //update application number
    public function update_appln_no($table_schema,$table,$seq,$applicant_appln_id,$applicant_personal_det_id) {
       if(!empty($seq) && !empty($applicant_appln_id) && !empty($applicant_personal_det_id))
       {
           $sql = "update ".$table_schema.".".$table." set appln_no= ".$seq." ,updated_at='".date('Y-m-d H:i:s')."' where applicant_personal_det_id=".$applicant_personal_det_id." and applicant_appln_id=".$applicant_appln_id;
           $query = $this->db->query($sql);
           $affectedRows=$this->db->affected_rows();        
            $this->db->trans_complete();        
            if ($this->db->trans_status() === FALSE) {
                return true;
            } else if ($this->db->trans_status() === TRUE) {
                //recall the stored value here
                if($affectedRows > 0 ) {
                    return true;
                } else {
                    return false;
                }
            }
       }
            
   }
}
