<?php
// require_once "vendor/autoload.php";
namespace App\Libs;

use Google\Cloud\Storage\StorageClient;

class GoogleCloudLib
{
    // Reference Link https://googleapis.github.io/google-cloud-php/#/docs/google-cloud/v0.122.0/storage/storageclient
    // ***** NOTE *****
    // Untuk testing, bucketName = 'bataviarenttestingbucket'
    // Untuk prod, BucketName = 'bataviarentstoragebucket'
    // 03/06/2022 -> ganti bucketname jadi 'vendor-bptr';
    private $bucketName = 'bptr-vendor';
    private $chunkSize = 262144;
    private $storage;
    private $bucket;
    private $customDomain = '';

    function __construct() {
        self::initialize();
    }

    function initialize() {
        // Pakai ini jika credentialnya di simpan dalam file Json
        // $this->storage = new StorageClient(['keyFilePath' => "C:\..."]);

        $cred = json_decode('{
            "type": "service_account",
            "project_id": "bataviarentcloudstorage",
            "private_key_id": "dcb3a339e11870eb89f9c39c053556d29a7035d6",
            "private_key": "-----BEGIN PRIVATE KEY-----\nMIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQDVQ3Ob8gGz8Pvk\ncVSiLFzdD+IJCzF0dOnmKfNd5736hMljkIUC6wR/adwgqTXxgjJvRrkUadV8ctV4\nFSX9kXJYaULSIMKLjg33+Mcd9QJJJjLKGrQ3H6tYcInVNezF93LeeUvu7Gb8JzGr\nDdGEmf4JhpAKnyPQGhdIKl8v+P4a2lVtaq2PnMApMKnxxDybrCEksJ8CBsDv8Vx+\n/n/chyLlvuVNIZyFBs3KqHsw+oJumz0ElH3VcxPaphPEcXKFfeMsfkayLq/5gFIA\nySoQgkmVmA1kjBr4b+bz45/ZJQV6SsqVXAox7ynlKoAek/18/vOD7ed+xzg92ber\n8s1oSKsfAgMBAAECggEAAN2XOIjQ7PQLca/sEgRwFA2ecz7yYnCfCmodLMJmCQBE\n+Px7LbnaeNHrLM7DA0nt/nmhAq4zSaAFsckUMGVIu4ch2Ex9vadD8z+1Py/hZH6d\nMijNlnOwdFlwlcb0QRFyC+keH8gh2uAl2XXi5dDiMRO0vfZLZOrWMVrKrB0smttK\nG8h9sHzfuIR2J5Ne1EETCMlt4gMWGtb16j3TJay0CJtIycfIX3SIIew9AD+NcnaM\nIUVh0vYYAYThZ2NNUOcypSLasqh4qql11qyEGhljKohU1L4BF5Hye9BwrJ33u0hK\ntfylG7nZbdR2XAKYDPtczWG0QuvIYOiZ0VusZx1wgQKBgQDu/vhU3A7/xhOzAPRj\nirW3meyRb6hx1yJfEnDHQzIGxyNyQAmL9EoMcw5CjXhbxUkkOXbLoPFPJv1PIzHD\nmITT42nUdoeqK2EKjI4YKAycMQI4uYl+R5LLNXvJ0pyBLtS7FtkDjs3usw9c8jAr\n+krEGnS4nBcWPmcEMrUd5aESYQKBgQDkb8tlO6xZCHi1dhTAZ6wHgp7WSjezQiEH\n0OTtDPcTKOM/+zijlaQhJTNRMWlr8ItFPSZEKQl/x/qlkxiCdSPXJP2CGc4rNfCa\nF3+d08c5+zRHH56ubH69qFf3p5mBKreCtvOJKt6tEX0e3nrbivfC6AYJtl/2/JSm\nChdrYhWtfwKBgQCR+LD8Q5v1pKmLf13FHod2qFDRU31yao/XuY+gZO49LYv80BgE\nnyRLDkr7YyTMCGdv9JkWLiq0yX+Vwk02xgT61b9hwTODQBN5Offf0TZCf7x3oPrV\nYinKa9Q7pKNqU4wi6QWLIsGstTkA7/t0IN9hfzcjOlLvhxWsfrwYkpQagQKBgQCE\nHYAF8WgxKeweDsfbq1ncEhhpGQ1z2EggLBlqW/g9lYUwyMuuGGqPXON8DtbIvZre\nlYofG5jJ1U/KGPOw56ytzk/rwZ7ycMTRacu97PCpQPawN8JfYJJAgC84JS9re9gc\nelEJQMj+UUIK62MkvA+lIunzDg4cW2JhUS7QRS8CYwJ/OB0FKJvl7GLE6fijHA1s\nwaMfB1e3EuqkKIoLjO2emkjXZi3tTghdcNyOAB76yQgc2tah+0NZOS0G61QUabLC\ny5lWadFHOw+EaI+a4kqybdBr6m05VBX8lOoNzm2gWocB4NYioYUsJ9zCZhPOHZrX\nH0KfoB7dnQLjHhqvq8XIJQ==\n-----END PRIVATE KEY-----\n",
            "client_email": "editorbataviarentcloudstorage@bataviarentcloudstorage.iam.gserviceaccount.com",
            "client_id": "105187415907306297030",
            "auth_uri": "https://accounts.google.com/o/oauth2/auth",
            "token_uri": "https://oauth2.googleapis.com/token",
            "auth_provider_x509_cert_url": "https://www.googleapis.com/oauth2/v1/certs",
            "client_x509_cert_url": "https://www.googleapis.com/robot/v1/metadata/x509/editorbataviarentcloudstorage%40bataviarentcloudstorage.iam.gserviceaccount.com"
          }', true);
        $this->storage = new StorageClient(['keyFile' => $cred]);
        
        $this->bucket = $this->storage->bucket($this->bucketName);
        $this->customDomain = 'https://storage.googleapis.com/'.$this->bucketName.'/';
    }

    public function createBucket($bucketName) {
        $result = new \stdClass();
        $result->result = false;
        $result->message = '';
        
        try {
            $bucket = $this->storage->bucket($bucketName);
            if (!$bucket->exists()) {
                $response = $this->storage->createBucket($bucketName);
                $result->result = true;
                $result->message = 'Bucket created.';
            } else {
                $result->result = false;
                $result->message = 'Bucket already exists.';
            };
        } catch(Exception $e) {
            $result->result = false;
            $result->message = $e->getMessage();
        }

        return $result;
    }

    public function checkBucket($bucketName) {
        $result = new \stdClass();
        $result->result = false;
        $result->message = '';
        
        try {
            $bucket = $this->storage->bucket($bucketName);
            if (!$bucket->exists()) {
                $result->result = false;
                $result->message = 'Bucket does not exists.';
            } else {
                $result->result = true;
                $result->message = 'Bucket exists';
            };
        } catch(Exception $e) {
            $result->result = false;
            $result->message = $e->getMessage();
        }
        return $result;
    }

    // fileName nya include folder name jika ingin memasukkan file tsb dalam folder,
    // Contoh : [FolderName]/[NamaFile.txt]
    public function upload($sourceFilePath, $fileName) {
        $result = new \stdClass();
        $result->result = false;
        $result->message = '';

        try {
            $options = ['name' => $fileName,'predefinedAcl' => 'publicRead'];
            // $options = ['name' => 'testfile.jpg','predefinedAcl' => 'publicRead'];

            $file = file_get_contents($sourceFilePath);

            // Upload your data in a simple fashion. Uploads will default to being resumable if the file size is greater than 5mb.
            // Untuk Akses Type ada 2 (Di Tab Configuration -> Permision -> Access control) :
            // - Uniform -> Access level berlaku untuk semua file di dalam bucket
            // - Fine-grained -> Access level dapat berlaku untuk masing" file didalam bucket
            // Untuk predifined ACL ini gunanya untuk set access setiap folder/file
            // ['predefinedAcl' => 'publicRead']
            $object = $this->bucket->upload(
                //fopen($sourceFilePath, 'r'),
                $file,
                $options
            );

            $result->result = true;
            $result->Url = $this->customDomain . $fileName;
            $result->message = 'File Uploaded';
        } catch(Exception $e) {
            $result->result = false;
            $result->message = $e->getMessage();
        }

        return $result;
    }
    
    // Function ini untuk upload data yg besar, supaya jika terjadi masalah di pertengahan proses, upload dapat di lanjutkan
    // fileName nya include folder name jika ingin memasukkan file tsb dalam folder,
    // Contoh : [FolderName]/[NamaFile.txt]
    public function uploadResumable($sourceFilePath, $fileName) {
        $result = new \stdClass();
        $result->result = false;
        $result->message = '';

        try {
            $options = [
                'chunkSize' => $this->chunkSize,
                'name' => $fileName,
            ];            

            $uploader = $this->bucket->getResumableUploader(
                fopen($sourceFilePath, 'r'), $options
            );
            
            try {
                $object = $uploader->upload();
                $result->result = true;
                $result->message = 'File uploaded.';
            } catch (GoogleException $ex) {
                $result->result = false;
                $result->message = 'File NOT uploaded.';

                $resumeUri = $uploader->getResumeUri();
                $object = $uploader->resume($resumeUri);
            }
        } catch(Exception $e) {
            $result->result = false;
            $result->message = $e->getMessage();
        }

        return $result;
    }

    public function download($objectName, $destinationFilePath) {
        $result = new \stdClass();
        $result->result = false;
        $result->message = '';

        $destinationFilePath = '/Downloads';
        try {
            $object = $this->bucket->object($objectName);
            if ($object->exists()) {
                $googleObjectName = str_replace(array("\n", "\r"), '', basename($objectName).PHP_EOL);
                $stream = $object->downloadToFile($destinationFilePath . '/' .$googleObjectName);
                $result->result = true;
                $result->message = 'File downloaded.';
            } else {
                $result->result = false;
                $result->message = 'File does not exists.';
            };
        } catch(Exception $e) {
            $result->result = false;
            $result->message = $e->getMessage();
        }

        return $result;
    }

    public function renameObject($objectName, $newObjectName) {
        $result = new \stdClass();
        $result->result = false;
        $result->message = '';

        try {
            $object = $this->bucket->object($objectName);

            if ($object->exists()) {
                $options = ['predefinedAcl' => 'publicRead'];
                $object2 = $object->rename($newObjectName, $options);
                $result->result = true;
                $result->message = 'File renamed.';
            } else {
                $result->result = false;
                $result->message = 'File does not exists.';
            };
            
        } catch(Exception $e) {
            $result->result = false;
            $result->message = $e->getMessage();
        }

        return $result;
    }

    public function deleteObject($objectName) {
        $result = new \stdClass();
        $result->result = false;
        $result->message = '';

        try {
            $object = $this->bucket->object($objectName);
            if ($object->exists()) {
                $object->delete();
                $result->result = true;
                $result->message = 'Object deleted.';
            } else {
                $result->result = false;
                $result->message = 'Object does not exists.';
            };
        } catch(Exception $e) {
            $result->result = false;
            $result->message = $e->getMessage();
        }

        return $result;
    }

    public function checkObject($objectName) {
        $result = new \stdClass();
        $result->result = false;
        $result->message = '';

        try {
            $object = $this->bucket->object($objectName);
            if ($object->exists()) {
                $result->result = true;
                $result->message = 'Object exists.';
            } else {
                $result->result = false;
                $result->message = 'Object does not exists.';
            };
        } catch(Exception $e) {
            $result->result = false;
            $result->message = $e->getMessage();
        }

        return $result;
    }

    public function listObjects() {
        $result = new \stdClass();
        $result->result = false;
        $result->message = '';
        $result->objectList = array();

        // Tambahin prefix, jika ingin filter data yang di ambil
        $options = ['prefix' => ''];
        foreach ($this->bucket->objects($options) as $object) {
            array_push($result->objectList, $object->name());
        }
        
        return $result;
    }
}

// $googleLib = new GoogleCloudLib();

// try {
//     // $response = $googleLib->upload('C:\xampp\htdocs\TestWeb\TestingSaja2.txt');
//     // $response = $googleLib->download('Testing/TestingSaja.txt', 'C:\xampp\htdocs\TestWeb');
//     // $response = $googleLib->checkBucket('bataviarentforwarderbucket');
//     $response = $googleLib->getObjects();
//     echo $response->message;
//     print_r($response->objectList);
// } catch(Exception $e) {
//     echo $e->getMessage();
// }

?>