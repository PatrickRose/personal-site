Feature: Songs

  In order to show off my songs
  As the site owner
  I can make a song book

  Background: There is a user
    Given there is a user

  Scenario: Nobody except the site owner can create a song
    Given I am on "songs/create"
    Then I should be on "/login"
    And I should see a flash message "You're not authorised to do that"

  Scenario: I can see the songs
    Given there is a song
    When I am on "songs/"
    Then I should see 1 songs
    When I click "Song details"
    Then I should be on "songs/a-new-song"
    And I should see the song

  Scenario: I can insert a song
    Given I am logged in
    And I am on "songs/create"
    And I create a song
    Then I should see a flash message "Song created"
    And I should be on "songs/a-new-song"
    And I should see the song
    Then I should not see a ".song-available-on" element
    Then I should not see a ".song-video" element

  Scenario: I can mark up a chorus
    Given I am logged in
    And I am on "songs/create"
    And I create a song with a chorus
    Then I should see a flash message "Song created"
    And I should see the song chorus

  Scenario: It handles a non-existing song gracefully
    Given I am on "songs/this-does-not-exist"
    Then I should see a flash message "That song does not exist"
    And I should be on "songs"

  Scenario: I can say where a song was recorded
    Given I am logged in
    And I am on "songs/create"
    When I fill in the following:
    | title | Paradise Square |
    | composer | Patrick Rose |
    | lyrics | Some lyrics |
    | info | Songs |
    | recorded | ParadiseSquare |
    And I press "Create Song"
    Then I should be on "songs/paradise-square"
    And the ".song-available-on" element should contain "Available on <a href=\"https://patrickrose.bandcamp.com/album/paradise-square\">Paradise Square</a>"
    Then I should not see a ".song-video" element

  Scenario: I can give a youtube video
    Given I am logged in
    And I am on "songs/create"
    When I fill in the following:
    | title | Paradise Square |
    | composer | Patrick Rose |
    | lyrics | Some lyrics |
    | info | Songs |
    | video | 12345678 |
    And I press "Create Song"
    Then I should be on "songs/paradise-square"
    And I should not see a ".song-available-on" element
    And the ".song-video" element should contain "<iframe width=\"560\" height=\"315\" src=\"//www.youtube.com/embed/12345678\" frameborder=\"0\" allowfullscreen></iframe>"

  Scenario: I can update the record
    Given I am logged in
    And I am on "songs/create"
    When I create a song
    Then I should see the song
    And I should not see a ".song-available-on" element
    And I should not see a ".song-video" element
    When I go to "songs/a-new-song/edit"
    And press "Update Song"    
    Then I should see the song
    And I should not see a ".song-available-on" element
    And I should not see a ".song-video" element
    When I go to "songs/a-new-song/edit"
    And I fill in the following:
    | recorded | ParadiseSquare |
    | video | 12345678 |
    And press "Update Song"
    Then I should see the song
    And the ".song-available-on" element should contain "Available on <a href=\"https://patrickrose.bandcamp.com/album/paradise-square\">Paradise Square</a>"
    And the ".song-video" element should contain "<iframe width=\"560\" height=\"315\" src=\"//www.youtube.com/embed/12345678\" frameborder=\"0\" allowfullscreen></iframe>"
    