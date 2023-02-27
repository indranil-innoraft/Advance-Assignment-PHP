<?php
require_once './vendor/autoload.php';


class FetchData extends Data
{
  /**
   * Fetching data from https://www.innoraft.com/jsonapi/node/services API.
   *
   * @return void
   */
  public function fetchBody()
  {
    $client = new GuzzleHttp\Client(['base_uri' => 'https://www.innoraft.com/']);
    $response = $client->request('GET', '/jsonapi/node/services');
    $body = $response->getBody()->getContents();
    $arrayBody = json_decode($body);
    $this->fetchText($arrayBody);
  }

  /**
   * After getting the contents from the API storing them into a seperate array.
   *
   * @param string $arrayBody
   * @return void
   */
  public function fetchText($arrayBody)
  {
    $baseUri = "https://www.innoraft.com/";
    foreach ($arrayBody->data as $data) {
      if ($data->attributes->field_services->value != null) {
        array_push($this->title, $data->attributes->title);
        array_push($this->list, $data->attributes->field_services->processed);
        array_push($this->button, $baseUri . $data->attributes->path->alias);
        array_push($this->image, $baseUri . $this->fetchImages($data->relationships->field_image->links->related->href));
      }
    }
  }

  /**
   * Fetching image.
   *
   * @param string $imageLink
   * @return string
   */
  public function fetchImages($imageLink)
  {
    $client = new GuzzleHttp\Client();
    $response = $client->request('GET', $imageLink);
    $body = $response->getBody()->getContents();
    $arrayBody = json_decode($body);
    return ($arrayBody->data->attributes->uri->url);
  }
}
