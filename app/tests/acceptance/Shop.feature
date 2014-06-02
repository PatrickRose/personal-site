Feature: Shop

  As a visitor
  I can buy tabs
  To learn how to play the songs Patrick sings

  Background: There is a user
    Given there is a user

  Scenario: I can add things to the list of things to buy
    Given I am logged in
    When I create a new item to buy
    Then I can see the item in the list

  Scenario: We can see all the items paginated
    Given there are 20 items in the shop
    When I visit the shop
    Then I should see "«"
    And I should see "»"
    And I should see 18 copies of ".shop-item"
