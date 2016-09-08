<?php

require_once __DIR__ . "/../../bootstrap/autoload.php";
require_once __DIR__ . "/../../bootstrap/app.php";

define('HTML_DUMP_PATH', __DIR__ . '/failures');

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Event\FeatureEvent;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Behat\Hook\Scope\AfterScenarioScope;
use Behat\Behat\Event\SuiteEvent;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Mink\Exception\ResponseTextException;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use PatrickRose\Blog;
use PatrickRose\Tag;
use PatrickRose\Gig;

use Laracasts\Behat\Context\Migrator;

use PatrickRose\User;

/**
 * Features context.
 */
class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext
{

    /**
     * Migrate the database before each scenario.
     *
     * @beforeScenario
     */
    public function migrate()
    {
        Artisan::call('migrate:refresh', ['--seed' => true, '--force' => true]);
    }

    /**
     * @AfterScenario
     */
    public function dumpHTML(AfterScenarioScope $event)
    {
        $fileName = str_replace(' ', '-', $event->getScenario()->getTitle());
        $htmlCapturePath = HTML_DUMP_PATH . '/' . $fileName . '.html';
        
        if ($event->getTestResult()->isPassed()) {
            @unlink($htmlCapturePath);
            return;
        }

        $session = $this->getSession();
        $page = $session->getPage();
        $driver = $session->getDriver();
        $message = '';

        if (!file_exists(HTML_DUMP_PATH))
        {
            mkdir(HTML_DUMP_PATH);
        }
        
        $date = date('Y-m-d H:i:s');
        $url = $session->getCurrentUrl();
        $html = $page->getContent();

        $html = "<!-- HTML dump from behat  \nDate: $date  \nUrl:  $url  -->\n " . $html;

        file_put_contents($htmlCapturePath, $html);
        
        $message .= "\nHTML saved to: " . HTML_DUMP_PATH . "/". $fileName . ".html";

        echo $message . PHP_EOL;
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
     * @Given /^there are (\d+) blog posts with the tag "([^"]*)"$/
     */
    public function thereAreBlogPostsWithTheTag($number, $tag)
    {
        $factory = Faker\Factory::create();
        $blogIds = [];
        for ($i = 0; $i < $number; $i++) {
            $title = implode(" ", $factory->words(5));
            $content = implode("\n\n", $factory->paragraphs(5));
            $blog = new Blog(compact("title", "content"));
            $blog->slug = $blog->makeSlug();
            $blog->save();
            $blogIds[] = Blog::whereSlug($blog->slug)->first()->id;
        }
        Tag::create(compact('tag'));
        $tag = Tag::whereTag($tag)->first();
        foreach($blogIds as $id) {
            Blog::find($id)->tags()->sync([$tag->id]);
        }
    }

    /**
     * @Given /^there are no tags$/
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
     * @Given /^there is a user$/
     */
    public function thereIsAUser()
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

    /**
     * @Given /^there is a blog post with tag "([^"]*)"$/
     */
    public function thereIsABlogPostWithTag($tag)
    {
        $factory = Faker\Factory::create();
        $title = implode(" ", $factory->words(5));
        $content = implode("\n\n", $factory->paragraphs(5));
        $blog = new Blog(compact("title", "content"));
        $blog->slug = $blog->makeSlug();
        $blog->save();
        Tag::create(compact("tag"));
        $blog->tags()->attach(Tag::whereTag($tag)->first()->id);
        $this->visit("blog/{$blog->slug}");
    }


    /**
     * @Given /^there is a blog post with tags "([^"]*)"$/
     */
    public function thereIsABlogPostWithTags($tags)
    {
        $factory = Faker\Factory::create();
        $title = implode(" ", $factory->words(5));
        $content = implode("\n\n", $factory->paragraphs(5));
        $blog = new Blog(compact("title", "content"));
        $blog->slug = $blog->makeSlug();
        $blog->save();
        $tagIds = [];
        foreach(explode(", ", $tags) as $tag) {
            Tag::create(compact("tag"));
            $tagIds[] = Tag::whereTag($tag)->first()->id;
        }
        $blog->tags()->sync($tagIds);
        $this->visit("blog/{$blog->slug}");
    }

    /**
     * @Given /^there is a blog post with title "([^"]*)" and content "([^"]*)"$/
     */
    public function thereIsABlogPostWithTitleAndContent($title, $content)
    {
        $blog = new Blog(compact('title', 'content'));
        $blog->slug = $blog->makeSlug();
        $blog->save();
    }

    /**
     * @Given /^there is a blog post with the title "([^"]*)" and content:$/
     */
    public function thereIsABlogPostWithTheTitleAndContent($title, PyStringNode $content)
    {
        $this->thereIsABlogPostWithTitleAndContent($title, $content);
    }

    /**
     * @Given /^there are no blog posts$/
     */
    public function thereAreNoBlogPosts()
    {
        // Blog::truncate();
    }

    /**
     * @Given /^there are (\d+) blog posts$/
     */
    public function thereAreBlogPosts($number)
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
     * @Given /^I am not logged in$/
     */
    public function iAmNotLoggedIn()
    {
        $this->visit("/logout");
    }


    /**
     * @Given /^the database should contain (\d+) (\w+)s?$/
     */
    public function theDatabaseShouldContainXRowsInTableY($numRows, $table)
    {
        $table = str_plural($table);

        $actualCount = DB::table($table)->count();
        if ($actualCount != $numRows)
        {
            throw new \Behat\Behat\Exception\BehaviorException(
                "Expected to find $numRows rows(s) in table '$table' but found $actualCount"
            );
        }
    }

    /**
     * @Given /^there are (\d+) gigs$/
     */
    public function thereAreGigs($number)
    {
        $factory = \Faker\Factory::create();
        foreach(range(1, $number) as $i)
        {
            Gig::create([
                "date" => \Carbon\Carbon::create()->addYear(),
                "time" => $factory->sentence(),
                "location" => $factory->sentence(),
                "about" => $factory->sentence(),
                "cost" => '£' . $factory->randomNumber(),
                'ticketlink' => 'http://www.' . $factory->word . '.com'
            ]);
        }
    }

    /**
     * @Then /^I should see (\d+) gigs$/
     */
    public function iShouldSeeGigs($number)
    {
        $session = $this->getMink()->getSession();
        $rows = $session->getPage()->findAll("css", "tr");
        if ($number != (count($rows) - 1))
        {
            throw new ResponseTextException(
                'Found ' . (count($rows) - 1) . ", instead of $number",
                $session
            );
        }
        if ($number > 0) {
            $columns = $session->getPage()->findAll("css", "tr td");
            if (6 * $number != count($columns)) {
                throw new ResponseTextException(
                    'Found ' . (count($columns) / $number) . " columns, instead of 6",
                    $session
                );
            }
        }
    }

    /**
     * @Given /^there is a gig in the past$/
     */
    public function thereIsAGigInThePast()
    {
        $factory = \Faker\Factory::create();
        Gig::create([
            "date" => \Carbon\Carbon::create()->subYear(),
            "time" => $factory->sentence(),
            "location" => $factory->sentence(),
            "about" => $factory->sentence(),
            "cost" => '£' . $factory->randomNumber(),
            'ticketlink' => 'http://www.' . $factory->word . '.com'
        ]);
    }

    /**
     * @Given I create a song
     */
    public function iCreateASong()
    {
        $this->fillField("title", "A new song");
        $this->fillField("composer", "Patrick Rose");
        $this->fillField("lyrics", "There was an old man from nantucket
He's sadly now kicked the bucket
His mother is sad
His father is glad
For money will now be no object

I hate it when you use half-rhymes
It means you are wasting my time
If you just used skill
You'd find out you will
Be committing a lyrical crime");
        $this->fillField("info", "This was two limericks I wrote because I needed some test content

God help me.");
        
        $this->pressButton("Create Song");
    }

    public function iShouldSeeTheSongTitle($songTitle) {
        $session = $this->getMink()->getSession();
        $search = $session->getPage()->find('css', '.song-title');
        if (!$search) {
            throw new ResponseTextException("I couldn't find the song title.", $session);
        }

        if ($search->getText() != $songTitle) {
            throw new ResponseTextException("The song title was '" . $search->getText() . "', expected '{$songTitle}'", $session);
        }
    }

    public function iShouldSeeTheComposer($composer) {
        $session = $this->getMink()->getSession();
        $search = $session->getPage()->find('css', '.song-composer');
        if (!$search) {
            throw new ResponseTextException("I couldn't find the song composer.", $session);
        }

        if ($search->getText() != $composer) {
            throw new ResponseTextException("The composer was '" . $search->getText() . "', expected '{$composer}'", $session);
        }
    }

    public function iShouldSeeTheLyricsSetOutLike(array $verses, array $choruses = [])
    {
        $session = $this->getMink()->getSession();
        $verseCSS = $session->getPage()->findAll('css', '.song-lyrics .song-verse');

        $verses = array_map('nl2br', $verses);
        
        foreach($verseCSS as $verse) {
            $text = trim(str_replace('<br>', '<br />', $verse->getHTML()));
            $index = array_search($text, $verses);
            if ($index === false) {
                throw new ResponseTextException("I wasn't expecting this verse:\n" . $text . "\nlooking in:\n" . implode("\n\n", $verses), $session);
            }
            unset($verses[$index]);
        }

        if (count($verses)) {
            throw new ResponseTextException("Verse(s) not found:\n" . implode("\n\n", $verses), $session);
        }
        
        $chorusCSS = $session->getPage()->findAll('css', '.song-lyrics .song-chorus');

        $choruses = array_map('nl2br', $choruses);
        
        foreach($chorusCSS as $chorus) {
            $text = trim(str_replace('<br>', '<br />', $chorus->getHTML()));
            $index = array_search($text, $choruses);
            if ($index === false) {
                throw new ResponseTextException("I wasn't expecting this chorus:\n" . $text . "\nlooking in:\n" . implode("\n\n", $choruses), $session);
            }
            unset($choruses[$index]);
        }

        if (count($verses)) {
            throw new ResponseTextException("Chorus(es) not found:\n" . implode("\n\n", $choruses), $session);
        }
    }

    public function iShouldSeeInfo($info)
    {
        $session = $this->getMink()->getSession();
        $information = $session->getPage()->find('css', '.song-information');

        if (!$information) {
            throw new ResponseTextException("Could not find .song-information", $session);
        }

        if (trim($information->getHTML()) != $info) {
            throw new ResponseTextException("The information was '" . $information->getHTML() . "', not '$info'", $session);            
        }
    }

    /**
     * @Then I should see the song
     */
    public function iShouldSeeTheSong()
    {
        $this->iShouldSeeTheSongTitle("A New Song");
        $this->iShouldSeeTheComposer("Patrick Rose");
        $this->iShouldSeeTheLyricsSetOutLike([
            "There was an old man from nantucket
He's sadly now kicked the bucket
His mother is sad
His father is glad
For money will now be no object",
            "I hate it when you use half-rhymes
It means you are wasting my time
If you just used skill
You'd find out you will
Be committing a lyrical crime"
        ]);
        $this->iShouldSeeInfo("<p>This was two limericks I wrote because I needed some test content</p>

<p>God help me.</p>");
    }

    /**
     * @Given there is a song
     */
    public function thereIsASong()
    {
        $song = new PatrickRose\Song([
            "title" => "A new song",
            "composer" => "Patrick Rose",
            "lyrics" => "There was an old man from nantucket
He's sadly now kicked the bucket
His mother is sad
His father is glad
For money will now be no object

I hate it when you use half-rhymes
It means you are wasting my time
If you just used skill
You'd find out you will
Be committing a lyrical crime",
            "info" => "This was two limericks I wrote because I needed some test content

God help me.",
        ]);
        $song->makeSlug();
        $song->save();
    }

    /**
     * @Then I should see :number songs
     */
    public function iShouldSeeSongs($number)
    {
        $this->iShouldSee($number, '.song-title');
    }

    /**
     * @Given I create a song with a chorus
     */
    public function iCreateASongWithAChorus()
    {
        $this->fillField("title", "A new song");
        $this->fillField("composer", "Patrick Rose");
        $this->fillField("lyrics", "There was an old man from nantucket
He's sadly now kicked the bucket
His mother is sad
His father is glad
For money will now be no object

{chorus}
I hate it when you use half-rhymes
It means you are wasting my time
If you just used skill
You'd find out you will
Be committing a lyrical crime");
        $this->fillField("info", "This was two limericks I wrote because I needed some test content

God help me.");
        
        $this->pressButton("Create Song");
    }

    /**
     * @Then I should see the song chorus
     */
    public function iShouldSeeTheSongChorus()
    {
        $this->iShouldSeeTheLyricsSetOutLike([
            "There was an old man from nantucket
He's sadly now kicked the bucket
His mother is sad
His father is glad
For money will now be no object",],
                                             ["I hate it when you use half-rhymes
It means you are wasting my time
If you just used skill
You'd find out you will
Be committing a lyrical crime"
        ]);
    }
}
