<?php
/**
 * Created by PhpStorm.
 * User: bc-033
 * Date: 17-9-29
 * Time: 下午3:49
 */

namespace Notadd\Carious\Listener;

use Notadd\Carousel\Controller\PictureController;
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
        });
    }
}