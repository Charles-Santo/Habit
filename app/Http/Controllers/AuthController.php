<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        $request->validate(
            [
                'text_email' => 'required|min:3',
                'text_password' => 'required|min:6',
            ],
            [
                'text_email.required' => 'O campo e-mail é obrigatório.',
                'text_email.email' => 'O campo de e-mail deve conter um endereço válido.',
                'text_email.min' => 'O campo e-mail deve ter no mínimo 3 caracteres',
                'text_password.required' => 'A senha é obrigatória.',
                'text_password.min' => 'a senha deve ter no mínimo 6 caracteres',
            ]
        );

        $email = $request->input('text_email');
        $password = $request->input('text_password');

        $user = User::where('email', $email)
            ->whereNull('deleted_at')
            ->first();

        if (!$user) {
            return redirect()->back()
                ->withInput()
                ->with('login_error', 'E-mail ou senha incorretos!');
        } else {
            if (!password_verify($password, $user->password)) {
                return redirect()->back()
                    ->withInput()
                    ->with('login_error', 'E-mail ou senha incorretos!');
            }
        }

        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        session([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email'=> $user->email,
                'is_anunciante' => $user->is_anunciante,
                'is_admin' => $user->is_admin
            ]
        ]);

        return redirect('/');
    }

    public function register()
    {
        return view('register');
    }

    public function registerSubmit(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|min:3|max:255',
                'email' => 'required|email|unique:users,email|max:255',
                'password' => 'required|min:6|confirmed',
                'is_anunciante' => 'nullable',
                'nome_corretora' => 'required_if:is_anunciante,1|nullable|string|max:255',
                'cnpj_corretora' => 'required_if:is_anunciante,1|nullable|string|max:18',
            ],
            [
                'name.required' => 'O nome é obrigatório.',
                'name.min' => 'O nome deve ter no mínimo 3 caracteres.',
                'email.required' => 'O e-mail é obrigatório.',
                'email.email' => 'Digite um e-mail válido.',
                'email.unique' => 'Este e-mail já está em uso por outro usuário.',
                'password.required' => 'A senha é obrigatória.',
                'password.min' => 'A senha deve ter no mínimo 6 caracteres.',
                'password.confirmed' => 'As senhas não coincidem.',
                'nome_corretora.required_if' => 'O nome da corretora é obrigatório para anunciantes.',
                'cnpj_corretora.required_if' => 'O CNPJ da corretora é obrigatório para anunciantes.',
            ]
        );

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = password_hash($request->input('password'), PASSWORD_DEFAULT);

        $isAnunciante = $request->has('is_anunciante') ? true : false;
        $user->is_anunciante = $isAnunciante;

        if ($isAnunciante) {
            $user->nome_corretora = $request->input('nome_corretora');
            $user->cnpj_corretora = $request->input('cnpj_corretora');
        }

        $user->save();

        return redirect()->route('login')->with('success', 'Cadastro realizado com sucesso! Faça seu login.');
    }

    public function logout()
    {
        session()->forget('user');

        return redirect()->route('login');
    }
}
