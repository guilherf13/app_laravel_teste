<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(Request $request) 
    {
         // Validação dos dados do formulário de registro
         $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ], [
            'email.required' => 'O campo email é obrigatório.',
            'email.string' => 'O campo email deve ser uma string.',
            'email.email' => 'O campo email deve ser um endereço de email válido.',
            'email.max' => 'O campo email não pode ter mais de :max caracteres.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.string' => 'O campo senha deve ser uma string.'
        ]);

        if ($validator->fails()) {
            return $this->returnJsonFormat(['errors' => $validator->errors()], 404);
        }

        $request_array = $request->all();

        $user = User::where('email', $request_array['email'])->first();

        //Verifica se o email e senha estão na base de dados
        if(!$user || !Hash::check($request_array['password'], $user->password)){
            return response()->json('Email ou senha Incorreto', 404);
        }

        $data = [
            'mensage' => 'Login efetuado com sucesso',
            'name' => $user->name,
            'email' => $user->email
        ];
        
        return $this->returnJsonFormat($data, 200);
    }

    public function sendEmailValidate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|exists:users,email',
        ], [
            'email.required' => 'O campo email é obrigatório.',
            'email.string' => 'O campo email deve ser uma string.',
            'email.email' => 'O campo email deve ser um endereço de email válido.',
            'email.max' => 'O campo email não pode ter mais de :max caracteres.',
            'email.exists' => 'O email fornecido não está registrado.',
        ]);

        if ($validator->fails()) {
            return $this->returnJsonFormat(['errors' => $validator->errors()], 422);
        }

    
        $user = User::where('email', $request->input('email'))->first();
    
        if (!$user) {
            return response()->json(['message' => 'E-mail não encontrado'], 404);
        }
    
        // Gerar um token de redefinição de senha
        $token = Str::random(60);
        $user->update([
            'reset_token' => $token
        ]);
    
        // Enviar o e-mail com o link para redefinir a senha
        Mail::to($user->email)->send(new PasswordResetMail($user, $token));

        $data = ['message' => 'E-mail de redefinição de senha enviado com sucesso'];
        
        return $this->returnJsonFormat($data, 200);
    }

    public function updatePassword(Request $request)
    {
        $dados = $request->all();

        DB::beginTransaction();
        try {    
            $user = User::find($dados['user_id']);

            $user->update([
                'password' => $dados['password']
            ]);

            DB::commit();

            $dado = ['message' => 'Senha redefinida com sucesso'];
            
            return json_encode($dado, JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Error when registering a user'], 500);
        }

    }

    public function formResetPassword(Request $request)
    {
        $userid = $request->all();
        return view('reset-password', ['id' => $userid['user_id']]);  
    }

    public function register(Request $request)
    {
        // Validação dos dados do formulário de registro
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome não pode ter mais de :max caracteres.',
            'email.required' => 'O campo email é obrigatório.',
            'email.string' => 'O campo email deve ser uma string.',
            'email.email' => 'O campo email deve ser um endereço de email válido.',
            'email.max' => 'O campo email não pode ter mais de :max caracteres.',
            'email.unique' => 'Este endereço de email já está sendo utilizado.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.string' => 'O campo senha deve ser uma string.',
            'password.min' => 'O campo senha deve ter no mínimo :min caracteres.',
        ]);

        if ($validator->fails()) {
            return $this->returnJsonFormat(['errors' => $validator->errors()], 422);
        }

        // Criação de um novo usuário
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);

            if($user){
                // Gere um token de acesso para o novo usuário
                $user->createToken('authToken')->plainTextToken;
                DB::commit();
                $data = ['Usuario registrado com sucesso!'];
                return $this->returnJsonFormat($data, 200);
            }
            
        } catch (\Exception $e) {
            DB::rollback();
            $data = ['messagem' => 'Error ao registrar o usuario', 'error' => $e->getMessage()];
            return $this->returnJsonFormat($data, 500);
        }
    }

    public function deleteUser($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|exists:users,id',
        ], [
            'email.required' => 'O campo id é obrigatório.',
            'email.exists' => 'O usuario fornecido não está registrado ou foi excluido.',
        ]);

        if ($validator->fails()) {
            return $this->returnJsonFormat(['errors' => $validator->errors()], 422);
        }

        $user = User::find($id);
        $user->delete();

        $data = ['messagem' => 'Usuario excluido com sucesso'];
        
        return $this->returnJsonFormat($data, 200);
    }

}
