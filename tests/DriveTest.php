<?php

namespace BaseCardHero\Drive\Tests;

use BaseCardHero\Drive\Drive;
use BaseCardHero\Drive\DriveInterface;

class DriveTest extends TestCase
{
    /**
     * @var \Google_Client
     */
    protected $client;

    /**
     * @var \Google_Service_Sheets
     */
    protected $service;

    /**
     * @var \BaseCardHero\Drive\Drive
     */
    protected $drive;

    /**
     * Override of parent::setUp().
     */
    public function setUp()
    {
        parent::setUp();

        $this->client = new \Google_Client();
        $this->service = new \Google_Service_Drive($this->client);
        $this->drive = $this->partial(Drive::class, [$this->service]);
    }

    /** @test */
    public function it_implements_DriveInterface()
    {
        $this->assertInstanceOf(DriveInterface::class, $this->drive);
    }

    /** @test */
    public function getService_will_return_the_Google_Service_Sheets()
    {
        $this->assertEquals($this->service, $this->drive->getService());
    }

    /** @test */
    public function get_will_return_a_Google_Service_Drive_DriveFile()
    {
        $file = $this->createFile();

        $this->service->files = $this->mock();
        $this->service->files->shouldReceive('get')
            ->withArgs(function ($fileId, $attributes) use ($file) {
                $this->assertEquals($file->id, $fileId);
                $this->assertEquals(['fields' => 'id'], $attributes);

                return true;
            })->andReturn($file);

        $this->assertEquals($file->id, $this->drive->get($file->id)->id);
    }

    /** @test */
    public function setPermission_will_create_an_create_request()
    {
        $file = $this->createFile();
        $type = 'anyone';
        $role = 'reader';

        $this->service->permissions = $this->mock();
        $this->service->permissions->shouldReceive('create')
            ->withArgs(function ($fileId, $permission) use ($file, $type, $role) {
                $this->assertEquals($file->id, $fileId);
                $this->assertEquals($type, $permission->type);
                $this->assertEquals($role, $permission->role);

                return true;
            })
            ->andReturn(new \Google_Service_Drive_Permission());

        $this->assertInstanceOf(\Google_Service_Drive_Permission::class, $this->drive->setPermission($file->id, $type, $role));
    }

    /** @test */
    public function create_will_create_a_drive_file()
    {
        $name = 'file-name';
        $mimeType = 'application/vnd.google-apps.file';

        $this->service->files = $this->mock();
        $this->service->files->shouldReceive('create')
            ->withArgs(function ($file, $optional) use ($name, $mimeType) {
                $this->assertEquals($name, $file->name);
                $this->assertEquals($mimeType, $file->mimeType);
                $this->assertEquals(['fields' => 'id'], $optional);

                return true;
            })->andReturn(new \Google_Service_Drive_DriveFile());

        $this->assertInstanceOf(\Google_Service_Drive_DriveFile::class, $this->drive->create($name, $mimeType));
    }

    /** @test */
    public function createFolder_will_create_a_request_to_create_a_folder()
    {
        $name = 'folder-name';
        $mimeType = 'application/vnd.google-apps.folder';

        $this->drive->shouldReceive('create')
            ->with($name, $mimeType)
            ->andReturn(new \Google_Service_Drive_DriveFile());

        $this->assertInstanceOf(\Google_Service_Drive_DriveFile::class, $this->drive->createFolder($name));
    }

    /**
     * Create a Google_Service_Drive_DriveFile.
     *
     * @param array $args
     *
     * @return \Google_Service_Drive_DriveFile
     */
    protected function createFile($args = [])
    {
        if (!isset($args['id'])) {
            $args['id'] = md5(mt_rand());
        }

        return new \Google_Service_Drive_DriveFile($args);
    }
}
