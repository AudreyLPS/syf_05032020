<?php

namespace App\Service;

use Symfony\Component\String\ByteString;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileService
{
    private $fileName;

    public function upload(UploadedFile $file, string $directory):void
    {
        $this->fileName = ByteString::fromRandom(32). '.' . $file->guessClientExtension();
        $file->move($directory , $this->fileName);

    }

    public function delete(string $fileName, string $directory):void
    {
        unlink("$directory/$fileName");

    }

    public function getFileName():string 
    {
        return $this->fileName;
    }
}