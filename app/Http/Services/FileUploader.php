<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Storage;

class FileUploader
{
    public function uploadAvatar($user_id, $avatar)
    {
        return Storage::putFile('avatars/' . $user_id, $avatar);
    }
}
