<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserProfile;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function update(UpdateUserProfile $request)
    {
        $user = Auth::user();
        $data = $request->validated();

        $path = null;
        if (!empty($data['avatar'])) {
            $path = $data['avatar']->store('avatars', 'public');
            //$path = $data['avatar']->storeAs('avatars', $user->id() . '.png', 'public');

            if ($path) {
                Storage::disk('public')->delete($user->avatar);
                $data['avatar'] = $path;
            }
        }

        // logika zapisu
        $this->userRepository->updateModel(Auth::user(), $data);

        return redirect()
            ->route('me.profile')
            ->with('success', 'Profil zaktualizowany');
    }
}
