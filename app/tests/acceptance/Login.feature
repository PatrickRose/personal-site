Feature: Login

  As a user
  I can log in
  To update the site

  Scenario: I can log in with valid information
    Given I am on "/login"
    And I fill in my login details
    Then I should be logged in
    Then I should be on "/"
    And I should see a flash message "Login successful!"

  Scenario: I can't log in without valid information
    Given I am on "/login"
    And I fill in invalid login details
    Then I should not be logged in
    And I should be on "/login"
    And I should see a flash message "Incorrect username/password"

  Scenario: I can log out
    Given I am logged in
    And I am on "/logout"
    Then I should not be logged in
    And I should see a flash message "You are now logged out"
