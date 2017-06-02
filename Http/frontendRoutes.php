<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => trans('isearch::common.url')], function (Router $router) {

    $locale = LaravelLocalization::setLocale() ?: App::getLocale();

    $router->post('/', [
        'as' => $locale.'.isearch.search',
        'uses' => 'PublicController@search'
    ]);

});
