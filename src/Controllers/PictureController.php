<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-29 下午3:27
 */

namespace Notadd\Carousel\Controllers;

use Notadd\Carousel\Handler\DeletePictureHandler;
use Notadd\Carousel\Handlers\SetPictureHandler;
use Notadd\Carousel\Handlers\UpdatePictureHandler;
use Notadd\Foundation\Routing\Abstracts\Controller;

class PictureController extends Controller
{

    /**
     * @param SetPictureHandler $handler
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function set(SetPictureHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * @param DeletePictureHandler $handler
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function delete(DeletePictureHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * @param UpdatePictureHandler $handler
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function update(UpdatePictureHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

}