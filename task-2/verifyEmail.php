<?php

//Provide guzzle.
use GuzzleHttp\Client;

class Email {

  /**
   * Verify the email address using https://api.apilayer.com api. 
   *
   * @param string $emailAddress
   * @return void
   */

  public function verify(string $emailAddress) {

    $client = new Client([
      'base_uri' => 'https://api.apilayer.com',
    ]);

    $response = $client->request('GET', "/email_verification/check?email=" . $emailAddress, [
      "headers" => [
        "Content-Type: text/plain",
        'apikey' => 'STTONsCShOh5qIQFmndLNgiz3nfgFRN9',
      ]
    ]);

    //Getting JSON data form $ response variable.
    $body = $response->getBody();
    
    //Convert JSON data into a object.
    $data = json_decode($body);

    if ($data->format_valid && $data->smtp_check) {
      return true;
    } 
    else {
      return false;
    }
  }
}
