<?php

namespace App\Services\ResourceServices;

use App\Http\Requests\ChangeProductPicturesRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ProductImageService
{
    public static function storeDefaultPictures(ChangeProductPicturesRequest $request, array $existingPictures = []): array {

        $pictures = [];

        for ($i = 0; $i < 4; $i++) {

            $existing =
                $existingPictures[$i]
                ?? null;

            $file =
                $request->file(
                    "default_pictures.$i"
                );

            if ($file) {

                $pictures[] = [
                    'picture_storage_key' =>
                        self::storeFile($file)
                ];

                continue;
            }

            if ($existing) {
                $pictures[] = $existing;
            }
        }

        return $pictures;
    }

    /*
    |--------------------------------------------------------------------------
    | COLOR PICTURES
    |--------------------------------------------------------------------------
    */

    public static function storeColorPictures(ChangeProductPicturesRequest $request, array $existingColors = []): array {
        $colors = [];

        $submittedColors = $request->input('colors', []);

        foreach ($submittedColors as $colorIndex => $color) {
            if (empty($color['displayName'])) {
                continue;
            }

            $existingColor = $existingColors[$colorIndex] ?? [];

            $existingPictures = $existingColor['pictures'] ?? [];

            $pictures = [];

            /*
            |--------------------------------------------------------------------------
            | PICTURE SLOTS
            |--------------------------------------------------------------------------
            */

            for ($i = 1; $i <= 4; $i++) {

                $existingPicture = $existingPictures[$i - 1] ?? null;

                $file = $request->file("color_pictures.$colorIndex.$i");

                if ($file) {
                    $pictures[] = [ 'picture_storage_key' => self::storeFile($file)];
                    continue;
                }

                if ($existingPicture) {
                    $pictures[] = $existingPicture;
                }
            }

            /*
            |--------------------------------------------------------------------------
            | SAVE COLOR
            |--------------------------------------------------------------------------
            */

            $colors[] = [

                'displayName' => $color['displayName'],
                'value' => $color['value'],
                'externalId' => $existingColor['externalId'] ?? Str::uuid(),
                'pictures' => $pictures
            ];
        }
        return $colors;
    }

    /*
    |--------------------------------------------------------------------------
    | ASSETS
    |--------------------------------------------------------------------------
    */

    public static function storeAssets(ChangeProductPicturesRequest $request, array $existingAssets = []): array {

        $assets = [];

        $submittedAssets = $request->input('assets', []);

        foreach ($submittedAssets as $assetIndex => $asset) {
            if (empty($asset['position'])) {
                continue;
            }

            $existing = $existingAssets[$assetIndex] ?? null;

            $file = $request->file("assets.$assetIndex.file");

            if ($file) {
                $assets[] = [
                    'position' => $asset['position'],

                    'asset_storage_key' => self::storeFile($file)
                ];
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | KEEP EXISTING
            |--------------------------------------------------------------------------
            */

            if ($existing) {
                $assets[] = [
                    'position' => $asset['position'],
                    'asset_storage_key' => $existing['asset_storage_key']
                ];
            }
        }
        return $assets;
    }

    private static function storeFile(UploadedFile $file): string {

        $filename = Str::uuid().'.'. $file->getClientOriginalExtension();
        $file->move(public_path('/storage'), $filename);

        return $filename;
    }
}