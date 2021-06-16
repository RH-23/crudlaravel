<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Keterangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        //return view('students\index', ['students' => $students]);

        //karena nama variabel dan nama datanya sama bisa menggunakan fungsi php compact
        return view('students\index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Untuk menampilkan form dengan fungsi create
    public function create()
    {
        return view('students/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // Untuk insert data dengan fungsi store
    public function store(Request $request)
    {
        // Cara Validasi
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|size:9',
            'email' => 'required',
            'jurusan' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required'
        ]);

        // cara 1
        // $student = new Student;
        // $student->nama = $request->nama;
        // $student->nim = $request->nim;
        // $student->email = $request->email;
        // $student->jurusan = $request->jurusan;
        // $student->save();

        // cara 2
        // Student::create([
        //     'nama' => $request->nama,
        //     'nim' => $request->nim,
        //     'email' => $request->email,
        //     'jurusan' => $request->jurusan
        // ]);

        // cara 3
        // Student::create($request->all());
        // // Keterangan::create($request->all());

        // Keterangan::create([
        //     'alamat' => $request->alamat
        // ]);

        Student::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurusan' => $request->jurusan
        ]);

        Keterangan::create([
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat
        ]);

        return redirect('/students')->with('status', 'Data mahasiswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('students/show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */

    // Untuk Menampilkan Form dengan fungsi edit
    public function edit(Student $student)
    {
        return view('students/edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    // Untuk Mengubah data dengan fungsi update
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|size:9',
            'email' => 'required',
            'jurusan' => 'required'
        ]);

        Student::where('id', $student->id)
            ->update([
                'nama' => $request->nama,
                'nim' => $request->nim,
                'email' => $request->email,
                'jurusan' => $request->jurusan,
            ]);

        return redirect('/students')->with('status', 'Data mahasiswa berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        Student::destroy($student->id);
        return redirect('/students')->with('status', 'Data mahasiswa berhasil dihapus');
    }
}
