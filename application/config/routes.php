<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']   = 'Auth';
$route['404_override']         = '';
$route['translate_uri_dashes'] = FALSE;

//auth routes
$route['register']             = 'Auth/registerUser';
$route['login']                = 'Auth';
$route['logout']               = 'Auth/logout';

//menu routes
$route['home']                 = 'Home/index';
$route['about']                = 'Home/about';
$route['help']                 = 'Home/help';
$route['faq']                  = 'Home/faq';

//admin routes
$route['admin']                = 'Admin';
$route['activateUser']         = 'Admin/activateUser';

//encrypt and decrypt routes
$route['encrypt']              = 'Upload';
$route['decrypt']              = 'Decrypt';
$route['decryptFile']          = 'Decrypt/decryptFile';

$route['history']              = 'History';

//update profile
$route['updateProfile'] = 'Users';