<?php
/**
 * @package   QWcrm
 * @author    Jon Brown https://quantumwarp.com/
 * @copyright Copyright (C) 2016 - 2017 Jon Brown, All rights reserved.
 * @license   GNU/GPLv3 or later; https://www.gnu.org/licenses/gpl.html
 */

defined('_QWEXEC') or die;

// Check if we have a workorder_note_id
if(!isset(\CMSApplication::$VAR['workorder_note_id']) || !\CMSApplication::$VAR['workorder_note_id']) {
    $this->app->system->variables->systemMessagesWrite('danger', _gettext("No Work Order Note ID supplied."));
    $this->app->system->page->force_page('workorder', 'search');
}

// Get teh work order note details
$workorder_note_details = $this->app->components->workorder->get_workorder_note_details(\CMSApplication::$VAR['workorder_note_id']);

// If record submitted for updating
if(isset(\CMSApplication::$VAR['submit'])) {    
    
    // update the workorder note
    $this->app->components->workorder->update_workorder_note(\CMSApplication::$VAR['workorder_note_id'], \CMSApplication::$VAR['note']);
    
    // load the workorder details page
    $this->app->system->variables->systemMessagesWrite('success', _gettext("The note has been updated."));
    $this->app->system->page->force_page('workorder', 'details&workorder_id='.$workorder_note_details['workorder_id']);
    
}   
    
// Build the page
$this->app->smarty->assign('workorder_note_details', $workorder_note_details);
