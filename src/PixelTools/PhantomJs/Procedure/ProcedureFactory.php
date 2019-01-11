<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PixelTools\PhantomJs\Procedure;

use PixelTools\PhantomJs\Engine;
use PixelTools\PhantomJs\Cache\CacheInterface;
use PixelTools\PhantomJs\Parser\ParserInterface;
use PixelTools\PhantomJs\Template\TemplateRendererInterface;

/**
 * PHP PhantomJs
 *
 * @author PixelTools <support@pixeltools.ru>
 */
class ProcedureFactory implements ProcedureFactoryInterface
{
    /**
     * PhantomJS engine
     *
     * @var \PixelTools\PhantomJs\Engine
     * @access protected
     */
    protected $engine;

    /**
     * Parser.
     *
     * @var \PixelTools\PhantomJs\Parser\ParserInterface
     * @access protected
     */
    protected $parser;

    /**
     * Cache handler.
     *
     * @var \PixelTools\PhantomJs\Cache\CacheInterface
     * @access protected
     */
    protected $cacheHandler;

    /**
     * Template renderer.
     *
     * @var \PixelTools\PhantomJs\Template\TemplateRendererInterface
     * @access protected
     */
    protected $renderer;

    /**
     * Internal constructor.
     *
     * @access public
     * @param \PixelTools\PhantomJs\Engine                             $engine
     * @param \PixelTools\PhantomJs\Parser\ParserInterface             $parser
     * @param \PixelTools\PhantomJs\Cache\CacheInterface               $cacheHandler
     * @param \PixelTools\PhantomJs\Template\TemplateRendererInterface $renderer
     */
    public function __construct(Engine $engine, ParserInterface $parser, CacheInterface $cacheHandler, TemplateRendererInterface $renderer)
    {
        $this->engine       = $engine;
        $this->parser       = $parser;
        $this->cacheHandler = $cacheHandler;
        $this->renderer     = $renderer;
    }

    /**
     * Create new procedure instance.
     *
     * @access public
     * @return \PixelTools\PhantomJs\Procedure\Procedure
     */
    public function createProcedure()
    {
        $procedure = new Procedure(
            $this->engine,
            $this->parser,
            $this->cacheHandler,
            $this->renderer
        );

        return $procedure;
    }
}
