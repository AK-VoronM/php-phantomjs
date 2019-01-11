<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PixelTools\PhantomJs\Tests\Unit;

use PixelTools\PhantomJs\Client;
use PixelTools\PhantomJs\Engine;
use PixelTools\PhantomJs\Http\MessageFactoryInterface;
use PixelTools\PhantomJs\Procedure\ProcedureLoaderInterface;
use PixelTools\PhantomJs\Procedure\ProcedureCompilerInterface;

/**
 * PHP PhantomJs
 *
 * @author PixelTools <support@pixeltools.ru>
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++++++ TESTS ++++++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Test can get client through
     * factory method.
     *
     * @access public
     * @return void
     */
    public function testCanGetClientThroughFactoryMethod()
    {
        $this->assertInstanceOf('\PixelTools\PhantomJs\Client', Client::getInstance());
    }

    /**
     * Test can get engine.
     *
     * @return void
     */
    public function testCanGetEngne()
    {
        $engine             = $this->getEngine();
        $procedureLoader    = $this->getProcedureLoader();
        $procedureCompiler  = $this->getProcedureCompiler();
        $messageFactory     = $this->getMessageFactory();

        $client = $this->getClient($engine, $procedureLoader, $procedureCompiler, $messageFactory);

        $this->assertInstanceOf('\PixelTools\PhantomJs\Engine', $client->getEngine());
    }

    /**
     * Test can get message factory
     *
     * @return void
     */
    public function testCanGetMessageFactory()
    {
        $engine             = $this->getEngine();
        $procedureLoader    = $this->getProcedureLoader();
        $procedureCompiler  = $this->getProcedureCompiler();
        $messageFactory     = $this->getMessageFactory();

        $client = $this->getClient($engine, $procedureLoader, $procedureCompiler, $messageFactory);

        $this->assertInstanceOf('\PixelTools\PhantomJs\Http\MessageFactoryInterface', $client->getMessageFactory());
    }

    /**
     * Test can get procedure loader.
     *
     * @return void
     */
    public function testCanGetProcedureLoader()
    {
        $engine             = $this->getEngine();
        $procedureLoader    = $this->getProcedureLoader();
        $procedureCompiler  = $this->getProcedureCompiler();
        $messageFactory     = $this->getMessageFactory();

        $client = $this->getClient($engine, $procedureLoader, $procedureCompiler, $messageFactory);

        $this->assertInstanceOf('\PixelTools\PhantomJs\Procedure\ProcedureLoaderInterface', $client->getProcedureLoader());
    }

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++ TEST ENTITIES ++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Get client instance
     *
     * @param  \PixelTools\PhantomJs\Engine                               $engine
     * @param  \PixelTools\PhantomJs\Procedure\ProcedureLoaderInterface   $procedureLoader
     * @param  \PixelTools\PhantomJs\Procedure\ProcedureCompilerInterface $procedureCompiler
     * @param  \PixelTools\PhantomJs\Http\MessageFactoryInterface         $messageFactory
     * @return \PixelTools\PhantomJs\Client
     */
    protected function getClient(Engine $engine, ProcedureLoaderInterface $procedureLoader, ProcedureCompilerInterface $procedureCompiler, MessageFactoryInterface $messageFactory)
    {
        $client = new Client($engine, $procedureLoader, $procedureCompiler, $messageFactory);

        return $client;
    }

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++ MOCKS / STUBS ++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Get engine
     *
     * @access protected
     * @return \PixelTools\PhantomJs\Engine
     */
    protected function getEngine()
    {
        $engine = $this->getMock('\PixelTools\PhantomJs\Engine');

        return $engine;
    }

    /**
     * Get message factory
     *
     * @access protected
     * @return \PixelTools\PhantomJs\Http\MessageFactoryInterface
     */
    protected function getMessageFactory()
    {
        $messageFactory = $this->getMock('\PixelTools\PhantomJs\Http\MessageFactoryInterface');

        return $messageFactory;
    }

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
     * Get procedure validator.
     *
     * @access protected
     * @return \PixelTools\PhantomJs\Procedure\ProcedureCompilerInterface
     */
    protected function getProcedureCompiler()
    {
        $procedureCompiler = $this->getMock('\PixelTools\PhantomJs\Procedure\ProcedureCompilerInterface');

        return $procedureCompiler;
    }
}
