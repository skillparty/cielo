<?php

namespace App\Http\Controllers;

use App\Models\CompanyContent;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // Obtener contenido de la empresa por secciones
        $heroContent = CompanyContent::where('section_key', 'hero')->first();
        $historyContent = CompanyContent::where('section_key', 'historia')->first();
        $valuesContent = CompanyContent::where('section_key', 'valores')->first();
        $locationContent = CompanyContent::where('section_key', 'ubicacion')->first();
        
        // Obtener galería de imágenes de la empresa
        $galleryImages = CompanyContent::where('section_key', 'LIKE', 'galeria%')
            ->with('media')
            ->get();

        return view('about.index', compact(
            'heroContent',
            'historyContent', 
            'valuesContent',
            'locationContent',
            'galleryImages'
        ));
    }
}