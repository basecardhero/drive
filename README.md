# BaseCardHero - Drive

[![Build Status](https://img.shields.io/travis/basecardhero/drive/master.svg)](https://travis-ci.org/basecardhero/drive)
[![codecov](https://codecov.io/gh/basecardhero/drive/branch/master/graph/badge.svg)](https://codecov.io/gh/basecardhero/drive)
[![License](https://poser.pugx.org/basecardhero/drive/license)](https://packagist.org/packages/basecardhero/drive)
[![composer.lock](https://poser.pugx.org/basecardhero/drive/composerlock)](https://packagist.org/packages/basecardhero/drive)

_This package was created for a project I am working on and does not fully support Google services (or the way you may want it to). Feel free to add functionality by creating a pull request. See [contributing](CONTRIBUTING.md)._

## Installation

You can install the package via [composer](https://getcomposer.org/):

``` bash
$ composer require basecardhero/drive
```

## Usage

You will need to configure the [Google Client](https://github.com/googleapis/google-api-php-client). See [gsuitedevs/php-samples](https://github.com/gsuitedevs/php-samples) for examples configuring a Google Client for php.

### Examples

#### Create a Drive instance

``` php
require_once '/project/path/vendor/autoload.php';

$client = new \Google_Client(); // Make sure to configure your Google client.
$driveService = new \Google_Service_Drive($client);
$drive = new \BaseCardHero\Drive\Drive($driveService);
```

#### Get the Google_Service_Drive instance

``` php
$drive->getService() // \Google_Service_Drive
```

#### Retrieve a file

``` php
$file = $drive->get('efTpcKY4TL2DWbExuvBuRxlmVFtsxpAeyHmMfxpwcobePxKV');

echo get_class($file); // \Google_Service_Drive_DriveFile
echo $file->id; // 'efTpcKY4TL2DWbExuvBuRxlmVFtsxpAeyHmMfxpwcobePxKV'
```

#### Set file permissions

``` php
$fileId = 'efTpcKY4TL2DWbExuvBuRxlmVFtsxpAeyHmMfxpwcobePxKV';
$permissions = $spreadsheet->setPermission($fileId, 'anyone', 'reader');

echo get_class($permissions); // \Google_Service_Drive_Permission
```
#### Create a file

See [mime types](https://developers.google.com/drive/api/v3/mime-types).

``` php
$file = $spreadsheet->create('My File', 'application/vnd.google-apps.file');

echo get_class($file); // \Google_Service_Drive_DriveFile
echo $file->id; // 'efTpcKY4TL2DWbExuvBuRxlmVFtsxpAeyHmMfxpwcobePxKV'
```

#### Create a folder

``` php
$folder = $spreadsheet->createFolder('My Folder');

echo get_class($folder); // \Google_Service_Drive_DriveFile
echo $folder->id; // 'efTpcKY4TL2DWbExuvBuRxlmVFtsxpAeyHmMfxpwcobePxKV'
```

### Testing

``` bash
$ composer all
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

### Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email ryan@basecardhero.com instead of using the issue tracker.

### Credits

- [Base Card Hero](https://github.com/basecardhero) | [basecardhero.com](https://basecardhero.com/)
- [All Contributors](../../contributors)

### License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

### PHP Package Boilerplate

This package was generated using the [PHP Package Boilerplate](https://laravelpackageboilerplate.com).
