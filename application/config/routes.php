<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
/*Login and Dashboard Routes*/
$route['login'] = 'LoginController/validate_login';
$route['dashboard'] = 'LoginController/dashboard';
$route['logout'] = 'LoginController/logout';
/*Sujal Products Routes*/
$route['sujal_products'] = 'SujalProductsController/index';
$route['add_sujal_product'] = 'SujalProductsController/create';
$route['save_sujal_product'] = 'SujalProductsController/store';
$route['save_sujal_product/(:num)'] = 'SujalProductsController/store/$1';
$route['view_sujal_product/(:num)'] = 'SujalProductsController/show/$1';
$route['edit_sujal_product/(:num)'] = 'SujalProductsController/create/$1';
$route['delete_sujal_product/(:num)'] = 'SujalProductsController/destroy/$1';
$route['sale_product'] = 'SujalProductsController/sold_products_list';
$route['sale_new_sujal_product'] = 'SujalProductsController/create_sale';
$route['save_sujal_product_sale'] = 'SujalProductsController/store_sale';
$route['edit_sujal_product_sale/(:num)'] = 'SujalProductsController/edit_sale/$1';
$route['save_sujal_product_sale/(:num)'] = 'SujalProductsController/update_sale/$1';
$route['delete_sujal_sale/(:num)'] = 'SujalProductsController/destroy_sale/$1';
/*Sujal Invoices Routes*/
$route['sujal_invoices'] = 'SujalInvoiceController/index';
$route['sujal_dues_payments'] = 'SujalInvoiceController/dues_payments_list';
$route['view_sujal_invoice/(:num)'] = 'SujalInvoiceController/show/$1';
$route['pay_sujal_due_payment/(:num)'] = 'SujalInvoiceController/pay_dues/$1';
$route['save_payment'] = 'SujalInvoiceController/store_payments';

$route['create_sujal_invoice/(:num)'] = 'SujalInvoiceController/create/$1';
$route['save_sujal_invoice'] = 'SujalInvoiceController/store';
$route['edit_sujal_invoice/(:num)'] = 'SujalInvoiceController/edit/$1';
$route['save_sujal_invoice/(:num)'] = 'SujalInvoiceController/update_invoice/$1';
$route['view_sujal_invoice/(:num)'] = 'SujalInvoiceController/show_invoice/$1';

/*Sujal Customers Routes*/
$route['sujal_customers'] = 'SujalCustomersController/index';
$route['add_sujal_customer'] = 'SujalCustomersController/create';
$route['save_sujal_customer'] = 'SujalCustomersController/store';
$route['edit_sujal_customer/(:num)'] = 'SujalCustomersController/create/$1';
$route['save_sujal_customer/(:num)'] = 'SujalCustomersController/store/$1';
$route['delete_sujal_customer/(:num)'] = 'SujalCustomersController/destroy/$1';
/*Other (Non Sujal) Customers Routes*/
$route['non_sujal_customers'] = 'NonSujalCustomersController/index';
$route['add_non_sujal_customer'] = 'NonSujalCustomersController/create';
$route['save_non_sujal_customer'] = 'NonSujalCustomersController/store';
$route['edit_non_sujal_customer/(:num)'] = 'NonSujalCustomersController/create/$1';
$route['save_non_sujal_customer/(:num)'] = 'NonSujalCustomersController/store/$1';
$route['delete_non_sujal_customer/(:num)'] = 'NonSujalCustomersController/destroy/$1';

/*Sujal AMC Routes*/
$route['sujals_amcs'] = 'SujalAmcController/index';
$route['save_sujal_amc/(:num)'] = 'SujalAmcController/store/$1';
$route['view_sujal_amc/(:num)'] = 'SujalAmcController/create/$1';
$route['save_sujal_amc_data'] = 'SujalAmcController/store';
$route['delete_amc_history/(:num)'] = 'SujalAmcController/destroy_history/$1';

/*Non Sujal AMC Routes*/
$route['non_sujals_amcs'] = 'NonSujalAmcController/index';
$route['view_non_sujal_amc/(:num)'] = 'NonSujalAmcController/create/$1';
$route['save_amc_data'] = 'NonSujalAmcController/store';
$route['save_amc_data/(:num)'] = 'NonSujalAmcController/store/$1';
$route['delete_non_sujal_amc/(:num)'] = 'NonSujalAmcController/destroy/$1';
$route['remove_amc/(:num)'] = 'NonSujalAmcController/destroy_history/$1';

/*Invoices Routes*/
$route['non_sujal_invoices'] = 'InvoiceController/index';
$route['create_non_sujal_invoice'] = 'InvoiceController/create';
$route['save_non_sujal_invoice'] = 'InvoiceController/store';
$route['edit_non_sujal_invoice/(:num)'] = 'InvoiceController/edit/$1';
$route['save_non_sujal_invoice/(:num)'] = 'InvoiceController/update_invoice/$1';
$route['view_non_sujal_invoice/(:num)'] = 'InvoiceController/show_invoice/$1';
$route['generate_pdf/(:num)'] = 'InvoiceController/generate_pdf/$1';

$route['invoice_prefix'] = 'SettingsController/index';
$route['save_invoice_prefix'] = 'SettingsController/store';

/*User Routes*/
$route['user'] = 'UserController/index';
$route['save_user/(:num)'] = 'UserController/store/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;