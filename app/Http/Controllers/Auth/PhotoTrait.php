<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Storage;

trait PhotoTrait
{
    public function uploadPhoto($request, $fieldName, $storagePath,  $produkLama = null)
    {
        // Get the file from the request
        // Validate the request
        $request->validate([
            $fieldName => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        // $user = auth()->user();
        // dd($user);
        if ($produkLama && Storage::exists($produkLama)) {
            Storage::delete($produkLama);
        }
        $file = $request->file($fieldName);
        // dd($file);
        // Generate a unique filename
        $filename = time() . '.' . $file->getClientOriginalExtension();

        // Store the file in the specified storage path
        $path = $file->storeAs($storagePath, $filename);

        return $path;
    }

    public function movePhotoToOrderFolder($oldPath, $orderPath)
    {
        // Pastikan path lama ada
        if (Storage::exists($oldPath)) {
            // Ambil nama file dari path lama
            $filename = pathinfo($oldPath, PATHINFO_BASENAME);

            // Generate path baru untuk folder pesanan
            $newPath = $orderPath . '/' . $filename;

            // Pindahkan file ke folder pesanan
            Storage::move($oldPath, $newPath);

            // Kembalikan path baru
            return $newPath;
        }

        return null;
    }
}
