<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PixelTools\PhantomJs\Http;

/**
 * PHP PhantomJs
 *
 * @author PixelTools <support@pixeltools.ru>
 */
class Request extends AbstractRequest
{
    /**
     * Request type
     *
     * @var string
     * @access protected
     */
    protected $type;

    /**
     * Get request type
     *
     * @access public
     * @return string
     */
    public function getType()
    {
        if (!$this->type) {
            return RequestInterface::REQUEST_TYPE_DEFAULT;
        }

        return $this->type;
    }

    /**
     * Set request type
     *
     * @access public
     * @param  string                                 $type
     * @return \PixelTools\PhantomJs\Http\AbstractRequest
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}
