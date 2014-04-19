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
    And I fill in the blog form
    Then I should see "<h2>Foo</h2>"
    And I should see "<div class='blog-post'>Baring all the baz</div>"
    And I should see a flash message "Blog post created!"