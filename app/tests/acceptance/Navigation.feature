Feature: Navigation

  As a user
  I can use the navbar
  So I can navigate the site

  Background: I start on the home page
    Given I am on "/"

  Scenario: I can log in using the navbar
    And I click "Login"
    Then I should be on "/login"

  Scenario: I can log out using the navbar
    Given I am logged in
    And I click "Logout"
    Then I should not be logged in

  Scenario: I can visit the home page
    Given I am on "/login"
    When I click "Home"
    Then I should be on the home page

  Scenario: I can visit the blog page
    When I click "Blog"
    Then I should be on "/blog"

  Scenario: I can visit the gig page
    When I click "Gigs"
    Then I should be on "/gigs"

  Scenario: I can visit the about page
    When I click "About"
    Then I should be on "/about"

  Scenario: I can visit the tags pages
    When I click "Tags"
    Then I should be on "/tag"
