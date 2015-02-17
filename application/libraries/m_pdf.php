<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class m_pdf {
    
    function m_pdf()
    {
        $CI = & get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }
 
    function load($param=NULL)
    {
        include_once APPPATH.'/third_party/mpdf/mpdf.php';
         
        if ($params == NULL)
        {
            $mode='';
            $format='A4';
            $default_font_size=0;
            $default_font='';
            $mgl=5;
            $mgr=5;
            $mgt=10;
            $mgb=5;
            $mgh=9;
            $mgf=9;
            $orientation='P';          
        }
         
        return new mPDF($mode, $format, $default_font_size, $default_font, $mgl, $mgr, $mgt, $mgb, $mgh, $mgf, $orientation);
    }
}