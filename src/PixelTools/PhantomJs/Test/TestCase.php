<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PixelTools\PhantomJs\Test;

use PixelTools\PhantomJs\DependencyInjection\ServiceContainer;

/**
 * PHP PhantomJs
 *
 * @author PixelTools <support@pixeltools.ru>
 */
class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Get dependency injection container.
     *
     * @access public
     * @return \PixelTools\PhantomJs\DependencyInjection\ServiceContainer
     */
    public function getContainer()
    {
        return ServiceContainer::getInstance();
    }
}
