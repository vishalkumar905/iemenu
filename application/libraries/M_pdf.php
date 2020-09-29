<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once APPPATH.'/third_party/mpdf/vendor/autoload.php';

class M_pdf {
    public function __construct() {
        $mpdf = new \Mpdf\Mpdf();
    }
}