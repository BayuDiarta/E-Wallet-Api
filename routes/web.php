<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// ROUTE FOR AUTHENTICATION
$router->group(['prefix' => 'api/auth', 'namespace' => 'API'], function () use ($router) {
    $router->post("register", "Auth\RegisterController@register");
    $router->post("login", "Auth\LoginController@login");
    $router->post("forgot-password", "Auth\ForgotPasswordController@forgotPassword");
    $router->post("reset-password", "Auth\ResetPasswordController@resetPassword");
});

$router->group(['prefix' => 'api', 'middleware' => ['auth']], function () use ($router) {

    // ROUTE FOR LOGOUT USER
    $router->post("logout", "API\Auth\LogoutController@logout");

    // ROUTE FOR USER
    $router->group(['prefix' => 'users', 'namespace' => 'API'], function () use ($router) {
        $router->post('/', "UserController@create");
        $router->get('/profile', "UserController@profile");
        $router->put('/{id}', "UserController@update");
        $router->delete('/{id}', "UserController@delete");
    });

    //ROUTE FOR WALLET
    $router->group(['prefix' => 'wallet', 'namespace' => 'API'], function () use ($router) {
        $router->post('create', 'UserController@createWallet');
        $router->get('detail', 'WalletController@detail');
        $router->post('topup', 'WalletController@topup');
        $router->post('transfer', 'WalletController@transfer');
        $router->post('widtraw', 'WalletController@widtraw');
    });

    //ROUTE FOR TRANSACTION
    $router->group(['prefix' => 'transaction', 'namespace' => 'API'], function () use ($router) {
        $router->get('detail', 'TransactionController@transaction');
    });
});