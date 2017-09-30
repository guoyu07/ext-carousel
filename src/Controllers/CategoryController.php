<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-29 下午3:44
 */

namespace Notadd\Carousel\Controllers;


use Notadd\Carousel\Handlers\AllCategoryHandler;
use Notadd\Carousel\Handlers\DeleteCategoryHandler;
use Notadd\Carousel\Handlers\SetCategoryHandler;
use Notadd\Carousel\Handlers\ShowCategoryHandler;
use Notadd\Carousel\Handlers\UpdateCategoryHandler;
use Notadd\Foundation\Routing\Abstracts\Controller;

class CategoryController extends Controller
{
    /**
     * @param AllCategoryHandler $handler
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function all(AllCategoryHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * @param SetCategoryHandler $handler
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function set(SetCategoryHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * @param DeleteCategoryHandler $handler
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function delete(DeleteCategoryHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * @param UpdateCategoryHandler $handler
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function update(UpdateCategoryHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * @param ShowCategoryHandler $handler
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function show(ShowCategoryHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }
}