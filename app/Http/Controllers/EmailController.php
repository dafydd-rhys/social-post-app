<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostNotification;
use Illuminate\Support\Facades\Log;


class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $recipientEmail = $request->input('recipientEmail');
        $title = $request->input('title');
        $content = $request->input('content');

        Log::info("Title: $title, Content: $content, Recipient Email: $recipientEmail");

        Mail::to($recipientEmail)->send(new PostNotification($title, $content));

        return response()->json(['message' => 'Email sent successfully']);
    }
}
