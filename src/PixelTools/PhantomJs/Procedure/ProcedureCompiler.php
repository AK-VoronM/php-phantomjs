<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PixelTools\PhantomJs\Procedure;

use PixelTools\PhantomJs\Cache\CacheInterface;
use PixelTools\PhantomJs\Template\TemplateRendererInterface;

/**
 * PHP PhantomJs
 *
 * @author PixelTools <support@pixeltools.ru>
 */
class ProcedureCompiler implements ProcedureCompilerInterface
{
    /**
     * Procedure loader
     *
     * @var \PixelTools\PhantomJs\Procedure\ProcedureLoaderInterface
     * @access protected
     */
    protected $procedureLoader;

    /**
     * Procedure validator
     *
     * @var \PixelTools\PhantomJs\Procedure\ProcedureValidatorInterface
     * @access protected
     */
    protected $procedureValidator;

    /**
     * Cache handler
     *
     * @var \PixelTools\PhantomJs\Cache\CacheInterface
     * @access protected
     */
    protected $cacheHandler;

    /**
     * Renderer
     *
     * @var \PixelTools\PhantomJs\Template\TemplateRendererInterface
     * @access protected
     */
    protected $renderer;

    /**
     * Cache enabled
     *
     * @var boolean
     * @access protected
     */
    protected $cacheEnabled;

    /**
     * Internal constructor
     *
     * @access public
     * @param \PixelTools\PhantomJs\Procedure\ProcedureLoaderInterface    $procedureLoader
     * @param \PixelTools\PhantomJs\Procedure\ProcedureValidatorInterface $procedureValidator
     * @param \PixelTools\PhantomJs\Cache\CacheInterface                  $cacheHandler
     * @param \PixelTools\PhantomJs\Template\TemplateRendererInterface    $renderer
     */
    public function __construct(ProcedureLoaderInterface $procedureLoader, ProcedureValidatorInterface $procedureValidator,
        CacheInterface $cacheHandler, TemplateRendererInterface $renderer)
    {
        $this->procedureLoader    = $procedureLoader;
        $this->procedureValidator = $procedureValidator;
        $this->cacheHandler       = $cacheHandler;
        $this->renderer           = $renderer;
        $this->cacheEnabled       = true;
    }

    /**
     * Compile partials into procedure.
     *
     * @access public
     * @param  \PixelTools\PhantomJs\Procedure\ProcedureInterface $procedure
     * @param  \PixelTools\PhantomJs\Procedure\InputInterface     $input
     * @return void
     */
    public function compile(ProcedureInterface $procedure, InputInterface $input)
    {
        $cacheKey = sprintf('phantomjs_%s_%s', $input->getType(), md5($procedure->getTemplate()));

        if ($this->cacheEnabled && $this->cacheHandler->exists($cacheKey)) {
            $template = $this->cacheHandler->fetch($cacheKey);
        }

        if (empty($template)) {

            $template  = $this->renderer
                ->render($procedure->getTemplate(), array('engine' => $this, 'procedure_type' => $input->getType()));

            $test = clone $procedure;
            $test->setTemplate($template);

            $compiled = $test->compile($input);

            $this->procedureValidator->validate($compiled);

            if ($this->cacheEnabled) {
                $this->cacheHandler->save($cacheKey, $template);
            }
        }

        $procedure->setTemplate($template);
    }

    /**
     * Load partial template.
     *
     * @access public
     * @param  string $name
     * @return string
     */
    public function load($name)
    {
        return $this->procedureLoader->loadTemplate($name, 'partial');
    }

    /**
     * Enable cache.
     *
     * @access public
     * @return void
     */
    public function enableCache()
    {
        $this->cacheEnabled = true;
    }

    /**
     * Disable cache.
     *
     * @access public
     * @return void
     */
    public function disableCache()
    {
        $this->cacheEnabled = false;
    }

    /**
     * Clear cache.
     *
     * @access public
     * @return void
     */
    public function clearCache()
    {
        $this->cacheHandler->delete('phantomjs_*');
    }
}
