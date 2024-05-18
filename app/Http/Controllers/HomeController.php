<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->role === "user") {
            $listTugas = Kegiatan::groupBy('tugas')->select('tugas', DB::raw('count(id) as total'))->where('nip', $user->dosen->nip)->orderBy('tugas');

            if ($request->get('date') && $request->get('filter')) {
                $date = $request->get('date');
                $filter = $request->get('filter');

                switch ($filter) {
                    case 1:
                        $tglAwal = date("Y-m-d", strtotime($date . " -1 month"));
                        break;
                    case 2:
                        $tglAwal = date("Y-m-d", strtotime($date . " -6 month"));
                        break;
                    case 3:
                        $tglAwal = date("Y-m-d", strtotime($date . " -1 year"));
                        break;
                    default:
                        $tglAwal = date("Y-m-d", strtotime($date . " -1 month"));
                        break;
                }

                $listTugas->whereBetween('tanggal', [$tglAwal, $date]);
            }

            $listTugas = $listTugas->get();
            $listTugasPerdosen = ['labels' => [], 'nilai' => []];
            foreach ($listTugas as $item) {
                $listTugasPerdosen['nilai'][] = $item['total'];
                $listTugasPerdosen['labels'][] = $item['tugas'];
            }
            return view('home', [
                'listNilai' => $listTugasPerdosen['nilai'],
                'listDosen' => $listTugasPerdosen['labels'],
            ]);
        }

        $listTugas = Kegiatan::groupBy('nip')->select('nip', DB::raw('count(id) as total'))->orderBy('nip');

        if ($request->get('date') && $request->get('filter')) {
            $date = $request->get('date');
            $filter = $request->get('filter');

            switch ($filter) {
                case 1:
                    $tglAwal = date("Y-m-d", strtotime($date . " -1 month"));
                    break;
                case 2:
                    $tglAwal = date("Y-m-d", strtotime($date . " -6 month"));
                    break;
                case 3:
                    $tglAwal = date("Y-m-d", strtotime($date . " -1 year"));
                    break;
                default:
                    $tglAwal = date("Y-m-d", strtotime($date . " -1 month"));
                    break;
            }

            $listTugas->whereBetween('tanggal', [$tglAwal, $date]);
        }

        $listTugas = $listTugas->get()->toArray();

        $listTugasArr = [];
        foreach ($listTugas as $tugas) {
            $listTugasArr[$tugas['nip']] = $tugas['total'];
        }

        $listDosen = Dosen::all();
        $listTugasPerdosen = ['labels' => [], 'nilai' => []];
        foreach ($listDosen as $dosen) {
            $listTugasPerdosen['labels'][] = $dosen->nama_dosen;
        }

        foreach ($listDosen as $dosen) {
            if (isset($listTugasArr[$dosen->nip]))
                $listTugasPerdosen['nilai'][] = $listTugasArr[$dosen->nip];
            else $listTugasPerdosen['nilai'][] = 0;
        }

        return view('home', [
            'listNilai' => $listTugasPerdosen['nilai'],
            'listDosen' => $listTugasPerdosen['labels'],
        ]);
    }
}
