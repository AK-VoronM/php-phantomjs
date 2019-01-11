<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PixelTools\PhantomJs\Tests\Unit;

use PixelTools\PhantomJs\StringUtils;

/**
 * PHP PhantomJs
 *
 * @author PixelTools <support@pixeltools.ru>
 */
class StringUtilsTest extends \PHPUnit_Framework_TestCase
{

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++++++ TESTS ++++++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Test can generate random string for
     * specific length
     *
     * @access public
     * @return void
     */
    public function testCanGenerateRandomStringForSpecificLength()
    {
        $string = StringUtils::random(14);

        $this->assertEquals(14, strlen($string));
    }

    /**
     * Test random string is random
     *
     * @access public
     * @return void
     */
    public function testRandomStringIsRandom()
    {
        $string1 = StringUtils::random(14);
        $string2 = StringUtils::random(14);

        $this->assertNotEquals($string1, $string2);
    }
}
