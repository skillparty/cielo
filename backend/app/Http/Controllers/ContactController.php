<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Faq;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        // Obtener FAQs por categoría
        $faqs = Faq::where('is_published', true)
            ->orderBy('category')
            ->orderBy('display_order')
            ->get()
            ->groupBy('category');

        return view('contact.index', compact('faqs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ], [
            'name.required' => 'El nombre completo es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe tener un formato válido.',
            'phone.required' => 'El teléfono es obligatorio.',
            'subject.required' => 'El asunto es obligatorio.',
            'message.required' => 'El mensaje es obligatorio.',
            'message.max' => 'El mensaje no puede exceder 2000 caracteres.',
        ]);

        ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'pending',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', '¡Mensaje enviado exitosamente! Te contactaremos pronto.');
    }
}