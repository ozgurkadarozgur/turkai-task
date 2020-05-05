<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Student\StudentResource;
use App\Repositories\Student\IStudentRepository;
use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    private $studentRepository;

    public function __construct(IStudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function index()
    {
        $students = $this->studentRepository->all();
        return response()->json([
            'data' => StudentResource::collection($students)
        ]);
    }

}
