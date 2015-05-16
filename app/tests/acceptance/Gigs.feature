Feature: Gigs

  In order publicise concerts
  As the site owner
  I can update the gig list

  Background: There is a user
    Given there is a user
    And I am logged in

  Scenario: Only the site owner may create gig postings
    Given I am not logged in
    When I am on "gigs/create"
    Then I should be on "/login"
    And I should see a flash message "You're not authorised to do that"

  Scenario: The site owner adds a gig to the database
    Given I am on "gigs/create"
    And I fill in the following:
      | date       | 2030-01-01             |
      | time       | 8:00pm (Doors at 7:30) |
      | location   | Shakespeare's          |
      | about      | Some interesting text  |
      | cost       | £50 million            |
      | ticketlink | http://someaddress.com |
    When I press "Create Gig"
    Then I should see a flash message "Gig created"
    And the database should contain 1 gig
    And I should see 1 gigs

  Scenario: I can view the gigs
    Given there are 5 gigs
    When I am on "gigs/"
    Then I should see 5 gigs

  Scenario: Old gigs are not shown
    Given there is a gig in the past
    When I am on "gigs/"
    Then I should see 0 gigs
    And I should see "No bookings, check back soon!"