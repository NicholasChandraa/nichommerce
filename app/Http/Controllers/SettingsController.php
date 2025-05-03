<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Feedback;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

    public function changePasswordForm()
    {
        return view('settings.change-password');
    }

    public function feedbackForm()
    {
        return view('settings.feedback');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak cocok']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password berhasil diubah');
    }

    public function sendFeedback(Request $request)
    {
        $request->validate([
            'feedback' => 'required|string|max:1000',
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'feedback' => $request->feedback,
        ]);

        return back()->with('success', 'Terkirim, terima kasih atas feedback Anda');
    }
}
