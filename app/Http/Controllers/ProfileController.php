<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Profile;
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

        return view('admin.profile.index', compact('user', 'profile'));
    }

    // Сохранение профиля
    public function edit(Request $request)
    {
        $input = $request->except(['_token', 'avatar']);
        $user = $this->user;
        $profile = $this->profile;

        if($request->hasFile('avatar'))
        {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(90, null, function ($constraint) {$constraint->aspectRatio();})->save(public_path( '/images/avatars/' . $filename));


            // Удалить старое изображение
            if(file_exists(public_path( 'images/avatars/' . $profile->avatar)))
            {
                unlink(public_path( 'images/avatars/' . $profile->avatar));    
            }            
        }

        $input['avatar'] = $filename;
        $profile->update($input);

        return redirect('profile')->with(['status'=>'Профиль успешно обновлен.']);
    }
}
