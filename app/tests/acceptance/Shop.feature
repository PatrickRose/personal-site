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

  Scenario: I can see all the items paginated
    Given there are 20 items in the shop
    When I visit the shop
    Then I should see "«"
    And I should see "»"
    And I should see 18 copies of ".shop-item"

  Scenario: I can buy something
    Given there is an item in the shop
    When I visit the shop
    And I click "Buy Item"
    Then I should see a flash message "Item added to basket"
    And I should see the item in my basket

  Scenario: I can see my total
    Given there are 10 item in the shop
    When I visit the shop
    And I buy 5 items
    Then I should see the total in my basket

  Scenario: I can empty my basket
    Given there are 10 item in the shop
    And I visit the shop
    And I buy 5 items
    When I empty my basket
    Then I should see a flash message "Basket emptied"
    And I should have an empty basket

  Scenario: I can remove items from my basket
    Given there are 10 items in the shop
    And I visit the shop
    And I buy 1 items
    When I remove the item from my basket
    Then I should see a flash message "Item removed"
    And I should have an empty basket
