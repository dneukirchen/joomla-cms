<?php
/**
 * @package	    Joomla.UnitTest
 * @subpackage  Toolbar
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license	    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Tests\Unit\Cms\Toolbar\Button;

use Joomla\CMS\Toolbar\Button\CustomButton;
use Tests\Unit\UnitTestCase;

/**
 * Test class for CustomButton.
 *
 * @package     Joomla.UnitTest
 * @subpackage  Toolbar
 * @since       3.0
 */
class CustomButtonTest extends UnitTestCase
{
	/**
	 * Tests the fetchButton method
	 *
	 * @return  void
	 *
	 * @since   3.0
	 */
	public function testFetchButton()
	{
		$button = new CustomButton;
		$html = '<div class="custom-button"><a href="#">My Custom Button</a></div>';

		$this->assertEquals($html, $button->fetchButton('Custom', $html));
	}
}
