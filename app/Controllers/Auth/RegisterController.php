<?php

namespace App\Controllers\Auth;

use App\Models\User;
use App\Controllers\User\Controller;

class RegisterController extends Controller
{
    public function create()
    {
        $data = [
            'messages' => session_get_once('messages'),
            'old' => $this->getSavedFormValues(),
            'errors' => session_get_once('errors')
        ];

        $this->sendPage('auth/register', $data);
    }

    public function store()
    {
        $user_data = $this->filterUserData($_POST);

        $user = new User(PDO());
        $errors = $user->validate($user_data);

        if (empty($errors)) {
            $user->fill($user_data);
            if ($user->save()) {
                $_SESSION['success_Mess'] = 'Bạn đã đăng ký thành công!';
                redirect('/login');
            } else {
                $errors['general'] = 'Đã xảy ra lỗi khi đăng ký. Vui lòng thử lại.';
            }
        }

        $this->saveFormValues($_POST, ['password', 'password_confirmation']);
        redirect('/register', ['errors' => $errors]);
    }

    protected function filterUserData(array $data)
    {
        return [
            'email' => filter_var($data['email'], FILTER_VALIDATE_EMAIL),
            'name' => $data['name'] ?? '',
            'password' => $data['password'] ?? '',
            'password_confirmation' => $data['password_confirmation'] ?? ''
        ];
    }
}
