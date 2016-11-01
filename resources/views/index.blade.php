@extends('layouts.master')

@section('content')

<div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>



                <ul>
                                     <li>
                                         <a href="{{ url('/logout') }}"
                                             onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">
                                             Logout
                                         </a>
 
                                         <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                             {{ csrf_field() }}
                                         </form>
                                     </li>
                                 </ul>

@endsection

