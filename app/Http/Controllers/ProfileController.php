<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Начальная страница Профиль
    public function index(Request $request)
    {
      	if(!$request->userid)
    	{
    		return redirect()->back();
    	}    	

    	$userid = $request->userid;
    	return view('admin.profile.index', compact('userid'));
    }
}
