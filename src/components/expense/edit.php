<?php
/**
 * @package   QWcrm
 * @author    Jon Brown https://quantumwarp.com/
 * @copyright Copyright (C) 2016 - 2017 Jon Brown, All rights reserved.
 * @license   GNU/GPLv3 or later; https://www.gnu.org/licenses/gpl.html
 */

defined('_QWEXEC') or die;

// Check if we have an expense_id
if(!isset(\CMSApplication::$VAR['expense_id']) || !\CMSApplication::$VAR['expense_id']) {
    $this->app->system->variables->systemMessagesWrite('danger', _gettext("No Expense ID supplied."));
    $this->app->system->page->force_page('expense', 'search');
}

// If details submitted run update values, if not set load edit.tpl and populate values
if(isset(\CMSApplication::$VAR['submit'])) {    
        
        $this->app->components->expense->update_expense(\CMSApplication::$VAR['qform']);
        $this->app->components->expense->recalculate_expense_totals(\CMSApplication::$VAR['qform']['expense_id']);
        $this->app->system->page->force_page('expense', 'details&expense_id='.\CMSApplication::$VAR['qform']['expense_id'], 'msg_success='._gettext("Expense updated successfully.")); 

} else {
    
    // Check if expense can be edited
    if(!$this->app->components->expense->check_expense_can_be_edited(\CMSApplication::$VAR['expense_id'])) {
        $this->app->system->variables->systemMessagesWrite('danger', _gettext("You cannot edit this expense because its status does not allow it."));
        $this->app->system->page->force_page('expense', 'details&expense_id='.\CMSApplication::$VAR['expense_id']);
    }
    
    // Build the page       
    $this->app->smarty->assign('expense_statuses', $this->app->components->expense->get_expense_statuses()            );
    $this->app->smarty->assign('expense_types', $this->app->components->expense->get_expense_types());
    $this->app->smarty->assign('vat_tax_codes', $this->app->components->company->get_vat_tax_codes(false));
    $this->app->smarty->assign('expense_details', $this->app->components->expense->get_expense_details(\CMSApplication::$VAR['expense_id']));
    
}