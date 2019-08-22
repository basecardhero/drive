<?php

declare(strict_types=1);

namespace BaseCardHero\Drive;


class Drive implements DriveInterface
{

    /**
     * @var \Google_Service_Drive
     */
    protected $service;

    /**
     * @param \Google_Service_Drive $service
     */
    public function __construct(\Google_Service_Drive $service)
    {
        $this->service = $service;
    }

    /**
     * Get the Google_Service_Drive object.
     *
     * @return \Google_Service_Drive
     */
    public function getService(): \Google_Service_Drive
    {
        return $this->service;
    }

    /**
     * Get a Google_Service_Drive_DriveFile.
     *
     * @param string $fileId
     * @param array $attributes
     *
     * @return \Google_Service_Drive_DriveFile
     */
    public function get(string $fileId, array $attributes = []): \Google_Service_Drive_DriveFile
    {
        $attributes = array_replace([
            'fields' => 'id',
        ], $attributes);

        return $this->service->files->get($fileId, $attributes);
    }

    /**
     * Create permissions on a file.
     *
     * @param string $fileId
     * @param string $type
     * @param string $role
     *
     * @return \Google_Service_Drive_Permission
     */
    public function setPermission(string $fileId, string $type, string $role): \Google_Service_Drive_Permission
    {
        return $this->service->permissions->create(
            $fileId,
            new \Google_Service_Drive_Permission([
                'type' => $type,
                'role' => $role,
            ])
        );
    }

    /**
     * Create a drive file.
     *
     * @link https://developers.google.com/drive/api/v3/mime-types
     *
     * @param string $name
     * @param string $mimeType
     * @param array|null $optional
     *
     * @return \Google_Service_Drive_DriveFile
     */
    public function create(string $name, string $mimeType, array $optional = null): \Google_Service_Drive_DriveFile
    {
        $optional = array_replace([
            'fields' => 'id',
        ], (array) $optional);

        return $this->service->files->create(
            new \Google_Service_Drive_DriveFile([
                'name' => $name,
                'mimeType' => $mimeType,
            ]),
            $optional
        );
    }

    /**
     * Create a folder.
     *
     * @param string $name
     *
     * @return \Google_Service_Drive_DriveFile
     */
    public function createFolder(string $name): \Google_Service_Drive_DriveFile
    {
        return $this->create($name, 'application/vnd.google-apps.folder');
    }

    /**
     * Delete a file.
     *
     * @param string $fileId
     */
    public function delete(string $fileId): void
    {
        $this->service->files->delete($fileId);
    }

}
