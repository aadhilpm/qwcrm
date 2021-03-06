<?php
/**
 * @package   QWcrm
 * @author    Jon Brown https://quantumwarp.com/
 * @copyright Copyright (C) 2016 - 2017 Jon Brown, All rights reserved.
 * @license   GNU/GPLv3 or later; https://www.gnu.org/licenses/gpl.html
 */

defined('_QWEXEC') or die;

$this->app->smarty->assign('IPaddress',                $this->app->system->security->get_visitor_ip_address()            );  // IP address of the Visitor
$this->app->smarty->assign('pageLoadTime',             microtime(1) - \CMSApplication::$VAR['system']['startTime']          );  // Time to load the page to the nearest microsecond
$this->app->smarty->assign('pageDisplayController',    $page_controller                    );  // the location of the real php file that loads the page
$this->app->smarty->assign('loadedComponent',          \CMSApplication::$VAR['component']                   );  // Loaded component
$this->app->smarty->assign('loadedPageTpl',            \CMSApplication::$VAR['page_tpl']                    );  // Loaded page
$this->app->smarty->assign('startMem',                 \CMSApplication::$VAR['system']['startMem'] / 1048576                 );  // PHP Memory used when starting QWcrm (in MB)
$this->app->smarty->assign('currentMem',               memory_get_usage() / 1048576        );  // PHP Memory used at the time this php is called (in MB)
$this->app->smarty->assign('peakMem',                  memory_get_peak_usage() / 1048576   );  // Peak PHP Memory used during the page load (in MB)

//\CMSApplication::$VAR['debug']['infoOutput'] - just incase I need a propername

$pagePayload .= $this->app->smarty->fetch('core/blocks/theme_debug_block.tpl');

// Smarty Debugging - Done this way because $this->app->smarty_debugging is not supported when using fetch()
if($this->app->config->get('qwcrm_smarty_debugging')) {
    $pagePayload .= $this->app->smarty->fetch('core/blocks/theme_debug_smarty_debug_block.tpl');
}

// Advanced Debug - Only use in offline sites and for developement only
if($this->app->config->get('qwcrm_advanced_debug')) {

    $pagePayload .= "\r\n\r\n<div><h2><strong>"._gettext("QWcrm Advanced Debug Section")."</strong></h2></div>\r\n";
 
    /* 
     * All defined PHP Variables
     *  
     * Pick your poison - http://web-profile.net/php/dev/var_dump-print_r-var_export/
     *       
     */    
    $pagePayload.= "<div><h3><strong>"._gettext("All Defined PHP Variables").":</strong></h3></div>\r\n";     
    $pagePayload .= '<pre>'.htmlspecialchars(print_r(get_defined_vars(), true)).'</pre>';        
    
    /* 
     * All defined PHP Constants
     */    
    $pagePayload .= "<div><h3><strong>"._gettext("All Defined PHP Constants").":</strong></h3></div>\r\n";
    $pagePayload .= '<pre>'.htmlspecialchars(print_r(get_defined_constants(), true)).'</pre>';

    /* 
     * All defined PHP functions
     */    
    $pagePayload .= "<div><h3><strong>"._gettext("All Defined PHP Functions").":</strong></h3></div>\r\n";
    $pagePayload .= '<pre>'.print_r(get_defined_functions(), true).'</pre>';    

    /* 
     * All declared PHP Classes
     */    
    $pagePayload .= "<div><h3><strong>"._gettext("All Declared PHP Classes").":</strong></h3></div>\r\n";
    $pagePayload .= '<pre>'.print_r(get_declared_classes(), true).'</pre>'; 
    
    /* 
     * All Server Enviromental Variables
     */        
    $pagePayload .= "<div><h3><strong>"._gettext("All Server Enviromental Variables").":</strong></h3></div>\r\n";
    $pagePayload .= '<pre>'.htmlspecialchars(print_r($_SERVER, true)).'</pre>';     
    
}