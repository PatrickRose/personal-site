<?php

require_once __DIR__ . "/../../../../bootstrap/start.php";

use Behat\Behat\Event\FeatureEvent;
use Behat\Behat\Event\ScenarioEvent;
use Behat\Behat\Event\SuiteEvent;
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
     * @BeforeScenario
     */
    public static function before(ScenarioEvent $event)
    {
        Artisan::call('migrate:refresh', array("seed"));
    }
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
            $blog = new Blog();
            $blog->title = $title;
            $blog->content = $content;
            $blog->slug = $blog->makeSlug();
            $blog->save();
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

    /**
     * @Given /^I should see a button saying "([^"]*)"$/
     */
    public function iShouldSeeAButtonSaying($text)
    {
        $session = $this->getMink()->getSession();
        $field = $session->getPage()->find("css", ".btn-blog");
        if (!$field) {
            throw new ResponseTextException("I couldn't find the button.", $session);
        }
        if ($field->getText() != $text) {
            throw new ResponseTextException("The text of the button was '{$field->getText}', instead of '{$text}'.", $session);
        }
    }

    /**
     * @Then /^I should be able to edit the post$/
     */
    public function iShouldBeAbleToEditThePost()
    {
        $this->fillField("content", "I fixed it!");
        $this->pressButton("Edit Post");
    }

    /**
     * @Given /^I should see the edited content$/
     */
    public function iShouldSeeTheEditedContent()
    {
        $this->assertPageContainsText("I fixed it!");
        $this->assertPageNotContainsText("I made a boo boo");
    }

    /**
     * @When /^I input invalid blog data$/
     */
    public function iInputInvalidBlogData()
    {
        $this->fillField("content", "");
        $this->pressButton("Edit Post");
    }

    /**
     * @Given /^I click "([^"]*)"$/
     */
    public function iClick($link)
    {
        $this->clickLink($link);
    }

    /**
     * @Then /^I should be on the home page$/
     */
    public function iShouldBeOnTheHomePage()
    {
        $this->iAmOnHomepage();
    }

    /**
     * @Given /^I create a blog post and tag it "([^"]*)"$/
     */
    public function iCreateABlogPostAndTagIt($tag)
    {
        $title = "Tagging";
        $content = "Tags are cool";
        $this->visit("/blog/create");
        $this->fillField("title", $title);
        $this->fillField("content", $content);
        $this->fillField("tags", $tag);
        $this->pressButton("Create Post");
    }

    /**
     * @Then /^I should see the tag "([^"]*)"$/
     */
    public function iShouldSeeTheTag($tag)
    {
        $session = $this->getMink()->getSession();
        $tagDiv = $session->getPage()->find("css", '.blog-tags');
        if (!$tagDiv) {
            throw new ResponseTextException("Couldn't find .blog-tags", $session);
        }
        if (strpos($tagDiv->getText(), $tag) === false) {
            throw new ResponseTextException("Couldn't find {$tag} inside .blog-tags", $session);
        }
    }


    /**
     * @Given /^I create (\d+) blog posts with the tag "([^"]*)"$/
     */
    public function iCreateBlogPostsWithTheTag($number, $tag)
    {
        $factory = Faker\Factory::create();
        for ($i = 0; $i < $number; $i++) {
            $title = implode(" ", $factory->words(5));
            $content = implode("\n\n", $factory->paragraphs(5));
            $this->visit("/blog/create");
            $this->fillField("title", $title);
            $this->fillField("content", $content);
            $this->fillField("tags", $tag);
            $this->pressButton("Create Post");
        }
    }

    /**
     * @Given /^There are no tags$/
     */
    public function thereAreNoTags()
    {
    }

    /**
     * @Given /^I tag it "([^"]*)"$/
     */
    public function iTagIt($tag)
    {
        $this->fillField("tags", $tag);
        $this->pressButton("Edit Post");
    }

    /**
     * @When /^I go to the edit page$/
     */
    public function iGoToTheEditPage()
    {
        $this->clickLink("Edit Post");
    }

    /**
     * @Given /^I should not see the tag "([^"]*)"$/
     */
    public function iShouldNotSeeTheTag($tag)
    {
        $session = $this->getMink()->getSession();
        $tagDiv = $session->getPage()->find("css", '.blog-tags');
        if (!$tagDiv) {
            throw new ResponseTextException("Couldn't find .blog-tags", $session);
        }
        if (!(strpos($tagDiv->getText(), $tag) === false)) {
            throw new ResponseTextException("Found {$tag} inside .blog-tags", $session);
        }
    }

    /**
     * @Then /^I should see it tagged "([^"]*)"$/
     */
    public function iShouldSeeItTagged($tag)
    {
        $session = $this->getMink()->getSession();
        $input = $session->getPage()->findField("tags");
        if (!$input) {
            throw new ResponseTextException("Couldn't find the tag input", $session);
        }
        if ($input->getValue() != $tag) {
            throw new ResponseTextException("The tags are {$input->getValue()}, not {$tag}", $session);
        }
    }

    /**
     * @Given /^I create a user$/
     */
    public function iCreateAUser()
    {
        $user = new User;
        $user->username = "test";
        $user->password = Hash::make("foo");
        if (!$user->save()) {
            throw new ResponseTextException("Couldn't create a user");
        }
    }

    /**
     * @Given /^I should see a user$/
     */
    public function iShouldSeeAUser()
    {
        $this->visit("/users");
        $this->assertPageContainsText("test");
    }
}
