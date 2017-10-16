<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-10-16 上午11:22
 */

namespace Notadd\Carousel\Tests;


use Illuminate\Contracts\Console\Kernel;
use Notadd\Foundation\Testing\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     * Needs to be implemented by subclasses.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $application = require __DIR__ . '../../../../storage/bootstraps/application.php';
        $application->make(Kernel::class)->bootstrap();

        return $application;
    }
}