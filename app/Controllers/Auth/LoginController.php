<?php

namespace App\Controllers\Auth;

use App\Models\User;
use App\Controllers\User\Controller;

class LoginController extends Controller
{
    public function create()
    {
        if (AUTHGUARD()->isUserLoggedIn()) {
            redirect('/home');
        }

        $data = [
            'messages' => session_get_once('messages'),
            'old' => $this->getSavedFormValues(),
            'errors' => session_get_once('errors')
        ];

        $this->sendPage('auth/login', $data);
    }

    public function store()
    {
        $user_credentials = $this->filterUserCredentials($_POST);

        $errors = [];
        $user = (new User(PDO()))->where('email', $user_credentials['email']);

        if (!$user || !$user->id) {
            $errors['email'] = 'Invalid email or password.';
        } else if (AUTHGUARD()->login($user, $user_credentials)) {
            if ($user->role === 'admin') {
                $_SESSION['success_Mess'] = 'Bạn đã đăng nhập thành công với tư cách Admin!';
                redirect('/admin');
            } else {
                $_SESSION['success_Mess'] = 'Bạn đã đăng nhập thành công';
                redirect('/home');
            }
        } else {
            $errors['password'] = 'Invalid email or password.';
        }

        $this->saveFormValues($_POST, ['password']);
        redirect('/login', ['errors' => $errors]);
    }

    public function destroy()
    {
        AUTHGUARD()->logout();
        redirect('/login');
    }

    protected function filterUserCredentials(array $data)
    {
        return [
            'email' => filter_var($data['email'], FILTER_VALIDATE_EMAIL),
            'password' => $data['password'] ?? null
        ];
    }
}
