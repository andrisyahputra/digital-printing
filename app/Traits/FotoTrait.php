<?php
// PhotoTrait.php
namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait PhotoProdukTrait
{
    public function uploadPhoto($request, $fieldName, $storagePath, $produkLama = null)
    {
        // Validate the request
        $request->validate([
            $fieldName => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // $user = auth()->user();
        // dd($user);
        if ($produkLama && Storage::exists($produkLama)) {
            Storage::delete($produkLama);
        }

        // Get the file from the request
        $file = $request->file($fieldName);

        // Generate a unique filename
        $filename = time() . '.' . $file->getClientOriginalExtension();

        // Store the file in the specified storage path
        $path = $file->storeAs($storagePath, $filename);

        return $path;
    }
    private function setFolderPermissions($folderPath)
    {
        // Set the desired permissions for the folder
        $permissions = 0755; // Adjust as needed

        // Use chmod to set folder permissions
        chmod(storage_path('app/public/' . $folderPath), $permissions);
    }
}
