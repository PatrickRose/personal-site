<?php

require_once __DIR__ . "/../../../../vendor/autoload.php";

use Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
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
     * @Given /^I should see a flash message "([^"]*)"$/
     */
    public function iShouldSeeAFlashMessage($message)
    {
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
        $this->pressButton("Create Post");
    }

    /**
     * @Given /^I then log out$/
     */
    public function iThenLogOut()
    {
        $this->visit("/logout");
    }

    /**
     * @Given /^I then am on "([^"]*)"$/
     */
    public function iThenAmOn($uri)
    {
        $this->visit($uri);
    }

    /**
     * @Then /^I should see all blogs$/
     */
    public function iShouldSeeAllBlogs()
    {
        $this->assertPageContainsText("First Post");
        $this->assertPageContainsText("first post content");
        $this->assertPageContainsText("Second Post");
        $this->assertPageContainsText("second post content");
    }

    /**
     * @Then /^the title should be "([^"]*)"$/
     */
    public function theTitleShouldBe($title)
    {
        $session = $this->getMink()->getSession();
        $field = $session->getPage()->find("css", ".blog-title");
        if (!$field) {
            throw new ResponseTextException("There was no blog title.", $session);
        }
        if ($field->getText() != $title) {
            $message = sprintf('The text "%s" was not found exactly in the title.', $title);
            throw new ResponseTextException($message, $session);
        };
    }

    /**
     * @Given /^when I go to "([^"]*)" I should see the title "([^"]*)"$/
     */
    public function whenIGoToIShouldSeeTheTitle($url, $text)
    {
        $this->visit($url);
        $session = $this->getMink()->getSession();
        $fields = $session->getPage()->findAll("css", ".blog-title");
        $found = false;
        foreach($fields as $field) {
            if ($field->getText() == $text) {
                $found = true;
            }
        }
        if (!$found) throw new ResponseTextException("{$text} was not found on the page", $session);
    }

    /**
     * @Given /^I create a blog post with the title "([^"]*)" and content:$/
     */
    public function iCreateABlogPostWithTheTitleAndContent($title, PyStringNode $string)
    {
        $this->iCreateABlogPostWithTitleAndContent($title, $string->getRaw());
    }

    /**
     * @Then /^I should see the compiled markdown$/
     */
    public function iShouldSeeTheCompiledMarkdown() {
        $this->assertElementOnPage("h1");
        $this->assertElementOnPage("h2");
        $this->assertElementOnPage("em");
        $this->assertElementOnPage("strong");
        $this->assertElementOnPage("ol");
        $this->assertElementOnPage("li");
        $this->assertElementOnPage("ul");
    }

    /**
     * @Given /^I create (\d+) blog posts$/
     */
    public function iCreateBlogPosts($number)
    {
        $factory = Faker\Factory::create();
        for($i = 0; $i<$number; $i++) {
            $title = implode(" ", $factory->words(5));
            $content = implode("\n\n", $factory->paragraphs(5));
            $this->iCreateABlogPostWithTitleAndContent($title, $content);
        }
    }

    /**
     * @Given /^I should see (\d+) copies of "([^"]*)"$/
     */
    public function iShouldSee($number, $title)
    {
        $session = $this->getMink()->getSession();
        $search = $session->getPage()->findAll('css', $title);
        if (!$search) {
            throw new ResponseTextException("I couldn't find {$title}.", $session);
        }
        $count = 0;
        foreach($search as $i) {
            $count++;
        }
        if ($number != $count) {
            throw new ResponseTextException("I wanted {$number} of {$title}, but only found {$count}.", $session);
        }
    }

    /**
     * @Given /^when I go to "([^"]*)" I should see the compiled markdown$/
     */
    public function whenIGoToIShouldSeeTheCompiledMarkdown($url)
    {
        $this->visit($url);
        $this->iShouldSeeTheCompiledMarkdown();
    }

    /**
     * @Given /^I run "([^"]*)"$/
     */
    public function iRun($arg1)
    {
        exec($arg1, $output, $return);
    }

    /**
     * @Given /^I shouldn\'t see "([^"]*)"$/
     */
    public function iShouldntSee($arg1)
    {
        $this->assertPageNotContainsText($arg1);
    }
}
