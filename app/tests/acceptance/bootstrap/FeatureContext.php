<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Behat\Mink\Exception\ResponseTextException;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Features context.
 */
class FeatureContext extends MinkContext
{
    /**
     * Initializes context.
     * Every scenario gets its own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
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
     * @Given /^I am logged in$/
     */
    public function iAmLoggedIn()
    {
        $this->visit("/login");
        $this->fillField("username", "test");
        $this->fillField("password", "foo");
        $this->pressButton("Log in");
    }

    /**
     * @Given /^I fill in the blog form$/
     */
    public function iFillInTheBlogForm()
    {
        $this->visit("blog/create");
        $this->fillField("title", "Foo");
        $this->fillField("content", "Baring all the baz");
        $this->pressButton("Create Post");
    }

    /**
     * @Given /^I should see a flash message "([^"]*)"$/
     */
    public function iShouldSeeAFlashMessage($message)
    {
        //TODO: This doesn't always work, but does in live testing. Problem with Goutte?
        $session = $this->getMink()->getSession();
        $field = $session->getPage()->find("css", ".flash-message");
        if (!$field) {
            throw new ResponseTextException("There was no flash message.", $session);
        }
        if ($field->getText() != $message) {
            $message = sprintf('The text "%s" was not found anywhere in the flash message div.', $message);
            throw new ResponseTextException($message, $session);
        };
    }

    /**
     * @Given /^I fill in my login details$/
     */
    public function iFillInMyLoginDetails()
    {
        $this->fillField("username", "test");
        $this->fillField("password", "foo");
        $this->pressButton("Log in");
    }

    /**
     * @Then /^I should be logged in$/
     */
    public function iShouldBeLoggedIn()
    {
        $this->iAmOnHomepage();
        $this->assertPageContainsText("Logout");
    }

    /**
     * @Given /^I fill in invalid login details$/
     */
    public function iFillInInvalidLoginDetails()
    {
        $this->fillField("username", "test");
        $this->fillField("password", "foobar");
        $this->pressButton("Log in");
    }

    /**
     * @Then /^I should not be logged in$/
     */
    public function iShouldNotBeLoggedIn()
    {
        $this->assertPageNotContainsText("Logout");
        $this->assertPageContainsText("Login");
    }

    /**
     * @Given /^I fill in the blog form with invalid data$/
     */
    public function iFillInTheBlogFormWithInvalidData()
    {
        $this->fillField("title", "Foo");
        $this->pressButton("Create Post");
    }

    /**
     * @Given /^I create a blog post with title "([^"]*)" and content "([^"]*)"$/
     */
    public function iCreateABlogPostWithTitleAndContent($title, $content)
    {
        $this->visit("/blog/create");
        $this->fillField("title", $title);
        $this->fillField("content", $content);
    }
}
