<?php
/**
 * Created by PhpStorm.
 * User: bc-033
 * Date: 17-9-29
 * Time: 下午3:36
 */

namespace Notadd\Carousel\Controller;


use Notadd\Carousel\Handler\AllGroupHandler;
use Notadd\Carousel\Handler\DeleteGroupHandler;
use Notadd\Carousel\Handler\SetGroupHandler;
use Notadd\Carousel\Handler\ShowGroupHandler;
use Notadd\Carousel\Handleru\UpdateGroupHandler;
use Notadd\Foundation\Routing\Abstracts\Controller;

class GroupController extends Controller
{
    /**
     * @param AllGroupHandler $handler
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function all(AllGroupHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * @param SetGroupHandler $handler
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function set(SetGroupHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * @param DeleteGroupHandler $handler
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function delete(DeleteGroupHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * @param UpdateGroupHandler $handler
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function update(UpdateGroupHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * @param ShowGroupHandler $handler
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function show(ShowGroupHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }
}