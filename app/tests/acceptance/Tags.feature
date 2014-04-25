Feature: Tags

  As an admin
  I can tag posts
  So that we can find similar posts

  Background: I should have an empty site
    Given I run "php artisan migrate:refresh"
    And I run "php artisan db:seed"

  Scenario: I can tag a post
    Given I am logged in
    When I create a blog post and tag it "testing"
    Then I should be on "/blog/tagging"
    And I should see the tag "testing"

  Scenario: I can tag a post
    Given I am logged in
    When I create a blog post and tag it "testing, test1, test2"
    Then I should be on "/blog/tagging"
    And I should see the tag "testing"
    And I should see the tag "test1"
    And I should see the tag "test"
    And I shouldn't see "test1,"
    And I shouldn't see ", test2"
    And I shouldn't see ", test1"