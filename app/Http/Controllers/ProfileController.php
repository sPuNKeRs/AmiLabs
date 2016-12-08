<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Role;
use Image;

class ProfileController extends Controller
{
    protected $user;
    protected $profile;


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            $this->profile = Profile::find($this->user->profile->id);
            return $next($request);
        });
    }

    // Начальная страница Профиль
    public function index(Request $request)
    {
        $user = $this->user;
        $profile = $this->profile;
        $user_types = Role::getArray();

        return view('admin.profile.index', compact('user', 'profile', 'user_types'));
    }

    // Сохранение профиля
    public function edit(Request $request)
    {
        $input = $request->except(['_token', 'avatar']);
        //dd($input);
        $user = $this->user;
        //$user->roles->sync([$input['user_type_id']]);

        $profile = $this->profile;

        if($request->hasFile('avatar'))
        {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(90, null, function ($constraint) {$constraint->aspectRatio();})->save(public_path( 'images/avatars/' . $filename));
            $input['avatar'] = $filename;


            // Удалить старое изображение
            if(file_exists(public_path( 'images/avatars/' . $profile->avatar)) && isset($profile->avatar))
            {
                unlink(public_path( 'images/avatars/' . $profile->avatar));
                $input['avatar'] = $filename;
            }
        }


        $profile->update($input);

        return redirect('profile')->with(['status'=>'Профиль успешно обновлен.']);
    }
}
