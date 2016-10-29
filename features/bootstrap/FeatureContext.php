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
//
// Place your definition and hook methods here:
//
//    /**
//     * @Given /^I have done something with "([^"]*)"$/
//     */
//    public function iHaveDoneSomethingWith($argument)
//    {
//        doSomethingWith($argument);
//    }
//
    /**
     *@BeforeScenario @javascript,@desktop
     */
    public function setBrowserWindowToDesktop() {
        if($this->getSession()->getDriver() instanceof \Behat\Mink\Driver\Selenium2Driver) {
            $this->getSession()->getDriver()->resizeWindow(1440, 900, 'current');
        }
    }
    /**
     *@BeforeScenario @javascript&&@tablet&&@portrait
     */
    public function setBrowserWindowToTabletPortrait() {
        if($this->getSession()->getDriver() instanceof \Behat\Mink\Driver\Selenium2Driver) {
            $this->getSession()->getDriver()->resizeWindow(768, 1024, 'current');
        }
    }
    /**
     *@BeforeScenario @javascript&&@tablet&&@landscape
     */
    public function setBrowserWindowToTabletLandscape() {
        if($this->getSession()->getDriver() instanceof \Behat\Mink\Driver\Selenium2Driver) {
            $this->getSession()->getDriver()->resizeWindow(1024, 768, 'current');
        }
    }
    /**
     *@BeforeScenario @javascript&&@smartphone&&@landscape
     */
    public function setBrowserWindowToSmartphoneLandscape() {
        if($this->getSession()->getDriver() instanceof \Behat\Mink\Driver\Selenium2Driver) {
            $this->getSession()->getDriver()->resizeWindow(480, 320, 'current');
        }
    }
    /**
     *@BeforeScenario @smartphone && @portrait
     */
    public function setBrowserWindowToSmartphonePortrait() {
        if($this->getSession()->getDriver() instanceof \Behat\Mink\Driver\Selenium2Driver) {
            $this->getSession()->getDriver()->resizeWindow(320, 480, 'current');
        }
    }
    /**
     *@BeforeScenario @widescreen
     */
    public function setBrowserWindowToWidescreen() {
        if($this->getSession()->getDriver() instanceof \Behat\Mink\Driver\Selenium2Driver) {
            $this->getSession()->getDriver()->resizeWindow(1920, 1080, 'current');
        }
    }
}
