<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\Dosen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class KegiatanDosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
     {
         $user = Auth::user();
         $idUser = auth()->user()->id;
     
         // Mengambil data kegiatan dengan paginasi
         $dtKegiatan = Kegiatan::paginate(5);
         
         // Memastikan bahwa $dtKegiatan adalah objek LengthAwarePaginator
         if (!($dtKegiatan instanceof \Illuminate\Pagination\LengthAwarePaginator)) {
             // Jika bukan objek LengthAwarePaginator, tampilkan pesan error
             return redirect()->back()->with('error', 'Failed to fetch data.');
         }
         
         // Mengambil semua data dosen
         $dosen = Dosen::all();
         
         // Mengirim data ke view 'kegiatanDosen'
         return view('kegiatanDosen', compact('dtKegiatan', 'dosen', 'user'));
     }
     

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dosen = Dosen::all();
        return view('tambahKegiatan', compact('dosen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Memeriksa apakah file telah diunggah
    if ($request->hasFile('surat_tugas')) {
        // Mendapatkan file yang diunggah
        $file = $request->file('surat_tugas');
        $namaFile = $file->getClientOriginalName();

        // Memindahkan file ke folder yang ditentukan
        $file->move(public_path().'/pdf', $namaFile);
    } else {
        // Tidak ada file yang diunggah, set "surat_tugas" menjadi null
        $namaFile = null;
    }

    // Membuat instance dari model Kegiatan
    $dtKegiatan = new Kegiatan;
    $dtKegiatan->NIP = $request->NIP;
    $dtKegiatan->tugas = $request->tugas;
    $dtKegiatan->nama_kegiatan = $request->nama_kegiatan;
    $dtKegiatan->tanggal = $request->tanggal;
    $dtKegiatan->waktu_mulai = $request->waktu_mulai;
    $dtKegiatan->waktu_selesai = $request->waktu_selesai;
    $dtKegiatan->surat_tugas = $namaFile; // Tetapkan nama file atau null

    // Menyimpan model Kegiatan
    $dtKegiatan->save();
    
    return redirect('kegiatanDosen');
}

    // Buat kegiatan baru dengan data yang diterima dari form

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $kegiatan = Kegiatan::findOrFail($id);
        // return view('detailKegiatan', compact('kegiatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $dosen = Dosen::all();
        return view('editKegiatan', compact('kegiatan', 'dosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $ubah = Kegiatan::findOrFail($id);
    $awal = $ubah->surat_tugas;

    // Menyimpan perubahan lainnya
    $dt = [
        'NIP' => $request['NIP'],
        'tugas' => $request['tugas'],
        'nama_kegiatan' => $request['nama_kegiatan'],
        'tanggal' => $request['tanggal'],
        'waktu_mulai' => $request['waktu_mulai'],
        'waktu_selesai' => $request['waktu_selesai'],
        'surat_tugas' => $request['surat_tugas'], // Ini mungkin perlu disesuaikan
    ];

    // Memeriksa apakah ada file yang diunggah
    if ($request->hasFile('surat_tugas')) {
        // Mendapatkan file yang diunggah
        $file = $request->file('surat_tugas');

        // Membuat nama unik untuk file yang akan disimpan
        $namaFile = uniqid() . '_' . $file->getClientOriginalName();

        // Memindahkan file ke direktori yang ditentukan
        $file->move(public_path().'/pdf', $namaFile);

        // Menghapus file lama jika ada dan menggantikan dengan yang baru
        if (!empty($awal)) {
            // Hapus file lama
            if (file_exists(public_path('pdf/' . $awal))) {
                unlink(public_path('pdf/' . $awal));
            }
        }

        // Memperbarui nama file di model Kegiatan
        $dt['surat_tugas'] = $namaFile;
    }

    $ubah->update($dt);
    return redirect('kegiatanDosen');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->delete();
        return redirect('kegiatanDosen');
    }

    public function search(Request $request)
{   
    $search = $request->get('search');
    $date = $request->get('date');

    // Query pencarian data dosen berdasarkan nama
    $dtDosen = Dosen::where('nama_dosen', 'like', '%' . $search . '%')->get();

    // Mengambil NIP dari hasil pencarian dosen
    $nipDosen = $dtDosen->pluck('NIP')->toArray();

    // Query pencarian kegiatan berdasarkan NIP dosen dan tanggal
    $dtKegiatan = Kegiatan::query()
        ->whereIn('NIP', $nipDosen) // Menambahkan kriteria NIP yang sesuai dengan hasil pencarian nama dosen
        ->whereDate('tanggal', $date)
        ->paginate(5);

    return view('kegiatanDosen', compact('dtKegiatan', 'dtDosen'));
}


    

}
