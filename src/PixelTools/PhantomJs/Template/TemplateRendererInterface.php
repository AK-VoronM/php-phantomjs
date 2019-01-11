<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PixelTools\PhantomJs\Template;

/**
 * PHP PhantomJs
 *
 * @author PixelTools <support@pixeltools.ru>
 */
interface TemplateRendererInterface
{
    /**
     * Render template.
     *
     * @access public
     * @param  string $template
     * @param  array  $context  (default: array())
     * @return string
     */
    public function render($template, array $context = array());
}
