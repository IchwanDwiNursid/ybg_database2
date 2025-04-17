<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('is_logged_in')) {
    function is_logged_in() {
        $CI =& get_instance(); // Mengambil instance CI saat ini
        $CI->load->library('session');
        return $CI->session->userdata('logged_in');
    }
}
