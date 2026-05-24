<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class MailController extends Controller
{
     public function index()
    {
        if(auth()->user()->role_id == 1){
            $customers = User::where('role_id', 4)->get();
        } else {
            $customers = User::where('role_id', auth()->id())->get();
        }

        return view('admin.pages.email.form', compact('customers'));
    }

    // mail send
   public function sendMail(Request $request)
    {
        $request->validate([
            'to' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
            'attachment' => 'nullable|file|max:2048',
        ]);

        $filePath = null;

        if ($request->hasFile('attachment')) {
                $filePath = $request->file('attachment')->store('mail_files', 'public');
            }

        Mail::to($request->to)
            ->send(new SendMail(
                $request->subject,
                $request->message,
                $filePath
            ));

        return back()->with('success', 'Email sent successfully!');
    }
}
