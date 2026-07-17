<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateController extends Controller
{
    public function translate(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
            'target_lang' => 'required|in:en,ar'
        ]);

        try {
            // Inisialisasi library: terjemahkan dari 'id' ke bahasa tujuan
            $tr = new GoogleTranslate($request->target_lang, 'id');
            
            // Proses terjemahan (Library ini otomatis menangani teks panjang & HTML)
            $translatedText = $tr->translate($request->text);

            return response()->json(['success' => true, 'translation' => $translatedText]);
            
        } catch (\Exception $e) {
            // Jika IP server diblokir karena terlalu banyak request (sangat jarang terjadi di penggunaan normal)
            return response()->json(['success' => false, 'message' => 'Gagal menerjemahkan: ' . $e->getMessage()], 500);
        }
    }
}