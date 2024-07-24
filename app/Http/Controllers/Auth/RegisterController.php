<?php

namespace App\Http\Controllers\Auth;

use App\Enums\JabatanState;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo()
    {
        switch (auth()->user()->role) {
            case 'user':
                $redirectTo = "/";
                break;
            default:
                $redirectTo = "/admin";
                break;
        }

        return $redirectTo;
    }

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
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nama' => ['required', 'string', 'max:255'],
            'NIP' => ['required', 'max:255'],
            'jabatan' => ['required', Rule::enum(JabatanState::class)],
        ], [
            "email.required" => "Email mohon diisi!",
            "email.email" => "Email tidak valid!",
            "email.max" => "Email tidak valid!",
            "email.unique" => "Email sudah digunakan!",

            "password.required" => "Password mohon diisi!",
            "password.min" => "Password minimal 8 karakter!",
            "password.confirmed" => "Password tidak cocok dengan password konfirmasi!",

            "nama.required" => "Nama lengkap mohon diisi!",
            "nama.max" => "Nama lengkap terlalu panjang!",

            "NIP.required" => "NIP mohon diisi!",
            "NIP.max" => "NIP terlalu panjang!",

            "jabatan.required" => "Jabatan mohon diisi!",
            "jabatan.Illuminate\Validation\Enum" => "Jabatan tidak valid!",
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
            'nama' => $data['nama'],
            'email' => $data['email'],
            'NIP' => $data['NIP'],
            'jabatan' => $data['jabatan'],
            'role' => "user",
            'password' => Hash::make($data['password']),
        ]);
    }
}
