<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PixelTools\PhantomJs\Procedure;

/**
 * PHP PhantomJs
 *
 * @author PixelTools <support@pixeltools.ru>
 */
interface ProcedureLoaderInterface
{
    /**
     * Load procedure instance by id.
     *
     * @access public
     * @param  string                                         $id
     * @return \PixelTools\PhantomJs\Procedure\ProcedureInterface
     */
    public function load($id);

    /**
     * Load procedure template by id.
     *
     * @access public
     * @param  string $id
     * @param  string $extension (default: 'proc')
     * @return string
     */
    public function loadTemplate($id, $extension = 'proc');
}
