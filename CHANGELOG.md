# Changelog

All notable changes to `drive` will be documented in this file.

## 0.1.0 - 2019-03-XX

- Initial release.
- `Drive::getService()` method added to get the `Google_Service_Drive` instance.
- `Drive::get($fileId)` method to get a `\Google_Service_Drive_DriveFile`.
- `Drive::create($name, $mimeType)` method added to create a `\Google_Service_Drive_DriveFile`.
- `Drive::createFolder($name)` method added to create a folder.
- `Drive::setPermission($fileId, $type, $role)` method to set permissions on a file/folder.
