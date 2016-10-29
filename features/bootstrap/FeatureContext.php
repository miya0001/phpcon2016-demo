<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use Behat\MinkExtension\Context\MinkContext,
    Behat\Behat\Event\StepEvent,
    Drupal\DrupalExtension\Context\DrupalContext;

/**
 * Features context.
 */
class FeatureContext extends DrupalContext
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
	 * @When /^I Wait for the page to be loaded$/
	 */
	public function waitForThePageToBeLoaded()
	{
	    $this->getSession()->wait( 10000, "document.readyState === 'complete'" );
	}

	/**
	 * @param int $width The screen width.
	 * @param int $height The screen height.
	 * @Given /^The screen size is ([0-9]+)x([0-9]+)/
	 */
	public function set_window_size( $width, $height )
	{
		if( $this->getSession()->getDriver() instanceof \Behat\Mink\Driver\Selenium2Driver ) {
			$this->getSession()->getDriver()->resizeWindow( $width, $height, 'current' );
		}
	}

	/**
	 * @param string $user The user name.
	 * @param string $password The password.
	 * @Given /^I login as ([a-zA-Z0-9_]+) with password ([a-zA-Z0-9_]+)$/
	 */
	public function wp_login( $user, $password )
	{
		$this->wp_logout();

		$this->getSession()->visit( $this->locatePath( '/wp-login.php' ) );
		$element = $this->getSession()->getPage();
		$element->fillField( "user_login", $user );
		$element->fillField( "user_pass", $password );
		$submit = $element->findButton( "wp-submit" );
		if ( empty( $submit ) ) {
			throw new \Exception( sprintf(
				"No submit button at %s",
				$this->getSession()->getCurrentUrl()
			));
		}

		$submit->click();
	}

	/**
	 * @Given /^I logout$/
	 */
	public function wp_logout()
	{
		$this->logout_from_wp();
	}

	private function logout_from_wp()
	{
		$page = $this->getSession()->getPage();
		$logout = $page->find( "css", "#wp-admin-bar-logout a" );
		if ( ! empty( $logout ) ) {
			$this->getSession()->visit( $this->locatePath( $logout->getAttribute( "href" ) ) );
		}
	}
}
