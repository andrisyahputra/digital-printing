<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait ConvertContentImageBase64ToUrl
{
    protected function convertBase64ImagesToUrls($content, $namaproduk)
    {
        $pattern = '/<img.*?src=["\'](data:image\/[^;]+;base64,([^\'"]+))["\'].*?>/i';
        preg_match_all($pattern, $content, $matches);

        $gambarBase64 = $matches[1];
        // $masjidId = auth()->user()->nama;

        foreach ($gambarBase64 as $gambar) {
            $data = explode(',', $gambar);
            $gambarData = $data[1];
            $mime = $data[0];
            $finfo = finfo_open();
            $ext = finfo_buffer($finfo, base64_decode($gambarData), FILEINFO_MIME_TYPE);
            finfo_close($finfo);
            $ext = explode('/', $ext)[1];

            $namaFile = "produk/summernote/$namaproduk/" . uniqid() . '.' . $ext;
            Storage::disk('public')->put($namaFile, base64_decode($gambarData));

            $namaFile = "/storage/$namaFile";
            $content = str_replace($gambar, $namaFile, $content);
        }

        return $content;
    }

    public function setContentAttribute($key, $value, $namaproduk)
    {
        if ($key === $this->contentName) {
            // Remove old images before updating content
            $this->removeOldImages($this->attributes[$key]);

            $value = $this->convertBase64ImagesToUrls($value, $namaproduk);
        }

        return parent::setAttribute($key, $value);
    }

    protected function removeOldImages($oldContent)
    {
        // Extract old image URLs from the content
        $pattern = '/<img.*?src=["\']\/storage\/([^\'"]+)["\'].*?>/i';
        preg_match_all($pattern, $oldContent, $matches);

        // Delete old images from storage
        foreach ($matches[1] as $oldImageUrl) {
            Storage::disk('public')->delete($oldImageUrl);
        }
    }


    private function extractImageUrls($content)
    {
        $pattern = '/<img[^>]+src="([^">]+)"/';
        preg_match_all($pattern, $content, $matches);

        return $matches[1];
    }
}
