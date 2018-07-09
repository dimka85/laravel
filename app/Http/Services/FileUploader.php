<?php

namespace App\Http\Services;

class FileUploader
{
    public function uploadAvatar($user_id, $avatar)
    {
        return Storage::putFile('avatars/' . $user_id, $avatar);
    }
}
