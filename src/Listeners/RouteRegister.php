<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-29 下午3:49
 */

namespace Notadd\Carousel\Listeners;

use Notadd\Carousel\Controllers\CategoryController;
use Notadd\Carousel\Controllers\GroupController;
use Notadd\Carousel\Controllers\PictureController;
use Notadd\Foundation\Routing\Abstracts\RouteRegister as AbstractRouteRegister;

class RouteRegister extends AbstractRouteRegister
{

    /**
     * Handle Route Register.
     */
    public function handle()
    {
        $this->router->group(['middleware' => ['cross', 'web'], 'prefix' => 'api/carousel'], function () {

            $this->router->group(['prefix' => 'picture'], function () {
                $this->router->post('set', PictureController::class.'@set');
                $this->router->post('delete', PictureController::class.'@delete');
                $this->router->post('update', PictureController::class.'@update');
            });

            $this->router->group(['prefix' => 'group'], function () {
                $this->router->post('all', GroupController::class.'@all');
                $this->router->post('set', GroupController::class.'@set');
                $this->router->post('delete', GroupController::class.'@delete');
                $this->router->post('update', GroupController::class.'@update');
                $this->router->post('show', GroupController::class.'@show');
            });

            $this->router->group(['prefix' => 'category'], function () {
                $this->router->post('all', CategoryController::class.'@all');
                $this->router->post('set', CategoryController::class.'@set');
                $this->router->post('delete', CategoryController::class.'@delete');
                $this->router->post('update', CategoryController::class.'@update');
                $this->router->post('show', CategoryController::class.'@show');
            });
        });
    }
}