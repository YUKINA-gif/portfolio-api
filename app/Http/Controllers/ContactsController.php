<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactsController extends Controller
{
    public function sendMail(Request $request)
    {
        $request->validate([
            "name" => ["required", "string"],
            "email" => ["required","email"],
            "text" => ["required", "string"]
        ]);
        $name = $request->name;
        $email = $request->email;
        $text = $request->text;

        Mail::to("yukina-nakanishi@outlook.jp")->send(new ContactMail($name, $email, $text));
    }
}
