<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
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
  |	http://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There area two reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router what URI segments to use if those provided
  | in the URL cannot be matched to a valid route.
  |
 */
$route['default_controller'] = "content";

/*
 *  Frontend Routes
 */
$route['password'] = 'password/reset_password';


$route['index'] = 'content/login';
$route['login'] = 'content/login';
$route['invoice_mail'] = 'content/invoice_mail';
$route['logout'] = 'content/logout';
$route['reset_password'] = 'content/reset_password';
$route['profile'] = 'content/profile';
$route['dashboard'] = 'content/dashboard';
$route['content_management'] = 'content/content_management';
$route['contact_us'] = 'content/contact_us';
$route['deleivery_charges'] = 'content/deleivery_charges';
$route['edit_profile_api'] = 'content/edit_profile_api';
$route['feedback_list'] = 'content/feedback_list';

//brand
$route['manage_brand'] = 'brand/manage_brand';
$route['brand_add'] = 'brand/brand_add';
$route['edit_brand'] = 'brand/brand_edit';
$route['delete_brand'] = 'brand/delete_brand';


//consumer
$route['consumer_list'] = 'consumer/consumer_list';
$route['consumer_add'] = 'consumer/consumer_add';
$route['consumer_edit'] = 'consumer/consumer_edit';
$route['delete_consumer'] = 'consumer/delete_consumer';
$route['address_list'] = 'consumer/address_list';

//category
$route['category_list'] = 'category/category_list';
$route['category_add'] = 'category/category_add';
$route['category_edit'] = 'category/category_edit';
$route['delete_category'] = 'category/delete_category';

//sub_category
$route['sub_category_list'] = 'sub_category/sub_category_list';
$route['sub_category_add'] = 'sub_category/sub_category_add';
$route['sub_category_edit'] = 'sub_category/sub_category_edit';
$route['delete_sub_category'] = 'sub_category/delete_sub_category';

//product
$route['product_list'] = 'product/product_list';
$route['sub_product_list'] = 'product/sub_product_list';
$route['product_add'] = 'product/product_add';
$route['product_sub_product_add'] = 'product/product_sub_product_add';
$route['product_edit'] = 'product/product_edit';
$route['product_delete'] = 'product/product_delete';
$route['sub_product_edit'] = 'product/sub_product_edit';
$route['sub_product_delete'] = 'product/sub_product_delete';
$route['product/get_sub_category/(:any)'] = 'product/get_sub_category/$1';

//location
$route['location_list'] = 'location/location_list';
$route['location_add'] = 'location/location_add';
$route['location_edit'] = 'location/location_edit';
$route['delete_location'] = 'location/delete_location';


//promocodes
$route['promocode_list'] = 'promocode/promocode_list';
$route['add_promocode'] = 'promocode/add_promocode';
$route['promocode_edit'] = 'promocode/promocode_edit';
$route['delete_promocode'] = 'promocode/delete_promocode';


//CSV
$route['user_import'] = 'csv/export_csv';
$route['product_import'] = 'csv/product_import';
$route['product_export'] = 'csv/product_export';
$route['delete_brand'] = 'brand/delete_brand';

//Payment List
$route['payment_list'] = 'payment/payment_list';
$route['daily_payment'] = 'payment/daily_payment';
$route['payment_history'] = 'payment/payment_history';

//Sloats

$route['edit_slots'] = 'sloats/edit_slots';
$route['edit_slots_detail'] = 'sloats/edit_slots_detail';
$route['ChangeSlotStatus'] = 'sloats/ChangeSlotStatus';
$route['Slots_order_limit'] = 'sloats/Slots_order_limit';


//order
$route['invoice'] = 'order/invoice';
$route['neworderlist'] = 'order/neworderlist';
$route['order_pending_list'] = 'order/order_pending_list';
$route['under_preparation_order'] = 'order/under_preparation_order';
$route['en_route_order_list'] = 'order/en_route_order';
$route['order_cancel_list'] = 'order/order_cancel_list';
$route['order_delivered_list'] = 'order/order_delivered_list';
$route['order/oreder_detail'] = 'order/oreder_detail';
$route['edit_order'] = 'order/edit_order';

//notification
$route['send_notification'] = 'notification/send_notification';
$route['notification_list'] = 'notification/notification_list';

//city
$route['city_list'] = 'city/city_list';
$route['add_city'] = 'city/city_add';
$route['edit_city'] = 'city/city_edit';
$route['delete_city'] = 'city/delete_city';

//area
$route['area_list'] = 'area/area_list';
$route['add_area'] = 'area/add_area';
$route['edit_area'] = 'area/edit_area';
$route['delete_area'] = 'area/delete_area';

//banner
$route['banner_list'] = 'banner/banner_list';
$route['add_banner'] = 'banner/add_banner';
$route['edit_banner'] = 'banner/edit_banner';
$route['delete_banner'] = 'banner/delete_banner';


//drivers
$route['manage_drivers'] = 'drivers/manage_drivers';
$route['get_driver'] = 'drivers/get_driver';
$route['add_driver'] = 'drivers/add_driver';
$route['delete_driver'] = 'drivers/delete_driver';


//WS
$route['v1/(:any)'] = 'v1/$1';

//$route['v1/add_review'] = 'v1/add_review';