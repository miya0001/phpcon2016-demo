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

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

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
     * @Given /^The screen size is ([0-9]+)x([0-9]+)/
     */
    public function setBrowserWindowToDesktop( $width, $height ) {
        if( $this->getSession()->getDriver() instanceof \Behat\Mink\Driver\Selenium2Driver ) {
            $this->getSession()->getDriver()->resizeWindow( $width, $height, 'current' );
        }
    }
}
