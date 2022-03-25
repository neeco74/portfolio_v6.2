<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->match(['get', 'post'],         '/',                            'RootController::index');

$routes->post(                          'login',                        'LoginController::login');
$routes->get(                           'logout',                       'LoginController::logout');
$routes->match(['get', 'post'],         'forget',                       'LoginController::forgetPassword');
$routes->match(['get', 'post'],         'reset',                        'LoginController::resetPassword');

$routes->post(                          'register',                     'RegistrationController::register');
$routes->get(                           'confirm',                      'RegistrationController::confirm');



$routes->group('admin', ['filter' => 'auth', 'filter' => 'authAdmin'], function($routes) {
    
    /*
    * ADMIN PORTFOLIO
    */
    $routes->match(['get', 'post'],     'portfolio/edit/(:num)',        'Admin\AdminPortfolioController::edit/$1');
    $routes->match(['get', 'post'],     'portfolio/edit',               'Admin\AdminPortfolioController::edit');
    $routes->get(                       'portfolio/delete/(:num)',      'Admin\AdminPortfolioController::delete/$1');
    $routes->match(['get', 'post'],     'portfolio',                    'Admin\AdminPortfolioController::index');
    
    $routes->match(['get', 'post'],     'cat-portfolio/edit/(:num)',    'Admin\AdminCategoriesPortfolioController::edit/$1');
    $routes->match(['get', 'post'],     'cat-portfolio/edit',           'Admin\AdminCategoriesPortfolioController::edit');
    $routes->get(                       'cat-portfolio/delete/(:num)',  'Admin\AdminCategoriesPortfolioController::delete/$1');
    $routes->get(                       'cat-portfolio',                'Admin\AdminCategoriesPortfolioController::index');

    /*
    * ADMIN BLOG
    */
    $routes->match(['get', 'post'],     'blog/edit/(:num)',             'Admin\AdminBlogController::edit/$1');
    $routes->match(['get', 'post'],     'blog/edit',                    'Admin\AdminBlogController::edit');
    $routes->get(                       'blog/delete/(:num)',           'Admin\AdminBlogController::delete/$1');
    $routes->get(                       'blog',                         'Admin\AdminBlogController::index');
    
    $routes->match(['get', 'post'],     'cat-blog/edit/(:num)',         'Admin\AdminCategoriesBlogController::edit/$1');
    $routes->match(['get', 'post'],     'cat-blog/edit',                'Admin\AdminCategoriesBlogController::edit');
    $routes->get(                       'cat-blog/delete/(:num)',       'Admin\AdminCategoriesBlogController::delete/$1');
    $routes->get(                       'cat-blog',                     'Admin\AdminCategoriesBlogController::index'); 

    $routes->get(                       '/',                            'Admin\AdminController::index');

});


$routes->group('', ['filter' => 'auth'], function($routes) {
    
    $routes->match(['get', 'post'],     'portfolio/(:num)(:segment)',   'HomeController::portfolioItem/$1');
    $routes->match(['get', 'post'],     'blog/(:num)(:segment)',        'HomeController::blogArticle/$1');
    $routes->get(                       'portfolio',                    'HomeController::portfolio');
    $routes->get(                       'blog',                         'HomeController::blog');
    $routes->match(['get', 'post'],     'contact',                      'HomeController::contact');
    $routes->match(['get', 'post'],     'cv',                           'HomeController::cv');

    $routes->get(                       'home',                         'HomeController::home');
    $routes->get(                       'profile',                      'HomeController::profile');

});



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
