<?php

include('lib/template-cases.php');
include('lib/template-filter-page.php');
include('lib/template-edit-page.php');
include('lib/template-delete.php');
include('lib/filter_result.php');
include('lib/save_post_result.php');
include('lib/add_unit.php');
include('lib/unit_list.php');
include('lib/edit_unit.php');
include('lib/save_unit_result.php');
include('lib/delete_unit.php');

function register_cases_add_submenu() {
    add_submenu_page('cases_cpanel', 'Add new Cases', 'Add new Cases', 'manage_options', 'manage_cases', 'manage_cases');
}

function register_cases_filter_page() {
    add_submenu_page('cases_cpanel', 'Filter page', 'Filter page', 'manage_options', 'get_filter_page_form', 'get_filter_page_form');
}

function register_cases_filter_result() {
    add_submenu_page(null, 'Filter result', 'Filter result', 'manage_options', 'filter_result', 'filter_result');
}

function register_cases_request() {
    add_submenu_page(null, 'Request page', 'Request page', 'manage_options', 'cases_request', 'cases_request');
}

function register_cases_edit() {
    add_submenu_page(null, 'Cases edit', 'Cases edit', 'manage_options', 'cases_edit', 'cases_edit');
}

function register_edit_result() {
    add_submenu_page(null, 'Edit result', 'Cases result', 'manage_options', 'edit_update_result', 'save_editable_result');
}

function register_cases_delete() {
    add_submenu_page(null, 'Cases delete', 'Cases delete', 'manage_options', 'cases_delete', 'cases_delete');
}

function register_add_new_unit() {
    add_submenu_page(null, 'Cases unit', 'Cases unit', 'manage_options', 'cases_new_unit', 'cases_new_unit');
}

function register_unit_list() {
    add_submenu_page('cases_cpanel', 'Units', 'Units', 'manage_options', 'unit_list', 'unit_list');
}

function register_edit_unit_list() {
    add_submenu_page(null, 'unit', 'unit', 'manage_options', 'edit_unit', 'edit_unit');
}

function register_save_unit_result() {
    add_submenu_page(null, 'unit_result', 'unit_result', 'manage_options', 'save_unit_result', 'save_unit_result');
}

function register_delete_unit() {
    add_submenu_page(null, 'delete unit', 'delete unit', 'manage_options', 'delete_unit', 'delete_unit');
}
/*   Add new Cases */

function manage_cases($param) {
    if (isset($_GET['cases_id']) && (int) $_GET['cases_id']) {
      return;
    } else {
        get_cases_add_form();
    }
}

function save_editable_result() {
    if (isset($_GET['id']) && (int) $_GET['id']) {
        edit_update_result((int) $_GET['id']);
    }
}

function cases_request() {
    save_cases_request();
}

function cases_edit() {
    if (isset($_GET['id']) && (int) $_GET['id']) {
        cases_update((int) $_GET['id']);
    }
}

function cases_delete() {
    if (isset($_GET['id']) && (int) $_GET['id']) {
        delete((int) $_GET['id']);
    }
}
function cases_new_unit(){
  add_new_unit();
}
