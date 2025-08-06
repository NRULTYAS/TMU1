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
|	https://codeigniter.com/userguide3/general/routing.html
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
defined('BASEPATH') OR exit('No direct script access allowed');

// Default controller saat pertama kali diakses
$route['default_controller'] = 'home'; // Tampilkan halaman depan

// Autentikasi
$route['login']     = 'login/index';     // Form login
$route['do-login']  = 'login/proses';    // Proses login
$route['logout']    = 'login/logout';    // Logout dan redirect ke dashboard

// Halaman utama/dashboard setelah login
$route['dashboard'] = 'halaman_utama/index'; // Ini tujuan redirect saat logout

// Modul data master
$route['jenis-diklat'] = 'jenisdiklat/index';
$route['diklat']       = 'diklat/index';
// Routing untuk Schedule
$route['Schedule'] = 'Schedule/index'; // tampilan default (pakai GET untuk filter)

// Routing untuk detail jadwal berdasarkan diklat
$route['Schedule/(:any)'] = 'Schedule/show_by_diklat/$1';

// Routing untuk detail berdasarkan tahun + diklat (2 segmen unik)
$route['Schedule/(:any)/(:any)'] = 'Schedule/show_by_tahun_diklat/$1/$2';


//Halaman frontend
$route['home/detail_jenis/(:any)'] = 'home/detail_jenis/$1';
$route['home/detail_program/(:any)'] = 'home/detail_program/$1';

// Error handling
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Routing untuk pendaftaran dengan clean URLs
$route['pendaftaran'] = 'Pendaftaran_New/index'; // /pendaftaran - redirect ke diklat pertama
$route['pendaftaran/daftar'] = 'Pendaftaran_New/form_direct'; // /pendaftaran/daftar - langsung ke form
$route['pendaftaran/([a-zA-Z0-9\-]+)'] = 'Pendaftaran_New/diklat/$1'; // /pendaftaran/{diklat_id}
$route['pendaftaran/([a-zA-Z0-9\-]+)/([0-9]+)'] = 'Pendaftaran_New/periode/$1/$2'; // /pendaftaran/{diklat_id}/{periode}

// Routing untuk registrasi user
$route['daftar'] = 'login/register'; // /daftar - halaman registrasi user
$route['register'] = 'login/register'; // /register - halaman registrasi user

// API endpoints
$route['api/jadwal/([a-zA-Z0-9\-]+)'] = 'Pendaftaran_New/api_jadwal/$1'; // API untuk get jadwal

// Legacy routing (backward compatibility)
$route['pendaftaran/index/([a-zA-Z0-9\-]+)'] = 'Pendaftaran_New/diklat/$1'; // Old format support
$route['pendaftaran/form/(:any)'] = 'pendaftaran/form/$1'; // Form pendaftaran dengan jadwal_id
