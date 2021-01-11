<?php defined ( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Api_auth
{
    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function login ($username , $password)
    {
        if ( $username == 'admin' && $password == '1234' ) {
            return true;
        }
        else {
            return false;
        }
    }
}