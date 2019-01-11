<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PixelTools\PhantomJs;

use PixelTools\PhantomJs\Exception\InvalidExecutableException;

/**
 * PHP PhantomJs
 *
 * @author PixelTools <support@pixeltools.ru>
 */
class Engine
{
    /**
     * Executable path.
     *
     * @var string
     * @access protected
     */
    protected $path;

    /**
     * Debug flag.
     *
     * @var boolean
     * @access protected
     */
    protected $debug;

    /**
     * Cache flag.
     *
     * @var boolean
     * @access protected
     */
    protected $cache;

    /**
     * PhantomJs run options.
     *
     * @var array
     * @access protected
     */
    protected $options;

    /**
     * PhantomJs system command need for additional system params
     *
     * @var string
     */
    protected $system_cmd = "timeout -k 30s 25s";

    /**
     * Log info
     *
     * @var string
     * @access protected
     */
    protected $log;

    /**
     * Internal constructor
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->path    = 'bin/phantomjs';
        $this->options = array();

        $this->debug = false;
        $this->cache = true;
    }

    /**
     * Get PhantomJs run command with
     * loader run options.
     *
     * @access public
     * @return string
     */
    public function getCommand()
    {
        $path    = $this->getPath();
        $options = $this->getOptions();
        $sys_cmd = $this->getSystemCMD();

        $this->validateExecutable($path);

        if ($this->cache) {
            array_push($options, '--disk-cache=true');
        }

        if ($this->debug) {
            array_push($options, '--debug=true');
        }

        return $r = sprintf('%s %s', $path, implode(' ', $options));;
    }

    /**
     * Set system CMD
     *
     * @param string $string
     */
    public function setSystemCMD($string)
    {
        $this->system_cmd = $string;
    }

    /**
     * return system CMD
     *
     * @return string
     */
    public function getSystemCMD()
    {
        return $this->system_cmd;
    }

    /**
     * Set path.
     *
     * @access public
     * @param  string                   $path
     * @return \PixelTools\PhantomJs\Client
     */
    public function setPath($path)
    {
        $this->validateExecutable($path);

        $this->path = $path;

        return $this;
    }

    /**
     * Get path.
     *
     * @access public
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set PhantomJs run options.
     *
     * @access public
     * @param  array                    $options
     * @return \PixelTools\PhantomJs\Client
     */
    public function setOptions(array $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get PhantomJs run options.
     *
     * @access public
     * @return array
     */
    public function getOptions()
    {
        return (array) $this->options;
    }

    /**
     * Add single PhantomJs run option.
     *
     * @access public
     * @param  string                   $option
     * @return \PixelTools\PhantomJs\Client
     */
    public function addOption($option)
    {
        if (!in_array($option, $this->options)) {
            $this->options[] = $option;
        }

        return $this;
    }

    /**
     * Debug.
     *
     * @access public
     * @param  boolean                  $doDebug
     * @return \PixelTools\PhantomJs\Client
     */
    public function debug($doDebug)
    {
        $this->debug = $doDebug;

        return $this;
    }

    /**
     * Cache.
     *
     * @access public
     * @param  boolean                  $doCache
     * @return \PixelTools\PhantomJs\Client
     */
    public function cache($doCache)
    {
        $this->cache = $doCache;

        return $this;
    }

    /**
     * Log info.
     *
     * @access public
     * @param  string                   $info
     * @return \PixelTools\PhantomJs\Client
     */
    public function log($info)
    {
        $this->log = $info;

        return $this;
    }

    /**
     * Get log info.
     *
     * @access public
     * @return string
     */
    public function getLog()
    {
        return $this->log;
    }

    /**
     * Clear log info.
     *
     * @access public
     * @return \PixelTools\PhantomJs\Client
     */
    public function clearLog()
    {
        $this->log = '';

        return $this;
    }

    /**
     * Validate execuable file.
     *
     * @access private
     * @param  string                                                 $file
     * @return boolean
     * @throws \PixelTools\PhantomJs\Exception\InvalidExecutableException
     */
    private function validateExecutable($file)
    {
        if (!file_exists($file) || !is_executable($file)) {
            throw new InvalidExecutableException(sprintf('File does not exist or is not executable: %s', $file));
        }

        return true;
    }
}
