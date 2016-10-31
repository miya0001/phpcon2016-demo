<?php

use Behat\Mink\Driver\Selenium2Driver;
use Behat\Behat\Hook\Scope\AfterStepScope;
use Behat\MinkExtension\Context\RawMinkContext;

/**
 * Features context.
 */
class FeatureContext extends RawMinkContext
{
	/**
	 * Initializes context.
	 * Every scenario gets it's own context object.
	 *
	 * @param array $parameters context parameters (set them up through behat.yml)
	 */
	public function __construct()
	{
		// Initialize your context here
	}

	/**
	 * @AfterStep
	 */
	public function take_screenshot_after_fail(afterStepScope $scope)
	{
		if ( 99 === $scope->getTestResult()->getResultCode() ) {
			$driver = $this->getSession()->getDriver();
			if ( ! ( $driver instanceof Selenium2Driver ) ) {
				return;
			}

			$image = $this->getSession()->getDriver()->getScreenshot();
			file_put_contents('/tmp/test.png', $image );
		}
	}
}
