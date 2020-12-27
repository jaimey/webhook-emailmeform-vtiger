<?php

$endpoint = 'http://localhost/webhook-emailmeform-vtiger/receive.php';

$data = [
    'data' => '
{
   "Form":{
      "FormID":"12345",
      "VisitID":"wW234234fbeq8c",
      "Name":"Nombre del Formulario"
   },
   "Entry":{
      "ID":"24",
      "DateSubmitted":"2020-12-26 10:35:37",
      "FromIp":"186.0.0.1",
      "Status":"submitted",
      "HttpReferer":"https:\/\/www.example.com.co\/"
   },
   "UserFields":{
      "80856934":{
         "Name":"Nombres",
         "Value":"name_test"
      },
      "80856988":{
         "Name":"Apellidos",
         "Value":"apellido_test"
      },
      "80856990":{
         "Name":"Email",
         "Value":"test@test.com"
      },
      "80856989":{
         "Name":"Celular",
         "Value":"1234567"
      },
      "80856991":{
         "Name":"Pa\u00eds",
         "Value":"Colombia"
      },
      "80857005":{
         "Name":"Ciudad o Municipio",
         "Value":"Barranquilla"
      },
      "80856992":{
         "Name":"Mensaje",
         "Value":"Test"
      }
   }
}',
];

// $encodedData = json_encode($data);
// $handle = curl_init($url);
// curl_setopt($handle, CURLOPT_POST, 1);
// curl_setopt($handle, CURLOPT_POSTFIELDS, $encodedData);
// curl_setopt($handle, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

$encodedData = http_build_query($data);
$handle      = curl_init($endpoint);
curl_setopt($handle, CURLOPT_POST, 1);
curl_setopt($handle, CURLOPT_POSTFIELDS, $encodedData);
curl_setopt($handle, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);

$result = curl_exec($handle);
