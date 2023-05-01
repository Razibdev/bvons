<?php
namespace App\KuHelpers\UploadFacades;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Upload {
    /**
     * Replace the given disk with a local testing disk.
     *
     * @param  string|array  $base64
     * @param  string  $disk = 'default'
     * @param  string  $path = ''
     * @return array
     */
    public function storeMediaFromBase64($base64, $disk = 'default', $path = '') {
        $base_content_list = [];
        if(!is_array($base64)) {
            $base_content_list[] = base64_decode($base64);
        } else {
            foreach ($base64 as $single_base64) {
                $base_content_list[] = base64_decode($single_base64);
            }
        }
        $uploadedFileList = [];
        if(count($base_content_list)) {
            for ($i = 0; $i < count($base_content_list); $i++) {
                $uploadedFileList[] = $filename = Str::uuid() . ".jpg";
                Storage::disk($disk)->put($path. '/' .$filename, $base_content_list[$i]);
            }
        }
        return $uploadedFileList;
    }
}
