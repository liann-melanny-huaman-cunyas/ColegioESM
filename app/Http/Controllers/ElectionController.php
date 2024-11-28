<?php
namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Election;
use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ElectionController extends Controller
{
    public function validateStudent(Request $request)
    {
        // Asegúrate de tener las validaciones
        $validator = Validator::make($request->all(), [
            'dni' => 'required|exists:students,dni'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'DNI no encontrado',
                'errors' => $validator->errors()
            ], 400);
        }

        // Resto del código de validación
        $student = Student::where('dni', $request->dni)->first();

        // Verificaciones adicionales
        $currentElection = Election::where('estado', 'en_proceso')->first();
        
        if (!$currentElection) {
            return response()->json([
                'success' => false,
                'message' => 'No hay elecciones en proceso'
            ], 400);
        }

        $hasVoted = Vote::where('student_id', $student->id)
            ->where('election_id', $currentElection->id)
            ->exists();

        if ($hasVoted) {
            return response()->json([
                'success' => false,
                'message' => 'Ya has votado en esta elección'
            ], 400);
        }

        // Devolver información del estudiante
        return response()->json([
            'success' => true,
            'student' => [
                'id' => $student->id,
                'nombres' => $student->nombres,
                'apellido_paterno' => $student->apellido_paterno,
                'apellido_materno' => $student->apellido_materno,
                'classroom' => $student->classroom->grade . ' ' . $student->classroom->section
            ]
        ]);
    }

    // Otros métodos necesarios
    public function index()
    {
        $currentElection = Election::where('estado', 'en_proceso')->first();

        if (!$currentElection) {
            return view('elections.no-election', [
                'message' => 'No hay elecciones en curso actualmente.'
            ]);
        }

        $candidates = Candidate::where('estado', 'activo')
            ->with('student')
            ->get();

        return view('elections.index', [
            'election' => $currentElection,
            'candidates' => $candidates
        ]);
    }

    public function getCandidates()
    {
        $currentElection = Election::where('estado', 'en_proceso')->first();
    
        if (!$currentElection) {
            return response()->json([
                'success' => false,
                'message' => 'No hay elecciones en proceso'
            ], 400);
        }
    
        $candidates = Candidate::where('estado', 'activo')
            ->with('student')
            ->get()
            ->map(function ($candidate) {
                return [
                    'id' => $candidate->id,
                    'nombre' => $candidate->student->nombres . ' ' . 
                                $candidate->student->apellido_paterno . ' ' . 
                                $candidate->student->apellido_materno,
                    'simbolo' => asset('storage/simbolos/' . basename($candidate->simbolo))
                ];
            });
    
        return response()->json([
            'success' => true,
            'candidates' => $candidates
        ]);
    }

    public function submitVote(Request $request)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|exists:students,id',
            'candidate_id' => 'nullable|exists:candidates,id',
            'is_blank_vote' => 'boolean'
        ]);
    
        $currentElection = Election::where('estado', 'en_proceso')->first();
    
        // Verificar si ya votó
        $existingVote = Vote::where('student_id', $validatedData['student_id'])
            ->where('election_id', $currentElection->id)
            ->exists();
    
        if ($existingVote) {
            return response()->json(['message' => 'Ya has votado en esta elección'], 400);
        }
    
        // Crear voto
        Vote::create([
            'student_id' => $validatedData['student_id'],
            'election_id' => $currentElection->id,
            'candidate_id' => $validatedData['candidate_id'], // This can now be null
            'is_blank_vote' => $validatedData['is_blank_vote']
        ]);
    
        return response()->json(['message' => 'Voto registrado exitosamente']);
    }
}