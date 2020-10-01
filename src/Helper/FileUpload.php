<?php

declare(strict_types=1);

namespace App\Helper;


//use Psr\Http\Message\ResponseInterface as Response;

final class FileUpload
{
    public static function getFileUrl(
        Array $files
    ): String {
        if(count($files)> 0){
            $result = '';
            $file_path = dirname(dirname(__DIR__)) . $_SERVER['UPLOAD_DIR'];
           foreach($files as $name => $file)  {
            if ($file->getError() === UPLOAD_ERR_OK) {
                $filename = self::moveUploadedFile($file_path, $file);
                $result .= $_SERVER['BASE_URL'].'uploads/' . $filename . ',';
            }
           }
           $result = rtrim($result, ',');
        }
       
        return $result;
    }

    protected function moveUploadedFile($directory, $uploadedFile) : String  {
            $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
            $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
            $filename = sprintf('%s.%0.8s', $basename, $extension);

            $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

            return $filename;
        }
}
