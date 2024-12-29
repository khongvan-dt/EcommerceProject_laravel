<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FotgetPasswordController extends Controller
{
    public function fotgetPassword()
    {
        return view('auth.fotgotPassword');
    }

    public function checkFotgotPassword(Request $request)
    {
         $validatedData = $request->validate([
            'email' => 'required|email',
        ]);

         $user = User::where('email', $validatedData['email'])->first();

        if (!$user) {
            return back()->with('error', 'Email không tồn tại trong hệ thống.');
        }

         $newPassword = Str::random(9);  

         $user->update([
            'password' => Hash::make($newPassword)
        ]);

         $emailContent = "Xin chào {$user->name},\n\n"
                     . "Mật khẩu mới của bạn là: {$newPassword}\n\n"
                     . "Vui lòng đăng nhập và đổi mật khẩu mới để bảo mật tài khoản.\n\n"
                     . "Trân trọng.";

            Mail::raw($emailContent, function($message) use ($user) {
            $message->from('khongvandt14082004@gmail.com', 'MenFashion')  
                    ->to($user->email)
                    ->subject('Khôi phục mật khẩu');
        });

        return redirect()->route('login')
                        ->with('successForgot', 'Mật khẩu mới đã được gửi vào email của bạn. Vui lòng kiểm tra email.');
    }
}