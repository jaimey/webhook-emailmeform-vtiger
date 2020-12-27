<?php
$debug       = true;
$receivedlog = true;
$publicid    = 'abcdefg123456789';
$url         = 'http://localhost/vtigercrm/modules/Webforms/capture.php';

parse_str(file_get_contents("php://input"), $data);
$encodedData = (array) $data;

if (!is_array($encodedData)) {
    die;
}

$jsondecoded = json_decode($encodedData['data'], true);

foreach ($jsondecoded['UserFields'] as $key => $fields) {
    switch ($fields['Name']) {
        case 'Nombres':
            $data['firstname'] = $fields['Value'];
            break;
        case 'Apellidos':
            $data['lastname'] = $fields['Value'];
            break;
        case 'Email':
            $data['email'] = $fields['Value'];
            break;
        case 'País':
            $data['country'] = $fields['Value'];
            break;
        case 'Ciudad o Municipio':
            $data['city'] = $fields['Value'];
            break;
        case 'Mensaje':
            $data['description'] = $fields['Value'];
            break;
        case 'Celular':
            $data['mobile'] = $fields['Value'];
            break;
        default:
            # code...
            break;
    }
}

$data['leadsource'] = 'Web Site';
$data['publicid']   = $publicid;
$url                = $url;

$request = curl_init($url);
curl_setopt($request, CURLOPT_HEADER, 0);
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($request, CURLOPT_POSTFIELDS, $data);
curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

$response = (string) curl_exec($request);
$err      = curl_error($request);
curl_close($request);

$response = json_decode($response, true);
if (!$response['success']) {
    $msg    = date('d-m-Y H:i:s') . ' ' . $response['error']['message'];
    $txt    = print_r($msg, true);
    $myfile = file_put_contents('logs/error', $txt . PHP_EOL, FILE_APPEND | LOCK_EX);
}

if ($debug) {
    $date['date'] = date('d-m-Y H:i:s');
    $msg          = array_merge($date, $response);
    $txt          = print_r($msg, true);
    $myfile       = file_put_contents('logs/debug', $txt . PHP_EOL, FILE_APPEND | LOCK_EX);
}
if ($receivedlog) {
    $txt    = print_r($jsondecoded, true);
    $myfile = file_put_contents('logs/receivedlog', $txt . PHP_EOL, FILE_APPEND | LOCK_EX);

}
