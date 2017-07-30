Feature: Manage cards
  In order to manage cards
  As a client software developer
  I need to be able to retrieve, create, update and delete them trough the API.

  # the "@createSchema" annotation provided by API Platform creates a temporary SQLite database for testing the API
  @createSchema
  Scenario: Get empty card list
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
  Scenario: Create a card
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/cards" with body:
    """
    {
      "word": "ohlala",
      "front": "vorne",
      "back": "hinten"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "\/contexts\/Card",
      "@id": "\/cards\/1",
      "@type": "Card",
      "id": 1,
      "word": "ohlala",
      "reviewQualities": null,
      "front": "vorne",
      "back": "hinten",
      "reviewDate": "2000-07-29T11:43:16+00:00"
    }
    """
  Scenario: Update a card
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "PUT" request to "/cards/1" with body:
    """
    {
      "word": "maison",
      "front": "vorneNeu",
      "back": "hintenNeu"
    }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "\/contexts\/Card",
      "@id": "\/cards\/1",
      "@type": "Card",
      "id": 1,
      "word": "maison",
      "reviewQualities": [
          {
              "value": 0,
              "nextReviewInMinutes": 0
          },
          {
              "value": 1,
              "nextReviewInMinutes": 0
          },
          {
              "value": 2,
              "nextReviewInMinutes": 0
          },
          {
              "value": 3,
              "nextReviewInMinutes": 0
          },
          {
              "value": 4,
              "nextReviewInMinutes": 0
          },
          {
              "value": 5,
              "nextReviewInMinutes": 0
          }
      ],
      "front": "vorneNeu",
      "back": "hintenNeu",
      "reviewDate": "2000-07-29T11:43:16+00:00"
    }
    """
  Scenario: Get card list
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
      "hydra:member": [
          {
              "@id": "\/cards\/1",
              "@type": "Card",
              "id": 1,
              "word": "maison",
              "reviewQualities": [
                      {
                          "value": 0,
                          "nextReviewInMinutes": 0
                      },
                      {
                          "value": 1,
                          "nextReviewInMinutes": 0
                      },
                      {
                          "value": 2,
                          "nextReviewInMinutes": 0
                      },
                      {
                          "value": 3,
                          "nextReviewInMinutes": 0
                      },
                      {
                          "value": 4,
                          "nextReviewInMinutes": 0
                      },
                      {
                          "value": 5,
                          "nextReviewInMinutes": 0
                      }
                  ],
              "front": "vorneNeu",
              "back": "hintenNeu",
              "reviewDate": "2000-07-29T11:43:16+00:00"
          }
      ],
      "hydra:totalItems": 1
        }
    """
  @dropSchema
  Scenario: Delete a card
    When I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/cards/1"

    Then the response status code should be 204

