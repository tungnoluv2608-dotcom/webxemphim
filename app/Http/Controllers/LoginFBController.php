<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginFBController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();

            // Facebook đôi khi không trả về email
            $email = $user->email ?? ($user->id . '@facebook.com');

            $finduser = User::where('email', $email)->first();

            if ($finduser) {

                // cập nhật facebook_id nếu chưa có
                if (!$finduser->facebook_id) {
                    $finduser->update(['facebook_id' => $user->id]);
                }

                Auth::login($finduser);
                return redirect()->intended('/');
            } else {

                $newUser = User::create([
                    'name'        => $user->name,
                    'email'       => $email,
                    'facebook_id' => $user->id,
                    'password'    => bcrypt('123456789'),
                ]);

                Auth::login($newUser);
                return redirect()->intended('/');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
