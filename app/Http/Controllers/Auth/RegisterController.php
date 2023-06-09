<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use PragmaRX\Google2FAQRCode\Google2FA;

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

    use RegistersUsers{
        register as registration;
    }

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
        $data['bank_number'] = strtoupper($data['bank_number']);

        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'bank_name' => ['required', 'string','max:255'],
            'bank_number' => ['required', 'string','max:255', 'regex:/^NL\d{2}[A-Z]{4}\d{10}$/'],
            'password' => [
                'required',
                'string',
                'min:15',             // must be at least 15 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&.]/', // must contain a special character
            ],
        ], [
            'max' => 'Dit veld mag maximaal :max characters lang zijn.',
            'password.min' => 'Het wachtwoord moet minimaal :min characters lang zijn.',
            'password.regex' => 'Het wachtwoord moet een hoofdletter, kleine letter, nummer en moet 1 van de volgende tekens bevatten .@$!%*#?&',
            'required' => 'Dit veld is verplicht.',
            'email' => 'Dit veld moet een geldig e-mailadres zijn.',
            'username.unique' => 'Deze gebruikersnaam is al in gebruik.',
            'email.unique' => 'Dit e-mailadres is al in gebruik.',
            'bank_number' => 'Banknummer is ongeldig'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'bank_name' => $data['bank_name'],
            'bank_number' => $data['bank_number'],
            'password' => Hash::make($data['password']),
            'google2fa_secret' => $data['google2fa_secret'],
        ]);
    }
    //2fa register function
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $google2fa = app('pragmarx.google2fa');
        $registration_data = $request->all();
        $registration_data["google2fa_secret"] = $google2fa->generateSecretKey();
        $request->session()->flash('registration_data', $registration_data);

        $QR_Image = $google2fa->getQRCodeInline(
            config('app.name'),
            $registration_data['email'],
            $registration_data['google2fa_secret']
        );

        return view('google2fa.register', ['QR_Image' => $QR_Image, 'secret' => $registration_data['google2fa_secret']]);


    }
        // 2fa complete registration
    public function completeRegistration(Request $request)
    {
        $request->merge(session('registration_data'));
        return $this->registration($request);
    }
}

