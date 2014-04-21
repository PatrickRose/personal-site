Feature: Blog

  In order to practice writing
  As the site owner
  I can write blog posts

  Scenario: Nobody except the site owner can create a blog post
    Given I am on "blog/create"
    Then I should be on "/login"
    And I should see a flash message "You're not authorised to do that"

  Scenario: Site owner creates a blog post
    Given I am logged in
    And I am on "blog/create"
    And I create a blog post with title "Foo" and content "Baring all the baz"
    Then I should see "Foo"
    And I should see "Baring all the baz"
    And I should see a flash message "Blog post created!"

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
    Given I am logged in
    And I create a blog post with title "First Post" and content "first post content"
    And I create a blog post with title "Second Post" and content "second post content"
    And I then log out
    And I then am on "/blog"
    Then I should see all blogs

  Scenario: When I see posts, the titles are capitalised
    Given I am logged in
    And I create a blog post with title "no capitals" and content "first post content"
    Then the title should be "No Capitals"
    And when I go to "/blog" I should see the title "No Capitals"