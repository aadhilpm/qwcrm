<?php
/**
 * @package   QWcrm
 * @author    Jon Brown https://quantumwarp.com/
 * @copyright Copyright (C) 2016 - 2017 Jon Brown, All rights reserved.
 * @license   GNU/GPLv3 or later; https://www.gnu.org/licenses/gpl.html
 */

defined('_QWEXEC') or die;

// Build the page
$this->app->smarty->assign('client_details', $this->app->components->client->get_client_details($this->app->components->schedule->get_schedule_details(\CMSApplication::$VAR['schedule_id'], 'client_id')));
$this->app->smarty->assign('schedule_details', $this->app->components->schedule->get_schedule_details(\CMSApplication::$VAR['schedule_id']));
$this->app->smarty->assign('employee_display_name', $this->app->components->user->get_user_details($this->app->components->schedule->get_schedule_details(\CMSApplication::$VAR['schedule_id'], 'employee_id'), 'display_name')  );