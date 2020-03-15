<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{


    public function getUserDetail($id){

        $data = DB::table('users')
            ->where('users.id', '=',$id)
            ->join('user_profiles','users.id','=','user_profiles.user_id')
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'user_profiles.profile_image',
                'user_profiles.profile_image_path',
                'user_profiles.bio'
            )
            ->first();

        return Response()->json($data, Response::HTTP_OK);
    }
}
