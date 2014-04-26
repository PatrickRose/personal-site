Feature: Tags

  As an admin
  I can tag posts
  So that we can find similar posts

  Background: I should have an empty site
    Given I create a user
    And I am logged in

  Scenario: I can tag a post
    When I create a blog post and tag it "testing"
    Then I should see the tag "testing"

  Scenario: I can tag a post with multiple tags
    When I create a blog post and tag it "testing, test1, test2"
    Then I should see the tag "testing"
    And I should see the tag "test1"
    And I should see the tag "test"
    And I shouldn't see ","

  Scenario: I can search by a tag
    Given there are 9 blog posts with the tag "foo"
    And there are 3 blog posts with the tag "bar"
    When I am on "/tag/foo"
    Then I should see 6 copies of ".blog-title"

  Scenario: I can see all tags
    Given there are 4 blog posts with the tag "foo"
    And there are 4 blog posts with the tag "bar"
    And there are 4 blog posts with the tag "baz"
    And there are 4 blog posts with the tag "bau"
    And there are 4 blog posts with the tag "baa"
    And there are 4 blog posts with the tag "bab"
    And there are 4 blog posts with the tag "bac"
    When I am on "/tag"
    Then I should see "foo"
    And I should see "bar"
    And I should see "baz"
    And I should see 18 copies of ".tagged-post"

  Scenario: We get a graceful fail when a tag isn't found
    Given there are no tags
    When I am on "/tag/foo"
    Then I should see a flash message "Tag not found"
    And I should be on "/tag"

  Scenario: I can tag a post after editing it
    Given I create a blog post with title "Editing Test" and content "I made a boo boo"
    When I am on "/blog/editing-test/edit"
    And I tag it "testing"
    Then I should see the tag "testing"

  Scenario: When I edit a post the previous tags are there
    Given there is a blog post with tags "foo, bar"
    When I go to the edit page
    Then I should see it tagged "foo, bar"

  Scenario: I can change the tags of a post while editing it
    Given there is a blog post with tag "foo"
    When I go to the edit page
    And I tag it "bar"
    Then I should see the tag "bar"
    And I should not see the tag "foo"

  Scenario: All tags are lower case
    Given I create a blog post and tag it "foo, Bar"
    Then I should see the tag "foo"
    And I should see the tag "bar"