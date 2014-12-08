<?php
class AuthController extends BaseController {


  public function index() {

    return View::make('admin.login');
  }


  public function login() {
    $validator = Validator::make(Input::all(), User::$rules);
    if($validator->passes()) {
        $username = Input::get('name');
        $password = Input::get('password');
        if(Auth::attempt(array('name' => $username, 'password' => $password))) {
            return Redirect::route('thecakeisalie');
        }
    }

    return Redirect::back()->withInput()->withErrors($validator);
  }

  public function logout() {
    Auth::logout();
    
    return Redirect::route('thecakeisalie');
  }



}