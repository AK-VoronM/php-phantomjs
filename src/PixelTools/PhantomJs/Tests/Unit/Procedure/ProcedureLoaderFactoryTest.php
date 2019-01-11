<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PixelTools\PhantomJs\Tests\Unit\Procedure;

use PixelTools\PhantomJs\Procedure\ProcedureFactoryInterface;
use PixelTools\PhantomJs\Procedure\ProcedureLoaderFactory;

/**
 * PHP PhantomJs
 *
 * @author PixelTools <support@pixeltools.ru>
 */
class ProcedureLoaderFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test directory
     *
     * @var string
     * @access protected
     */
    protected $directory;

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++++++ TESTS ++++++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Test invalid argument exceptions is thrown if directory
     * is not readable when creating procedure loader.
     *
     * @access public
     * @return void
     */
    public function testInvalidArgumentExceptionIsThrownIfDirectoryIsNotReadableWhenCreatingProcedureLoader()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $procedureFactory = $this->getProcedureFactory();

        $procedureLoaderFactory = $this->getProcedureLoaderFactory($procedureFactory);
        $procedureLoaderFactory->createProcedureLoader('invalid/directory');
    }

    /**
     * Test procedure loader can be created.
     *
     * @access public
     * @return void
     */
    public function testProcedureLoaderCanBeCreated()
    {
        $procedureFactory = $this->getProcedureFactory();

        $procedureLoaderFactory = $this->getProcedureLoaderFactory($procedureFactory);
        $procedureLoader = $procedureLoaderFactory->createProcedureLoader($this->directory);

        $this->assertInstanceOf('\PixelTools\PhantomJs\Procedure\ProcedureLoaderInterface', $procedureLoader);
    }

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++ TEST ENTITIES ++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Get procedure loader factory instance.
     *
     * @access public
     * @param  \PixelTools\PhantomJs\Procedure\ProcedureFactoryInterface $procedureFactory
     * @return \PixelTools\PhantomJs\Procedure\ProcedureLoaderFactory
     */
    protected function getProcedureLoaderFactory(ProcedureFactoryInterface $procedureFactory)
    {
        $procedureLoaderFactory = new ProcedureLoaderFactory($procedureFactory);

        return $procedureLoaderFactory;
    }

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++ MOCKS / STUBS ++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Get procedure factory.
     *
     * @access protected
     * @return \PixelTools\PhantomJs\Procedure\ProcedureFactoryInterface
     */
    protected function getProcedureFactory()
    {
        $procedureFactory = $this->getMock('\PixelTools\PhantomJs\Procedure\ProcedureFactoryInterface');

        return $procedureFactory;
    }

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++++ UTILITIES ++++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Set up test environment.
     *
     * @access public
     * @return void
     */
    public function setUp()
    {
        $this->directory = sys_get_temp_dir();

        if (!is_readable($this->directory)) {
            throw new \RuntimeException(sprintf('Test directory must be readable: %s', $this->directory));
        }
    }
}
