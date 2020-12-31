# webhook emailmeform a vtiger

Recibir los Webhooks desde Emailmeform y enviarlos a vTiger

## Instalación 🔧

1. Clonar el repo en la carpeta ```/var/www/html/```
```
git clone https://github.com/jaimey/webhook-emailmeform-vtiger.git
```
#### Configurar Emailmeform
1. Loguarse en emailmeform.com
2. Seleccionar el Formulario
3. Click en "Options"
4. Click en "Integrations"
5. Ingresar el “WebHook URL” 

Ejemplo: http://127.0.0.1/webhook-emailmeform-vtiger/receive.php

#### Crear un Formulario Web en vTiger
Copiar la URL y el PublicID del formulario creado.

#### Configurar las varibales
Pegar la URL y el PublicID en el archivo ```receive.php```


```
$debug       = false;
$receivedlog = false;
$publicid    = 'abcdefg123456789';
$url         = 'http://localhost/vtigercrm/modules/Webforms/capture.php';
```

Homologar con cada Case los campos de vTiger
```php
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
```

## Uso 🚀 

Diligenciar un formulario y ver el resultado en vTiger

Si hay errores se creará un archivo en la carpeta ```log```

## Debug 🔩
Cambiar los valores a TRUE
```php
$debug       = true;
$receivedlog = true;
```
y ver los archivos creados en la carpeta ```log```
## License
[MIT](https://choosealicense.com/licenses/mit/)
