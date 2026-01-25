<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleRedirectController extends Controller
{
    /**
     * Redirect to locale-specific home page based on browser language preference
     */
    public function redirect(Request $request)
    {
        // Deteksi bahasa browser
        $locale = $request->getPreferredLanguage(['id', 'en']);

        // fallback default
        if (!in_array($locale, ['id', 'en'])) {
            $locale = 'id';
        }

        return redirect('/' . $locale);
    }
}
