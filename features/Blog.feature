Feature: Blog

  In order to practice writing
  As the site owner
  I can write blog posts

  Background: There is a user
    Given there is a user

  Scenario: Nobody except the site owner can create a blog post
    Given I am on "blog/create"
    Then I should be on "/login"
    And I should see a flash message "You're not authorised to do that"

  Scenario: Site owner creates a blog post
    Given I am logged in
    And I am on "blog/create"
    When I create a blog post with title "Foo" and content "Baring all the baz"
    Then I should see a flash message "Blog post created!"
    And I should see "Baring all the baz"
    And I should see "Foo"

  Scenario: Site owner cannot create an invalid blog post
    Given I am logged in
    And I am on "blog/create"
    And I fill in the blog form with invalid data
    Then I should see a flash message "That's not a valid blog post"
    And I should be on "/blog/create"

  Scenario: A blog post that has the same title is a new slug
    Given I am logged in
    And I create a blog post with title "evening" and content "content"
    And I create a blog post with title "evening" and content "different"
    Then I should be on "/blog/evening-2"
    And I should see "different"
    And I should not see "content"

  Scenario: I can see all the blog posts
    Given there is a blog post with title "First Post" and content "first post content"
    And there is a blog post with title "Second Post" and content "second post content"
    When I am on "/blog"
    Then I should see all blogs

  Scenario: When I see posts, the titles are capitalised
    Given I am logged in
    And I create a blog post with title "no capitals" and content "first post content"
    Then the title should be "No Capitals"
    And when I go to "/blog" I should see the title "No Capitals"

  Scenario: I can use markdown to create posts
    Given I am logged in
    And I create a blog post with the title "Markdown Test" and content:
    """
    # Heading 1

    ## Heading 2

    *emphasis*

    **strong**

    1. First ordered item
    2. Second ordered item

    * First unordered item
    * Second unordered item

    [link](http://foo.bar.com)

    Test we can create `inline code`

    Test that we an also add paragraphs

    Hey look, more paragraphs!
    """
    Then I should see the compiled markdown

    Scenario: The index page only shows the first paragraph of each post
      And there is a blog post with the title "Paragraph Test" and content:
      """
      This is a nice paragraph

      Oh goodness, so is this!

      I shouldn't be able to see this
      """
      When I am on "/blog"
      Then I should see "This is a nice paragraph"
      And I shouldn't see "Oh goodness, so is this!"
      And I shouldn't see "I shouldn't be able to see this"
      And I should see a button saying "Continue Reading..."

  Scenario: We get a graceful fail when a blog post isn't found
    Given there are no blog posts
    When I am on "/blog/foo"
    Then I should see a flash message "Blog post not found"
    And I should be on "/blog"

  Scenario: We can edit blog posts
    Given there is a blog post with title "Editing Test" and content "I made a boo boo"
    When I am logged in
    And I am on "blog/editing-test/edit"
    Then I should be able to edit the post
    And I should see the edited content

  Scenario: We can only edit posts if you're logged in
    Given there is a blog post with title "Editing Test" and content "I made a boo boo"
    When I am on "blog/editing-test/edit"
    Then I should be on "/login"
    And I should see a flash message "You're not authorised to do that"

  Scenario: We can only edit posts that are real
    Given I am logged in
    And there are no blog posts
    When I am on "blog/editing-test/edit"
    Then I should be on "/blog"
    And I should see a flash message "Blog post not found"

  Scenario: We can only edit posts so they are valid
    Given I am logged in
    And I create a blog post with title "Editing Test" and content "I made a boo boo"
    And I am on "blog/editing-test/edit"
    When I input invalid blog data
    Then I should see a flash message "That's not a valid blog post"
    And I should be on "blog/editing-test/edit"

  Scenario: We can see the edit button if we're logged in
    Given I am logged in
    And there is a blog post with title "Editing Test" and content "I made a boo boo"
    When I am on "blog/editing-test"
    Then  I should see "Edit Post"

  Scenario: We can't see the edit button if we're not logged in
    Given there is a blog post with title "Editing Test" and content "I made a boo boo"
    When I am on "blog/editing-test"
    Then  I should not see "Edit Post"

  Scenario: When we see blog posts, they are paginated
    Given there are 15 blog posts
    When I am on "/blog"
    Then I should see "«"
    And I should see "»"
    And I should see 6 copies of ".blog-title"

