<?php
/**
 * @package   QWcrm
 * @author    Jon Brown https://quantumwarp.com/
 * @copyright Copyright (C) 2016 - 2017 Jon Brown, All rights reserved.
 * @license   GNU/GPLv3 or later; https://www.gnu.org/licenses/gpl.html
 */

defined('_QWEXEC') or die;

// Prevent direct access to this page
if(!$this->app->system->security->check_page_accessed_via_qwcrm()) {
    header('HTTP/1.1 403 Forbidden');
    die(_gettext("No Direct Access Allowed."));
}

// Check if we have an user_id
if(!isset(\CMSApplication::$VAR['user_id']) || !\CMSApplication::$VAR['user_id']) {
    $this->app->system->variables->systemMessagesWrite('danger', _gettext("No User ID supplied."));
    $this->app->system->page->force_page('user', 'search');
}

// Run the delete function
if(!$this->app->components->user->delete_user(\CMSApplication::$VAR['user_id'])) {
    
    // load the user details page
    $this->app->system->page->force_page('user', 'details&user_id='.\CMSApplication::$VAR['user_id']);    
    
} else {
    
    // load the user search page
    $this->app->system->page->force_page('user', 'search', 'msg_success='._gettext("User record deleted."));   
    
}