<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;

class StudentsController extends Controller
{   
    
    public function __construct(){
        return $this->middleware('auth:sanctum'); 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $body       = $request->all();
        $message    = "";
        $totalData  = 0;
        $statusCode = "";

        if(isset($body['IsActive'])){
            $students   = Students::where('is_active',$body['IsActive'])->get(); 
            $message    = "Data Students Berhasil Ditampilkan";
            $totalData  = $students->count();
            $statusCode = 200;
        }else{
            $students   = Students::all(); 
            $message    = "Data Students Berhasil Ditampilkan";
            $totalData  = $students->count();
            $statusCode = 200;
        }

        return response()->json(
            [
                'Message'    => $message,
                'StatusCode' => $statusCode,
                'TotalData'  => $totalData,
                'Data'       => $students,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $body     = $request->all();
        
        $requestData = $request->validate([
            'nama' => 'required',
            'nim'  => 'numeric|required',
            'email'  => 'email|required',
            'jurusan'  => 'required',
            'umur'  => 'required',
            // 'is_active' => ,
        ]);

        $requestData['is_active'] = 1;

        // $input    = [
        //     "nama"      => $body['nama'],
        //     "nim"       => $body['nim'],
        //     "email"     => $body['email'],
        //     "jurusan"   => $body['jurusan'],
        //     "umur"      => $body['umur'],
        //     "is_active" => 1,
        // ];

        $students   = Students::create($requestData);
        $message    = "Data Students Berhasil Ditambahkan";
        $statusCode = 201;

        return response()->json(
            [
                'Message'    => $message,
                'StatusCode' => $statusCode,
                'Data'       => $students,
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $students   = Students::find($id); 
        if($students === null){
            $statusCode = 404;
            $data_students = [
                'StatusCode' => 404,
                'Data'       => [
                    'Message' => 'Data Not Found'
                ],
            ];
        }else{
            $students   = Students::where('id',$id)->get(); 
            $statusCode = 200;
            $data_students = [
                'Message'    => 'Data Students Berhasil di tampilkan',
                'StatusCode' => $statusCode,
                'Data'       => $students,
            ];
        }

        return response()->json($data_students);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $students           = Students::find($id);

        if($students !== null){
            $input    = [
                "nama"      => $body['nama'] ?? $students->nama,
                "nim"       => $body['nim'] ?? $students->nim,
                "email"     => $body['email'] ?? $students->email,
                "jurusan"   => $body['jurusan'] ?? $students->jurusan,
                "umur"      => $body['umur'] ?? $students->umur,
            ];
            $students->update($input);
            $message            = "Data Students Berhasil Di Update";
            $statusCode         = 200;
            $data_students = [
                'Message'    => $message,
                'StatusCode' => $statusCode,
                'Data'       => $students,
            ];
            return response()->json($data_students);
        }else{
            return response()->json(
                [
                    'StatusCode' => 404,
                    'Data'       => [
                        'Message' => 'Data Not Found'
                    ],
                    ]
            );
        }

    }

    public function delete($id)
    {
        $message    = "Data Students Berhasil delete";
        $statusCode = "";

        $students   = Students::find($id);
        if($students === null){
            $statusCode = 404;
            $data_students = [
                'StatusCode' => $statusCode,
                'Data'       => [
                    'Message' => 'Data Not Found'
                ],
            ];
        }else{
            $students   = Students::where('id',$id)->delete(); 
            $statusCode = 200;
            $data_students = [
                'Message'    => $message,
                'StatusCode' => $statusCode,
                'Data'       => $students,
            ];
        }

        return response()->json($data_students);
    }
}