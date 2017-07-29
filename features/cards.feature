Feature: Manage cards
  In order to manage cards
  As a client software developer
  I need to be able to retrieve, create, update and delete them trough the API.

  # the "@createSchema" annotation provided by API Platform creates a temporary SQLite database for testing the API
  @createSchema
  @dropSchema
  Scenario: Get empty card
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/cards"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
        "@context": "\/contexts\/Card",
        "@id": "\/cards",
        "@type": "hydra:Collection",
        "hydra:member": [],
        "hydra:totalItems": 0
    }
    """

  #Scenario: Create a card
#    When I add "Content-Type" header equal to "application/ld+json"
#    And I add "Accept" header equal to "application/ld+json"
#    And I send a "POST" request to "/cards" with body:
#    """
#    {
#      "front": "string",
#      "back": "string",
#      "reviewDate": "2020-07-29T06:07:54.470Z",
#      "minutesTilNextReview": 0
#    }
#    """
#    Then the response status code should be 201
#    And the response should be in JSON
#    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
#    And the JSON should be equal to:
#    """
#    {
#      "@context": "\/contexts\/Card",
#      "@id": "\/cards\/1",
#      "@type": "Card",
#      "id": 1,
#      "front": "string",
#      "back": "string",
#      "eFactor": 0,
#      "repetition": 0,
#      "lastInterval": 0,
#      "reviewDate": "2020-07-29T06:07:54+00:00"
#    }
#    """