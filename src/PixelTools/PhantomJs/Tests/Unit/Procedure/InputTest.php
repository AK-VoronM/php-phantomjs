<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PixelTools\PhantomJs\Tests\Unit\Procedure;

use PixelTools\PhantomJs\Procedure\Input;

/**
 * PHP PhantomJs
 *
 * @author PixelTools <support@pixeltools.ru>
 */
class InputTest extends \PHPUnit_Framework_TestCase
{

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++++++ TESTS ++++++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Test data storage.
     *
     * @access public
     * @return void
     */
    public function testDataStorage()
    {
        $input = $this->getInput();
        $input->set('test', 'Test value');

        $this->assertSame('Test value', $input->get('test'));
    }

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++ TEST ENTITIES ++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Get input.
     *
     * @access protected
     * @return \PixelTools\PhantomJs\Procedure\Input
     */
    protected function getInput()
    {
        $input = new Input();

        return $input;
    }
}
