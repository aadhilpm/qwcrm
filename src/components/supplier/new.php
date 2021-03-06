<?php
/**
 * @package   QWcrm
 * @author    Jon Brown https://quantumwarp.com/
 * @copyright Copyright (C) 2016 - 2017 Jon Brown, All rights reserved.
 * @license   GNU/GPLv3 or later; https://www.gnu.org/licenses/gpl.html
 */

defined('_QWEXEC') or die;

// If details submitted insert record, if non submitted load new.tpl and populate values
if(isset(\CMSApplication::$VAR['submit']) || isset(\CMSApplication::$VAR['submitandnew'])) {
        
    // insert the supplier record and get the supplier_id
    \CMSApplication::$VAR['supplier_id'] = $this->app->components->supplier->insert_supplier(\CMSApplication::$VAR['qform']);
            
    if (isset(\CMSApplication::$VAR['submitandnew'])) {

        // load the new supplier page
        $this->app->system->page->force_page('supplier', 'new', 'msg_success='._gettext("Supplier added successfully.").' '._gettext("ID").': '.\CMSApplication::$VAR['supplier_id']); 

    } else {

        // load the supplier details page
        $this->app->system->page->force_page('supplier', 'details&supplier_id='.\CMSApplication::$VAR['supplier_id'], 'msg_success='._gettext("Supplier added successfully.").' '._gettext("ID").': '.\CMSApplication::$VAR['supplier_id']); 

    }

}

// Build the page
$this->app->smarty->assign('supplier_types', $this->app->components->supplier->get_supplier_types());