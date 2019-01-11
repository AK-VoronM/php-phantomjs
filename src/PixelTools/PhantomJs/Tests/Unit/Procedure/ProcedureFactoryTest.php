<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PixelTools\PhantomJs\Tests\Unit\Procedure;

use Twig_Environment;
use Twig_Loader_String;
use PixelTools\PhantomJs\Engine;
use PixelTools\PhantomJs\Cache\FileCache;
use PixelTools\PhantomJs\Cache\CacheInterface;
use PixelTools\PhantomJs\Parser\JsonParser;
use PixelTools\PhantomJs\Parser\ParserInterface;
use PixelTools\PhantomJs\Template\TemplateRenderer;
use PixelTools\PhantomJs\Template\TemplateRendererInterface;
use PixelTools\PhantomJs\Procedure\ProcedureFactory;

/**
 * PHP PhantomJs
 *
 * @author PixelTools <support@pixeltools.ru>
 */
class ProcedureFactoryTest extends \PHPUnit_Framework_TestCase
{

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++++++ TESTS ++++++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Test factory can create instance of
     * procedure.
     *
     * @access public
     * @return void
     */
    public function testFactoryCanCreateInstanceOfProcedure()
    {
        $engine    = $this->getEngine();
        $parser    = $this->getParser();
        $cache     = $this->getCache();
        $renderer  = $this->getRenderer();

        $procedureFactory = $this->getProcedureFactory($engine, $parser, $cache, $renderer);

        $this->assertInstanceOf('\PixelTools\PhantomJs\Procedure\Procedure', $procedureFactory->createProcedure());
    }

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++ TEST ENTITIES ++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Get procedure factory instance.
     *
     * @access protected
     * @param  \PixelTools\PhantomJs\Engine                             $engine
     * @param  \PixelTools\PhantomJs\Parser\ParserInterface             $parser
     * @param  \PixelTools\PhantomJs\Cache\CacheInterface               $cacheHandler
     * @param  \PixelTools\PhantomJs\Template\TemplateRendererInterface $renderer
     * @return \PixelTools\PhantomJs\Procedure\ProcedureFactory
     */
    protected function getProcedureFactory(Engine $engine, ParserInterface $parser, CacheInterface $cacheHandler, TemplateRendererInterface $renderer)
    {
        $procedureFactory = new ProcedureFactory($engine, $parser, $cacheHandler, $renderer);

        return $procedureFactory;
    }

    /**
     * Get engine.
     *
     * @access protected
     * @return \PixelTools\PhantomJs\Engine
     */
    protected function getEngine()
    {
        $engine = new Engine();

        return $engine;
    }

    /**
     * Get parser.
     *
     * @access protected
     * @return \PixelTools\PhantomJs\Parser\JsonParser
     */
    protected function getParser()
    {
        $parser = new JsonParser();

        return $parser;
    }

    /**
     * Get cache.
     *
     * @access protected
     * @param  string                            $cacheDir  (default: '')
     * @param  string                            $extension (default: 'proc')
     * @return \PixelTools\PhantomJs\Cache\FileCache
     */
    protected function getCache($cacheDir = '', $extension = 'proc')
    {
        $cache = new FileCache(($cacheDir ? $cacheDir : sys_get_temp_dir()), 'proc');

        return $cache;
    }

    /**
     * Get template renderer.
     *
     * @access protected
     * @return \PixelTools\PhantomJs\Template\TemplateRenderer
     */
    protected function getRenderer()
    {
        $twig = new Twig_Environment(
            new Twig_Loader_String()
        );

        $renderer = new TemplateRenderer($twig);

        return $renderer;
    }
}
