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
// $route['test_amc_dates'] = 'Welcome/test';
// $route['get_dates'] = 'Welcome/getAmcDate';
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
$route['view_customers'] = 'NonSujalCustomersController/show_all_customers';

/*Sujal AMC Routes*/
$route['sujals_amcs'] = 'SujalAmcController/index';
$route['save_sujal_amc/(:num)'] = 'SujalAmcController/store/$1';
$route['view_sujal_amc/(:num)'] = 'SujalAmcController/create/$1';
$route['save_sujal_amc_data'] = 'SujalAmcController/store';
$route['delete_sujal_amc/(:num)'] = 'SujalAmcController/destroy/$1';
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
$route['watertanks_invoices'] = 'InvoiceController/tanks_invoices';
$route['create_tanks_invoice'] = 'InvoiceController/create_tanks_invoices';
$route['getCharges'] = 'InvoiceController/getCharges';
$route['save_tank_invoice'] = 'InvoiceController/store_tank_invoice';
$route['view_tanks_invoice/(:num)'] = 'InvoiceController/show_tanks_invoice/$1';
$route['edit_tanks_invoice/(:num)'] = 'InvoiceController/edit_tanks_invoice/$1';
$route['save_tank_invoice/(:num)'] = 'InvoiceController/update_tank_invoice/$1';


/*======================== Water Tanks Modules Routes ========================*/

/*Water Tanks types and capacity routes*/
$route['water_tank_types']  = 'WatertanksController/index';
$route['add_water_tank_type'] = 'WatertanksController/create';
$route['save_water_tank_type'] = 'WatertanksController/store';
$route['edit_water_tank_types/(:num)'] = 'WatertanksController/create/$1';
$route['save_water_tank_type/(:num)'] = 'WatertanksController/store/$1';
$route['delete_water_tank_types/(:num)'] = 'WatertanksController/destroy/$1';
$route['water_tanks'] = 'WatertanksController/water_tanks_index';
$route['add_water_tank'] = 'WatertanksController/water_tanks_create';
$route['save_water_tank_data'] = 'WatertanksController/store_water_tanks';
$route['edit_water_tank/(:num)'] = 'WatertanksController/water_tanks_create/$1';
$route['save_water_tank_data/(:num)'] = 'WatertanksController/store_water_tanks/$1';
$route['delete_water_tank/(:num)'] = 'WatertanksController/destroy_water_tanks/$1';

/*Water Tank Customers*/
$route['water_tank_cleaning_customers'] = 'WTCustomerController/index';
$route['add_water_tank_cleaning_customer'] = 'WTCustomerController/create';
$route['getTankbyType'] = 'WTCustomerController/getTankbyType';
$route['save_water_tank_cleaning_customer'] = 'WTCustomerController/store';
$route['getAmcDate'] = 'WTCustomerController/getAmcDate';
$route['edit_water_tank_customer/(:num)'] = 'WTCustomerController/edit/$1';
$route['save_water_tank_cleaning_customer/(:num)'] = 'WTCustomerController/update/$1';
$route['view_tank_customer/(:num)'] = 'WTCustomerController/view/$1';
$route['delete_water_tank_customer/(:num)'] = 'WTCustomerController/destroy/$1';

/*Water Tank cleanig AMCS*/
$route['water_tank_cleaning_amcs'] = 'WTAmcController/index';
$route['view_water_tank_amc/(:num)'] = 'WTAmcController/create/$1';
$route['save_water_tank_amc_data'] = 'WTAmcController/store';
$route['save_tank_amcn/(:num)'] = 'WTAmcController/save_amc_note/$1';
$route['delete_tanks_amc/(:num)'] = 'WTAmcController/destroy/$1';


/*Settings Routes*/
$route['invoice_prefix'] = 'SettingsController/index';
$route['save_invoice_prefix'] = 'SettingsController/store';

/*User Routes*/
$route['user'] = 'UserController/index';
$route['save_user/(:num)'] = 'UserController/store/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;