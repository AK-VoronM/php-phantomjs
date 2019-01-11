<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PixelTools\PhantomJs\Tests\Unit\Procedure;

use PixelTools\PhantomJs\Procedure\ChainProcedureLoader;

/**
 * PHP PhantomJs
 *
 * @author PixelTools <support@pixeltools.ru>
 */
class ChainProcedureLoaderTest extends \PHPUnit_Framework_TestCase
{

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++++++ TESTS ++++++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Test invalid argument exception is thrown if
     * not valid loader can be found.
     *
     * @access public
     * @return void
     */
    public function testInvalidArgumentExceptionIsThrownIfNoValidLoaderCanBeFound()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $procedureLoaders = array();

        $chainProcedureLoader = $this->getChainProcedureLoader($procedureLoaders);
        $chainProcedureLoader->load('test');
    }

    /**
     * Test instance of procedure is returned
     * if procedure is loaded
     *
     * @access public
     * @return void
     */
    public function testInstanceOfProcedureIsReturnedIfProcedureIsLoaded()
    {
        $procedure = $this->getProcedure();

        $procedureLoader = $this->getProcedureLoader();
        $procedureLoader->method('load')
            ->will($this->returnValue($procedure));

        $procedureLoaders = array(
            $procedureLoader
        );

        $chainProcedureLoader = $this->getChainProcedureLoader($procedureLoaders);

        $this->assertInstanceOf('\PixelTools\PhantomJs\Procedure\ProcedureInterface', $chainProcedureLoader->load('test'));
    }

    /**
     * Test loader can be added to chain
     * loader.
     *
     * @access public
     * @return void
     */
    public function testLoaderCanBeAddedToChainLoader()
    {
        $chainProcedureLoader = $this->getChainProcedureLoader(array());

        $procedureLoader =  $this->getProcedureLoader();
        $procedureLoader->expects($this->once())
            ->method('load');

        $chainProcedureLoader->addLoader($procedureLoader);
        $chainProcedureLoader->load('test');
    }

    /**
     * Test invalid argument exception is thrown if
     * not valid loader can be found when loading template
     *
     * @access public
     * @return void
     */
    public function testInvalidArgumentExceptionIsThrownIfNoValidLoaderCanBeFoundWhenLoadingTemplate()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $procedureLoaders = array();

        $chainProcedureLoader = $this->getChainProcedureLoader($procedureLoaders);
        $chainProcedureLoader->loadTemplate('test');
    }

    /**
     * Test template is returned if
     * procedure template is loaded.
     *
     * @access public
     * @return void
     */
    public function testTemplateIsReturnedIfProcedureTemplateIsLoaded()
    {
        $template = 'Test template';

        $procedureLoader = $this->getProcedureLoader();
        $procedureLoader->method('loadTemplate')
            ->will($this->returnValue($template));

        $procedureLoaders = array(
            $procedureLoader
        );

        $chainProcedureLoader = $this->getChainProcedureLoader($procedureLoaders);

        $this->assertSame($template, $chainProcedureLoader->loadTemplate('test'));
    }

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++ TEST ENTITIES ++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Get chain procedure loader instance.
     *
     * @access protected
     * @param  array                                            $procedureLoaders
     * @return \PixelTools\PhantomJs\Procedure\ChainProcedureLoader
     */
    protected function getChainProcedureLoader(array $procedureLoaders)
    {
        $chainProcedureLoader = new ChainProcedureLoader($procedureLoaders);

        return $chainProcedureLoader;
    }

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++ MOCKS / STUBS ++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Get procedure loader.
     *
     * @access protected
     * @return \PixelTools\PhantomJs\Procedure\ProcedureLoaderInterface
     */
    protected function getProcedureLoader()
    {
        $procedureLoader = $this->getMock('\PixelTools\PhantomJs\Procedure\ProcedureLoaderInterface');

        return $procedureLoader;
    }

    /**
     * Get procedure.
     *
     * @access protected
     * @return \PixelTools\PhantomJs\Procedure\ProcedureInterface
     */
    protected function getProcedure()
    {
        $procedure = $this->getMock('\PixelTools\PhantomJs\Procedure\ProcedureInterface');

        return $procedure;
    }
}
