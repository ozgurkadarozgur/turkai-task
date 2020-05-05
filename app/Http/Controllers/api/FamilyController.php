<?php

namespace App\Http\Controllers\api;

use App\Events\NewFamily;
use App\Family;
use App\Http\Controllers\Controller;
use App\Http\Requests\Family\LoginFamilyRequest;
use App\Http\Requests\Family\StoreFamilyRequest;
use App\Http\Requests\Family\UpdateFamilyRequest;
use App\Http\Resources\Family\FamilyResource;
use App\Jobs\NewFamilyJob;
use App\Mail\WelcomeFamilyMail;
use App\Repositories\Family\IFamilyRepository;
use App\Repositories\Student\IStudentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class FamilyController extends Controller
{

    private $familyRepository;
    private $studentRepository;

    /**
     * FamilyController constructor.
     * @param IFamilyRepository $familyRepository
     * @param IStudentRepository $studentRepository
     */
    public function __construct(IFamilyRepository $familyRepository, IStudentRepository $studentRepository)
    {
        $this->familyRepository = $familyRepository;
        $this->studentRepository = $studentRepository;
    }

    public function profile(Request $request)
    {
        return response()->json([
            'data' => new FamilyResource($request->user())
        ]);
    }

    public function login(LoginFamilyRequest $request)
    {
        $validated = $request->validated();
        $user = $this->familyRepository->findByEmail($validated['email']);
        if (Hash::check($validated['password'], $user->password)) {
            $access_token =  $user->createToken($user->email)->accessToken;
            return response()->json([
                'status' => 'success',
                'data' => [
                    'access_token' => $access_token,
                ],
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'errors' => [
                    'password' => [
                        'Invalid password'
                    ]
                ],
            ], Response::HTTP_UNAUTHORIZED);
        }
        /*
        $user = $this->familyRepository->findById(1);
        */
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreFamilyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFamilyRequest $request)
    {
        $validated = $request->validated();
        $student = $this->studentRepository->findByCode($validated['code']);
        $validated['student_id'] = $student->id;
        $family = $this->familyRepository->create($validated);
        NewFamilyJob::dispatch($family);
        return response()->json([
                'data' => new FamilyResource($family)
            ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateFamilyRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFamilyRequest $request)
    {
        $validated = $request->validated();
        $user = $request->user();
        $family = $this->familyRepository->update($user->id, $validated);
        return response()->json([
            'data' => new FamilyResource($family)
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
