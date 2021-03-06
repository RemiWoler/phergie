<?php
/**
 * Phergie
 *
 * PHP version 5
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.
 * It is also available through the world-wide-web at this URL:
 * http://phergie.org/license
 *
 * @category  Phergie
 * @package   Phergie_Tests
 * @author    Phergie Development Team <team@phergie.org>
 * @copyright 2008-2011 Phergie Development Team (http://phergie.org)
 * @license   http://phergie.org/license New BSD License
 * @link      http://pear.phergie.org/package/Phergie_Tests
 */

/**
 * Unit test suite for Phergie_Plugin_UserInfo.
 *
 * @category Phergie
 * @package  Phergie_Tests
 * @author   Phergie Development Team <team@phergie.org>
 * @license  http://phergie.org/license New BSD License
 * @link     http://pear.phergie.org/package/Phergie_Tests
 */
class Phergie_Plugin_UserInfoTest extends Phergie_Plugin_TestCase
{
    /**
     * Tests for appropriate plugin requirements.
     *
     * @return void
     */
    public function testPluginRequirements()
    {
        $this->assertRequiresPlugin('Command');
        $this->plugin->onLoad();
    }

    /* Mock methods follow */
    private function mockUserJoin()
    {
        $this->plugin->onLoad();
        $args = array(
            1 => '',
            0 => ":#test",
        );
        $event = $this->getMockEvent('join', $args, 'foobar', ':#test');
        $this->plugin->setEvent($event);
        $this->plugin->onJoin();
    }

    public function testUserIsInChannelAfterJoin()
    {
        $this->mockUserJoin();
        $this->assertEquals(true, $this->plugin->isIn('foobar', '#test'));
    }

    public function testOtherUserIsNotInChannelAfterJoin()
    {
        $this->mockUserJoin();
        $this->assertEquals(false, $this->plugin->isIn('foobar2', '#test'));
    }

}
