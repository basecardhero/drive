<?php

namespace BaseCardHero\Drive;

interface DriveInterface
{
    /**
     * Get a Google_Service_Drive_DriveFile.
     *
     * @param string $fileId
     * @param array $attributes
     *
     * @return \Google_Service_Drive_DriveFile
     */
    public function get(string $fileId, array $attributes = []) : \Google_Service_Drive_DriveFile;

    /**
     * Create permissions on a file.
     *
     * @param string $fileId
     * @param string $type
     * @param string $role
     *
     * @return \Google_Service_Drive_Permission
     */
    public function setPermission(string $fileId, string $type, string $role) : \Google_Service_Drive_Permission;

    /**
     * Create a drive file.
     *
     * @param string $name
     * @param string $mimeType
     * @param array|null $optional
     *
     * @return \Google_Service_Drive_DriveFile
     */
    public function create(string $name, string $mimeType, array $optional = null) : \Google_Service_Drive_DriveFile;

    /**
     * Create a folder.
     *
     * @param string $name
     *
     * @return \Google_Service_Drive_DriveFile
     */
    public function createFolder(string $name) : \Google_Service_Drive_DriveFile;

    /**
     * Delete a file.
     *
     * @param string $fileId
     *
     * @return void
     */
    public function delete(string $fileId) : void;
}
