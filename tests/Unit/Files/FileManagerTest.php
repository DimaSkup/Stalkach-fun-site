<?php

namespace Tests\Unit\Files;

use Illuminate\Http\UploadedFile;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

use App\Helpers\Utils;
use App\Helpers\FileManager;
use App\Helpers\LocalFileManager;

use Tests\Unit\TestUtils;
use Tests\TestCase;

// here we execute testing of the implementation of the FileManager interface
// which is called LocalFileManager;
// we do it to make an assurance that work with files using this implementation is correct;
class FileManagerTest extends TestCase
{
    private FileManager $fileManager;
    private static string $testDiskName = "storage_root";
    private static string $testDirName = "/temp/";
    private static string $linkToRemoteFile = "https://img.freepik.com/premium-photo/astronaut-outer-open-space-planet-earth-stars-provide-background-erforming-space-planet-earth-sunrise-sunset-our-home-iss-elements-this-image-furnished-by-nasa_150455-16829.jpg";


    // can we create a file manager object?
    public function test_creation_of_file_manager_object(): void
    {
        $this->fileManager = new LocalFileManager(self::$testDiskName);

        $this->assertInstanceOf(LocalFileManager::class, $this->fileManager);
        $this->assertObjectHasAttribute("disk", $this->fileManager);
    }

    // can we set/get the disk name?
    public function test_can_set_and_get_disk_from_file_manager(): void
    {
		// assert disk name
        $this->fileManager = new LocalFileManager(self::$testDiskName);
        $this->assertEquals(self::$testDiskName, $this->fileManager->getDisk());

        // change the disk name and check it
        $newDiskName = "disk_name";
        $this->fileManager->setDisk($newDiskName);
        $this->assertEquals($newDiskName, $this->fileManager->getDisk());
    }

    // can we use a storage temporal disk?
    public function test_we_get_and_set_temp_disk(): void
    {
        $this->fileManager = new LocalFileManager(); // now the disk has default value

        // act (set the storage temporal disk as a current)
        $this->fileManager->setDisk($this->fileManager->getTempDisk());

        // assertions (check if the current disk name is equal to the temporal disk name)
        $this->assertEquals($this->fileManager->getTempDisk(), $this->fileManager->getDisk());
    }

    // can we get the name of temporal files type
    public function test_we_cant_get_temp_file_type(): void
    {
        $this->fileManager = new LocalFileManager();

        $tempFileType = $this->fileManager->getTempFileType();  // act

        // assertions
        $this->assertIsString($tempFileType);
        $this->assertNotEmpty($tempFileType);
    }


    //
    // ---------------------- FILE DATA GETTERS TESTS -------------------------------- //
    //

    // can we get the full path to the file by its short path in storage?
    public function test_get_full_path(): void
    {
        $this->fileManager = new LocalFileManager(self::$testDiskName);
        $testFile = TestUtils::createNewTestFile("testImage", "jpg");  // create a new test file
		$pathToTempDir = $this->fileManager->getPathToDirByType($this->fileManager->getTempFileType());
		$storagePathToFile = $pathToTempDir . $testFile->getFilename();

        // act
        $fullPathToFakeFile = $this->fileManager->getFullPathByStoragePath($storagePathToFile);

        // assertions
        $this->assertStringContainsString("/home", $fullPathToFakeFile);
    }

    // can we get a content of the file by object/link?
    // CASE 1: get content of the UploadedFile object
    public function test_get_content_by_file_object(): void
    {
        $this->fileManager = new LocalFileManager(self::$testDiskName);
        $testFile = UploadedFile::fake()->image('fakeImage.jpg');

        $contentByFileObj = $this->fileManager->getContent($testFile);  // act

        // assertions
        $this->assertIsString($contentByFileObj);  // did we get file content by the object?
    }

    // CASE 2: get content of the file by its link
    public function test_get_content_by_link_to_file(): void
    {
        $this->fileManager = new LocalFileManager(self::$testDiskName);

        $contentByLink = $this->fileManager->getContent(self::$linkToRemoteFile);  // act

        // assertions
        $this->assertIsString($contentByLink);   // did we get file content by the link?
    }

    // can we get the file size in bytes?
    public function test_get_file_size_in_bytes(): void
    {
        $this->fileManager = new LocalFileManager(self::$testDiskName);
        $testFile = UploadedFile::fake()->image('fakeImage.jpg');

        $fileSize = $this->fileManager->getFileSizeInBytes($testFile);  // act

        // assertions
        $this->assertIsInt($fileSize);
    }

    // can we check if this file is remote or not?
    public function test_is_remote_file(): void
    {
        $this->fileManager = new LocalFileManager(self::$testDiskName);
        $testFile = UploadedFile::fake()->image("fakeImage.jpg");

        // CASE 1: the file is local
        $isLocal = !($this->fileManager->isRemoteFile($testFile));             // act
        $this->assertTrue($isLocal);                                           // assertions

        // CASE 2: the file is remote
        $isRemote = $this->fileManager->isRemoteFile(self::$linkToRemoteFile); // act
        $this->assertTrue($isRemote);                                          // assertions
    }

    // CAN WE GET CONFIGS BY TYPE?
    // --- CASE 1 (CORRECT): get config data for some particular file type --- //
    public function test_get_file_configs_by_some_particular_type(): void
    {
        $this->fileManager = new LocalFileManager(self::$testDiskName);
        $newConfigKey = "test_type";
        Config::set("filesystems.types.$newConfigKey",  // set some config data to get it later
            [
                'size' => 100,
                "kek" => "lol",
            ]
        );

        $configData = $this->fileManager->getFileConfigsByType($newConfigKey); // get config data by such a key

        // assertions
        $this->assertIsArray($configData);
        $this->assertIsInt($configData['size']);
        $this->assertIsString($configData['kek']);
    }

    // --- CASE 2 (CORRECT): we get all the configurations for files if the config key is empty --- //
    public function test_get_all_the_file_configs_if_config_key_is_empty(): void
    {
        $this->fileManager = new LocalFileManager(self::$testDiskName);

        $configData = $this->fileManager->getFileConfigsByType(); // get all the configurations

        // assertions
        $this->assertIsArray($configData);
        $this->assertTrue(count($configData) > 1); // assert that we got more than only one config key
    }

    // --- CASE 3 (EXCEPTION): get an exception if data by key is empty --- //
    public function test_get_an_exception_if_there_is_no_such_config_key(): void
    {
        $this->fileManager = new LocalFileManager(self::$testDiskName);

        // ACT: now we have to get an exception because we don't have such a config key
        $this->expectException(\RuntimeException::class);
        $configData = $this->fileManager->getFileConfigsByType('there_is_no_such_config_key');
    }

    // can we get a path to directory for this particular file type?
    public function test_get_path_to_directory_by_file_type(): void
    {
        $this->fileManager = new LocalFileManager(self::$testDiskName);
        $fileType = "test_type";
        $configKey = "filesystems.types.$fileType"; // make a new config key

        // --- CASE 1 (CORRECT): we have some PATH data in configs
        $pathToDir = '/path/to/some/dir/';
        Config::set($configKey, ['path' => $pathToDir]);

        $filePath = $this->fileManager->getPathToDirByType($fileType);
        $this->assertIsString($filePath);

        // --- CASE 2 (EXCEPTION): we don't have any PATH data or such a key in configs
        Config::set($configKey, ['path' => ""]);  // set empty path data

        $this->expectException(\RuntimeException::class);       // assertions/act
        $this->fileManager->getPathToDirByType($fileType);      // this call generates an exception
    }



    //
    // ------------------------ FILE OBJECT GETTERS TESTS ---------------------------- //
    //

    // can we get the file object by its short path in storage?
    public function test_get_file_by_storage_path(): void
    {
    	// make a test file
        $this->fileManager = new LocalFileManager(self::$testDiskName);
        $testFile = TestUtils::createNewTestFile("testImage", "jpg");
        $storagePathToTestFile =  self::$testDirName . $testFile->getFilename();

        // CASE 1 (CORRECT): we got a file object by such a storage path
        $file = $this->fileManager->getFileByStoragePath($storagePathToTestFile);
        $this->assertInstanceOf(File::class, $file);

        // CASE 2 (EXCEPTION): we'll get an exception because we don't have a file by such a storage path
        $this->expectException(FileNotFoundException::class); // assertion: we'll have to get this kind of exception because there will be no such a file by this path
        $file = $this->fileManager->getFileByStoragePath(self::$testDirName . "no_such_a_file.jpg");
    }

    // can we get the file object by its full path?
    public function test_get_file_by_full_path(): void
    {
        // preparation
        $this->fileManager = new LocalFileManager(self::$testDiskName); // because we want to access to fake files we use 'storage_root' disk
        $testFile = TestUtils::createNewTestFile("testImage", "jpg"); // create a new test file by the self::$testFilePath path on the self::$testDiskName disk
        $fullPathToExistedFile = $testFile->getRealPath();
        $fullPathToNotExistedFile = $testFile->getPath() . "/" . "noFile.jpg";

        // CASE 1 (CORRECT): we got a file object by such a full path
        $file = $this->fileManager->getFileByFullPath($fullPathToExistedFile); // act
        $this->assertInstanceOf(File::class, $file);                           // assertions

        // CASE 2 (EXCEPTION): we don't have any file object by such a full path
        $this->expectException(FileNotFoundException::class);                  // assertions
        $this->fileManager->getFileByFullPath($fullPathToNotExistedFile);      // act
    }


    // can we create a temporal file by some resource (other file obj OR link)
    public function test_get_temp_file_by_resource(): void
    {
		try {
			$this->fileManager = new LocalFileManager();
			$file = UploadedFile::fake()->image('test_image.jpg'); // prepare a file obj
			$link = self::$linkToRemoteFile;                       // prepare a link to a file

			$tempFileByFile = $this->fileManager->getTempFileByResource($file); // case 1: get temp copy file by other file
			$tempFileByLink = $this->fileManager->getTempFileByResource($link); // case 2: get temp copy file by some link
		}
		catch (\InvalidArgumentException $e)
		{
			Utils::dd($e->getTraceAsString());
		}

        $this->assertInstanceOf(File::class, $tempFileByFile);   // assert that we got File object in both cases
        $this->assertInstanceOf(File::class, $tempFileByLink);

        $this->assertGreaterThan(0, $tempFileByFile->getSize()); // and these copies are not empty
        $this->assertGreaterThan(0, $tempFileByLink->getSize());
    }


    //
    // -------------------------- FILE SAVERS TESTS ---------------------------------- //
    //

    public function test_store_content_as_file_to(): void
    {
        // preparation
        $testDirName = "test/";
        $this->fileManager = new LocalFileManager(self::$testDiskName);
        Storage::fake(self::$testDiskName); // create a test disk
        $testFile = UploadedFile::fake()->image("testImage.jpg"); // make a file to get later its content

        // act
        $storagePathToFile = $this->fileManager->storeContentAsFileTo($testFile->getContent(), $testDirName, "png");
        $fullPathToFile = $this->fileManager->getFullPathByStoragePath($storagePathToFile);

        // assertion
        $this->assertFileExists($fullPathToFile);
    }

    //
    // -------------------- TESTS FOR OPERATIONS WITH FILES -------------------------- //
    //

    // can we delete the file by storage path?
    public function test_delete_file_by_storage_path(): void
    {
        // preparation
        $this->fileManager = new LocalFileManager(self::$testDiskName);
        $testFile = TestUtils::createNewTestFile("testImage", "jpg"); // create a new test file by the self::$testFilePath path on the self::$testDiskName disk
        $fullPathToTestFile = $testFile->getRealPath();   // later we check by this path if the file does not exist
        $storagePathToTestFile =  self::$testDirName . "/" . $testFile->getFilename();

        // act
        $this->fileManager->deleteFileByStoragePath($storagePathToTestFile);

        // assertions
        $this->assertFileDoesNotExist($fullPathToTestFile);
    }


    // can we delete the file its full path?
    public function test_delete_file_by_full_path(): void
    {
        // preparation
        $this->fileManager = new LocalFileManager(self::$testDiskName);
        $testFile = TestUtils::createNewTestFile("testImage", "jpg"); // create a new test file by the self::$testFilePath path on the self::$testDiskName disk
        $fullPathToTestFile = $testFile->getRealPath();

        // act
        $this->fileManager->deleteFileByFullPath($fullPathToTestFile);

        // assertions
        $this->assertFileDoesNotExist($fullPathToTestFile);
    }


    // --------------------------------- UTILS --------------------------------------- //

    // THIS IS NOT A TEST BY ITSELF BUT EXECUTES AS TEST because we need to clean up the
    // temporary directory from test files after all tests;
    public function test_clean_up_temporary_directory_from_temporal_files(): void
    {
        $cleanResult = TestUtils::cleanTempDir();

        $this->assertTrue($cleanResult); // confirm that the temp directory is empty now
    }
}
