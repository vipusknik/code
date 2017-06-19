<?php

namespace App\Http\Controllers\Specialties;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Specialty\Specialty;
use App\Models\Profession\Profession;

class SpecialtyProfessionsController extends Controller
{
    public function index(Specialty $specialty)
    {
        $professions = $specialty->professions()
            ->orderBy('title')
            ->get();

        return view('specialties.professions.index', compact('specialty', 'professions'));
    }

    public function create(Specialty $specialty)
    {
        $professions = Profession::orderBy('title')->get();

        return view('specialties.professions.create', compact('specialty', 'professions'));
    }

    public function store(Specialty $specialty, Request $request)
    {
        $specialty->professions()->syncWithoutDetaching($request->professions);

        return redirect()
            ->route('specialties.professions.index', $specialty)
            ->with('message', 'Профессии прикреплены');
    }

    public function destroy(Specialty $specialty, Profession $profession)
    {
        $specialty->professions()
            ->wherePivot('profession_id', $profession->id)
            ->detach();

        return redirect()
            ->route('specialties.professions.index', $specialty)
            ->with('message', 'Профессия откреплена');
    }
}
