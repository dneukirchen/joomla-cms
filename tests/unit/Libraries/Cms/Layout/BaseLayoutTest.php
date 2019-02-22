<?php
/**
 * @package        Joomla.UnitTest
 * @subpackage     Layout
 *
 * @copyright      Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license        GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Tests\Unit\Cms\Layout;

use Joomla\CMS\Layout\BaseLayout;
use Joomla\Registry\Registry;
use Tests\Unit\UnitTestCase;

class BaseLayoutTest extends UnitTestCase
{
	/**
	 * @var BaseLayout
	 */
	protected $baseLayout;

	/**
	 * Sets up the test by instantiating BaseLayout
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{
		$this->baseLayout = new BaseLayout;

		parent::setUp();
	}

	/**
	 * This method is called after a test is executed.
	 */
	protected function tearDown()
	{
		unset($this->baseLayout);

		parent::tearDown();
	}

	/**
	 * @testdox  BaseLayout->setOptions() returns a BaseLayout instance with empty parameter.
	 *
	 * @since    3.3.7
	 */
	public function testSetOptionsReturnsInstanceWithEmptyParameters()
	{
		$this->assertInstanceOf(BaseLayout::class, $this->baseLayout->setOptions());
	}

	/**
	 * @testdox  BaseLayout->setOptions() returns a BaseLayout instance with JRegistry parameter.
	 *
	 * @since    3.3.7
	 */
	public function testSetOptionsReturnsInstanceWithRegistryParameter()
	{
		$registry = $this->createMock(Registry::class);

		$this->assertInstanceOf(BaseLayout::class, $this->baseLayout->setOptions($registry));
	}

	/**
	 * @testdox  BaseLayout->setOptions() returns a BaseLayout instance with an array parameter.
	 *
	 * @since    3.3.7
	 */
	public function testSetOptionsReturnsInstanceWithAnArrayParameter()
	{
		$this->assertInstanceOf(BaseLayout::class, $this->baseLayout->setOptions([]));
	}

	/**
	 * @testdox  BaseLayout->getOptions() returns a JRegistry object when options parameter is empty.
	 *
	 * @since    3.3.7
	 */
	public function testGetOptionsReturnsAnEmptyRegistryObject()
	{
		$options = $this->baseLayout->getOptions();

		$this->assertInstanceOf(Registry::class, $options);
		$this->assertEmpty($options->toArray());
	}

	/**
	 * @testdox  BaseLayout->getOptions() returns a JRegistry object when options parameter is an array.
	 *
	 * @since    3.3.7
	 */
	public function testGetOptionsReturnsAnRegistryObjectWhenOptionsIsArray()
	{
		$this->baseLayout->setOptions([]);

		$options = $this->baseLayout->getOptions();

		$this->assertInstanceOf(Registry::class, $options);
	}

	/**
	 * @testdox  BaseLayout->getOptions() returns a JRegistry object when options parameter is a JRegistry object.
	 *
	 * @since    3.3.7
	 */
	public function testGetOptionsReturnsARegistryObjectWhenOptionsParameterIsRegistryObject()
	{
		$registry = $this->createMock(Registry::class);
		$this->baseLayout->setOptions($registry);

		$options = $this->baseLayout->getOptions();

		$this->assertInstanceOf(Registry::class, $options);
	}

	/**
	 * @testdox  BaseLayout->resetOptions() and check options is empty.
	 *
	 * @since    3.3.7
	 */
	public function testResetOptions()
	{
		$this->baseLayout->setOptions(['not' => 'empty']);

		$this->baseLayout->resetOptions();

		$this->assertEmpty($this->baseLayout->getOptions()->toArray());
	}

	/**
	 * Tests the escape method.
	 *
	 * @since   3.3.7
	 */
	public function testEscapingSpecialCharactersIntoHtmlEntities()
	{
		$this->assertThat(
			$this->baseLayout->escape('&'),
			$this->equalTo('&amp;'),
			'Test the ampersand is converted to HTML code'
		);

		$this->assertThat(
			$this->baseLayout->escape('"'),
			$this->equalTo('&quot;'),
			'Test the double quote is converted to HTML code'
		);

		$this->assertThat(
			$this->baseLayout->escape("'"),
			$this->equalTo("&#039;"),
			'Test the single quote is converted to HTML code'
		);

		$this->assertThat(
			$this->baseLayout->escape("<a href='test'>Test</a>"),
			$this->equalTo("&lt;a href=&#039;test&#039;&gt;Test&lt;/a&gt;"),
			'Test the characters <> are not converted'
		);
	}

	/**
	 * Test the adding of debug messages.
	 *
	 * @since   3.3.7
	 */
	public function testAddDebugMessageToTheQueue()
	{
		$message = 'Unit Test';

		$this->baseLayout->addDebugMessage($message);

		$messages = $this->baseLayout->getDebugMessages();

		$this->assertCount(1, $messages);
		$this->assertEquals($message, $messages[0]);
	}

	/**
	 * @testdox  JLayoutBase->getDebugMessages() retrieves a list of debug messages in an array.
	 *
	 * @since    3.3.7
	 */
	public function testRetrievingTheListOfDebugMessagesIsAnArray()
	{
		$this->assertInternalType('array', $this->baseLayout->getDebugMessages());
	}

	/**
	 * @testdox  JLayoutBase->renderDebugMessages() returns debug message
	 *
	 * @since    3.3.7
	 */
	public function testRenderDebugMessageReturnsDebugMessage()
	{
		$this->baseLayout->addDebugMessage('Debug message 1');

		$this->assertEquals("Debug message 1", $this->baseLayout->renderDebugMessages());
	}

	/**
	 * @testdox  JLayoutBase->renderDebugMessages() returns string of messages separated by newline character.
	 *
	 * @since    3.3.7
	 */
	public function testRenderDebugMessageReturnsStringOfMessagesSeparatedByNewlineCharacter()
	{
		$this->baseLayout->addDebugMessage('Debug message 1');
		$this->baseLayout->addDebugMessage('Debug message 2');

		$this->assertEquals("Debug message 1\nDebug message 2", $this->baseLayout->renderDebugMessages());
	}

	/**
	 * @testdox  JLayoutBase->render() returns an empty string.
	 *
	 * @since    3.3.7
	 */
	public function testRenderReturnsAnEmptyString()
	{
		$this->assertEquals('', $this->baseLayout->render('Data'), 'BaseLayout::render does not render an output');
	}
}
