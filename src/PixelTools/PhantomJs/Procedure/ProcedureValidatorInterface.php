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
interface ProcedureValidatorInterface
{
    /**
     * Validate procedure.
     *
     * @access public
     * @param  string                                                   $procedure
     * @return boolean
     * @throws \PixelTools\PhantomJs\Exception\ProcedureValidationException
     */
    public function validate($procedure);
}
