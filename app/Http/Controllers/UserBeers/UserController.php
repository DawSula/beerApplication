<?php

namespace App\Http\Controllers\UserBeers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserProfile;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\Filesystem;
use League\Flysystem\AwsS3v3\AwsS3Adapter;

class UserController extends Controller
{

    private UserRepositoryInterface $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function profile()
    {



        return view('me.profile', ['user' => Auth::user()]);

    }

    public function edit()
    {

        return view('me.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();

//        dd($data);

        $path = null;
        if (!empty($data['avatar'])) {
//            $path = $data['avatar']->store('avatars', 's3');
            $path = $request->file('avatar')->store('avatars','s3');
            //$path = $data['avatar']->storeAs('avatars', $admin->id() . '.png', 'public');


            if ($path) {
                Storage::disk('s3')->delete($user->avatar);
                $data['avatar'] = $path;
            }
        }



//        $path = $request->file('avatar')->store('images','s3');

        // logika zapisu
        $this->userRepository->updateModel(Auth::user(), $data);

//        return Storage::disk('s3')->response($path);
        return redirect()
            ->route('me.profile')
            ->with('success', 'Profil zaktualizowany');
    }
}
