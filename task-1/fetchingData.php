<?php
require_once './vendor/autoload.php';

define("baseUri","https://www.innoraft.com/");

class FetchData extends Data {
  
  /**
   * Fetching data from https://www.innoraft.com/jsonapi/node/services API.
   *
   * @return void
   */

  public function fetchData() {
    $client = new GuzzleHttp\Client(['base_uri' => constant("baseUri")]);
    $response = $client->request('GET', '/jsonapi/node/services');
    //Getting JSON data.
    $body = $response->getBody()->getContents();
    //Convert JSON data into an object.
    $data = json_decode($body);
    $this->storeInArray($data);
  }

  /**
   * After getting the contents from the API storing them into a seperate array.
   *
   * @param string $arrayBody
   * @return void
   */

  public function storeInArray($fetchData) {

    foreach ($fetchData->data as $data) {
      if ($data->attributes->field_services->value != NULL) {
        //Store titles into tile array.
        array_push($this->title, $data->attributes->title);
        //Store unorder list into list array.
        array_push($this->list, $data->attributes->field_services->processed);
        //Store links into button array.
        array_push($this->button, constant("baseUri") . $data->attributes->path->alias);
        //Store the images into image array.
        array_push($this->image, constant("baseUri") . $this->fetchImages($data->relationships->field_image->links->related->href));
      }
    }
  }

  /**
   * Fetching image.
   *
   * @param string $imageLink
   * @return string
   */

  public function fetchImages($imageLink) {
    $client = new GuzzleHttp\Client();
    $response = $client->request('GET', $imageLink);
    //Getting JSON data.
    $body = $response->getBody()->getContents();
    //Converting JSON data into an object.
    $imageObject = json_decode($body);
    return ($imageObject->data->attributes->uri->url);
  }
}
