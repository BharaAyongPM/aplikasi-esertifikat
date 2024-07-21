<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateWithPassword
{
    public function handle(Request $request, Closure $next)
    {
        // Gantilah 'your_password' dengan password yang diinginkan
        $correctPassword = 'bisa12345';

        if ($request->input('password') !== $correctPassword) {
            // Tampilkan formulir masukan password jika tidak sesuai
            return response(view('password_form'));
        }

        return $next($request);
    }
}
