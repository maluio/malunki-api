Feature: Manage images as part of cards

  @createSchema
  Scenario: Create a card with images
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/cards" with body:
    """
    {
      "word": "ohlala",
      "front": "vorne",
      "gender": "female",
      "images": [
          { "url": "www.example.com"},
          { "url": "www.example2.com"}
      ]
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
      "reviewDate": "2000-07-29T11:43:16+00:00",
      "gender": "female",
          "images": [
              {
                  "@id": "\/images\/1",
                  "@type": "Image",
                  "url": "www.example.com",
                  "id": 1
              },
               {
                  "@id": "\/images\/2",
                  "@type": "Image",
                  "url": "www.example2.com",
                  "id": 2
              }
          ]
    }
    """
  @dropSchema
  Scenario: Update a card with images
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "PUT" request to "/cards/1" with body:
    """
    {
      "word": "maison"
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
          "front": "vorne",
          "reviewDate": "2000-07-29T11:43:16+00:00",
          "gender": "female",
          "images": [
              {
                  "@id": "\/images\/1",
                  "@type": "Image",
                  "url": "www.example.com",
                  "id": 1
              },
              {
                  "@id": "\/images\/2",
                  "@type": "Image",
                  "url": "www.example2.com",
                  "id": 2
              }
          ]
      }
    """
