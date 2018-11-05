<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to setting the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */



define('IMG_FILE_ALLOW_TYPE','gif|jpg|png');
define('IMG_MAX_SIZE','2048'); // 2MB
define('IMG_MAX_WIDTH','2048');
define('IMG_MAX_HEIGHT','2048'); // 2MB
define('TABLE_BRAND_UPLOAD','public/upload/brand_images/');
define('TABLE_USER_UPLOAD','public/upload/user_images/');
define('TABLE_CATEGORY_UPLOAD','public/upload/category_images/');
define('TABLE_SUB_CATEGORY_UPLOAD','public/upload/sub_category_images/');
define('TABLE_PRODUCT_UPLOAD','public/upload/product_images/');
define('TABLE_PROMOCODE_UPLOAD','public/upload/promocode_images/');
define('TABLE_BANNER_UPLOAD','public/upload/banner_images/');
define('TABLE_ADMIN_PROFILE','public/upload/admin_profile/');
define('CSV_USER_PATH','public/upload/csv_user/');
define('CSV_PRODUCT_PATH','public/upload/csv_product/');
define('TABLE_USER_UPLOAD2','public/upload/user_images_second/');

//Prefix For the Order Add
define('ORDER_CODE_PREFIX','LA3');
define('CURRENCY_CONSTANT','LBP');
define('NUMBER_CONSTANT','+961 76 797 226');
define('EMAIL_CONSTANT','support@la3andak.com');
