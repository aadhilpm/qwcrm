<?php
/**
 * @package   QWcrm
 * @author    Jon Brown https://quantumwarp.com/
 * @copyright Copyright (C) 2016 - 2017 Jon Brown, All rights reserved.
 * @license   GNU/GPLv3 or later; https://www.gnu.org/licenses/gpl.html
 */

defined('_QWEXEC') or die;

// Display Date and Time
$this->app->smarty->assign('todays_display_date', date('l, j F Y'));

//Add a welcome message based on time
if(!defined('QWCRM_SETUP')) {
    $this->app->smarty->assign('greeting_msg', $this->app->components->coretheme->greeting_message_based_on_time($this->app->user->login_display_name));    
} else {
    $this->app->smarty->assign('greeting_msg', $this->app->components->coretheme->greeting_message_based_on_time(null)); 
}