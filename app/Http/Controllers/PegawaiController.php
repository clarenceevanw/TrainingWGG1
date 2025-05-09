<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\LevelAkses;
use App\Models\Division;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     protected $pegawai;

     public function __construct(Pegawai $pegawai)
     {
        $this->pegawai = $pegawai;
     }

    public function index()
    {
        $pegawai = Pegawai::with(['levelAkses', 'division'])->get();
        return view('pegawai.index', [
            'title' => 'Data Pegawai',
            'pegawais' => $pegawai
        ]);
    }

    public function info()
    {
        $pegawai = Pegawai::with(['levelAkses', 'division'])->find(session('pegawai_id'));
        if (!$pegawai) {
            return redirect()->route('login')->with('error', 'Pegawai tidak ditemukan');
        }

        return view('pegawai.info', [
            'title' => 'Info Pegawai',
            'pegawai' => $pegawai
        ]);
    }

    public function dashboard()
    {
        $totalPegawai = Pegawai::count();

        $topDivision = Pegawai::select('division_id')
            ->with('division')
            ->get()
            ->groupBy('division_id')
            ->sortByDesc(fn($group) => count($group))
            ->first();

        $topDivisionName = $topDivision[0]->division->name ?? '-';
        $topDivisionCount = count($topDivision);

        $topLevel = Pegawai::select('level_akses_id')
            ->with('levelAkses')
            ->get()
            ->groupBy('level_akses_id')
            ->sortByDesc(fn($group) => count($group))
            ->first();

        $topLevelName = $topLevel[0]->levelAkses->name ?? '-';
        $topLevelCount = count($topLevel);

        $recentPegawai = Pegawai::latest()->take(5)->get();

        $title = 'Dashboard';

        return view('pegawai.dashboard', compact(
            'title',
            'totalPegawai',
            'topDivisionName',
            'topDivisionCount',
            'topLevelName',
            'topLevelCount',
            'recentPegawai'
        ));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        session()->forget('error');
        $l = LevelAkses::all();
        $division = Division::all();
        return view('pegawai.create', [
            'title' => 'Tambah Pegawai',
            'level_akses' => $l,
            'division' => $division,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validationRules = $this->pegawai->validationRules();
        $validationMessages = $this->pegawai->validationMessages();

        $val = Validator::make($request->all(), $validationRules, $validationMessages);
        if ($val->fails()) {
            return redirect()->back()->withErrors($val)->withInput();
        }

        // Simpan hanya data yang dibutuhkan
        $data = $request->only($this->pegawai->getFillable()); // sesuaikan field-nya
        Pegawai::create($data);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan');

    }


    /**
     * Display the specified resource.
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pegawai = $this->pegawai->find($id);
        $level_akses = LevelAkses::all();
        $division = Division::all();
        return view('pegawai.edit', [
            'title' => 'Edit Pegawai',
            'pegawai' => $pegawai,
            'level_akses' => $level_akses,
            'division' => $division,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pegawai = $this->pegawai->find($id);
        $validationRules = $this->pegawai->validationEditRules($pegawai->id);
        $validationMessages = $this->pegawai->validationMessages();
        $val = Validator::make($request->all(), $validationRules, $validationMessages);
        if ($val->fails()) {
            return redirect()->back()->withErrors($val)->withInput();
        }
        
        $data = $request->only($this->pegawai->getFillable());
        $pegawai->update($data);
        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai, $id)
    {
        $pegawaiDelete = $pegawai->find($id);
        $pegawaiDelete->delete();
        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil dihapus');
    }

    public function infoLevel()
    {
        $levels = LevelAkses::with('pegawais')->get(); 
        return view('pegawai.level', 
            ['levels' => $levels,
            'title' => 'Info Level Akses',
        ]);
    }

    public function createAkses()
    {
        return view('pegawai.createAkses', [
            'title' => 'Tambah Level Akses',
        ]);
    }

    public function storeAkses(Request $request)
    {
        $validationRules = [
            'name' => 'required|string|max:255',
        ];
        $validationMessages = [
            'name.required' => 'Nama level akses harus diisi.',
            'name.string' => 'Nama level akses harus berupa string.',
            'name.max' => 'Nama level akses tidak boleh lebih dari 255 karakter.',
        ];

        if(LevelAkses::where('name', $request->name)->exists()) {
            return response()->json(['error' => 'Level akses sudah ada.'], 422);
        }

        $val = Validator::make($request->all(), $validationRules, $validationMessages);
        
        if ($val->fails()) {
            return response()->json(['error' => $val->errors()->first()], 422);
        }
        LevelAkses::create($request->only('name'));
        return response()->json(['success' => 'Level akses berhasil ditambahkan.']);
    }

    public function akses(){
        return view('pegawai.editAkses', [
            'title' => 'Level Akses Pegawai',
            'pegawais' => $this->pegawai->with(['levelAkses', 'division'])->get(),
            'level_akses' => LevelAkses::all(),
        ]);
    }

    public function getLevelAkses($id)
    {
        $pegawai = Pegawai::find($id);
        if (!$pegawai) {
            return response()->json(['error' => 'Pegawai tidak ditemukan'], 404);
        }

        return response()->json([
            'level_akses_id' => $pegawai->level_akses_id
        ]);
    }


    public function updateAkses(Request $request)
    {
        $pegawai = $this->pegawai->find($request->name);
        if (!$pegawai) {
            return redirect()->back()->with('error', 'Pegawai tidak ditemukan');
        }
        $validationRules = [
            'level_akses_id' => 'required|exists:level_akses,id',
        ];
        $validationMessages = [
            'level_akses_id.required' => 'Level akses pegawai harus dipilih.',
            'level_akses_id.exists' => 'Level akses tidak valid.',
        ];
        $val = Validator::make($request->all(), $validationRules, $validationMessages);
        if ($val->fails()) {
            return response()->json(['error' => $val->errors()->all()], 422);
        }
        $data = $request->only('level_akses_id');
        $pegawai->update($data);
        return response()->json(['success' => 'Level akses pegawai berhasil diubah.']);
    }
}
