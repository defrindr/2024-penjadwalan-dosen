<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $idUser = auth()->user()->id;

        $jumlahDosen = Dosen::count();

        $dtDosen = Dosen::paginate(5);

        return view('dosen')->with('dtDosen', $dtDosen)->with('jumlahDosen', $jumlahDosen)->with('user', $user);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tambahDosen');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Dosen::create([
            'nip' => $request->nip,
            'nama_dosen' => $request->nama_dosen,
            'telp' => $request->telp,
            'alamat' => $request->alamat,
        ]);

        return redirect('dosen');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dosen = Dosen::findorfail($id);

        return view('editDosen', compact('dosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dosen = Dosen::findorfail($id);
        $dosen->update($request->all());

        return redirect('dosen');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dosen = Dosen::findorfail($id);
        $dosen->delete();

        return redirect('dosen');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $dtDosen = Dosen::where('nama_dosen', 'like', '%'.$search.'%')->paginate(10);

        return view('dosen', compact('dtDosen'));
    }
}
