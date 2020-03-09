<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
      if ($data['bday-month'] < 10) {
          $data['bday-month'] = 0 . $data['bday-month'];
      }
      if ($data['bday-day'] < 10) {
          $data['bday-day'] = 0 . $data['bday-day'];
      }

      $data['birthday'] = $data['bday-year'] . '-' . $data['bday-month'] . '-' . $data['bday-day'];

        return Validator::make($data, [
            'uname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'birthday' => ['required', 'date_format:"Y-m-d"'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

      if ($data['bday-month'] < 10) {
          $data['bday-month'] = 0 . $data['bday-month'];
      }
      if ($data['bday-day'] < 10) {
          $data['bday-day'] = 0 . $data['bday-day'];
      }

      $data['birthday'] = $data['bday-year'] . '-' . $data['bday-month'] . '-' . $data['bday-day'];

        $ref_date = Carbon::createFromDate('1921-12-26');
        $birthday = Carbon::createFromDate($data['birthday']);
        $interval = $ref_date->diffInDays($birthday);
        $acode = $interval % 60;
        if($acode == 0){
          $acode = 60;
        }

        return User::create([
          'uname' => $data['uname'],
          'birthday' => $data['birthday'],
          'acode' => $acode,
          'comment' => $data['comment'],
          'name_shown' => !isset($data['name_hidden']),
          'type_shown' => $data['type_shown'],
          'email' => $data['email'],
          'password' => Hash::make($data['password']),
        ]);
    }
}
