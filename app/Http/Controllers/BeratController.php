<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBeratRequest;
use App\Models\Berat;
use Illuminate\Http\Request;

class BeratController extends Controller
{
    public function index()
    {
        $dataBerat = Berat::orderBy('date', 'DESC')->get();

        return view('berat', [
            'dataBerat' => $dataBerat,
            'type' => 'index',
        ]);
    }

    public function show(Berat $berat)
    {
        return view('berat', [
            'type' => 'detail',
            'dataBerat' => $berat,
        ]);
    }

    public function create()
    {
        return view('form-berat', [
            'type' => 'create',
        ]);
    }

    public function edit(Berat $berat)
    {
        return view('form-berat', [
            'dataBerat' => $berat,
            'type' => 'edit',
        ]);
    }

    public function store(StoreBeratRequest $request)
    {
        $validated = $request->validated();
        try {
            Berat::create($validated);
            return redirect()->route('berat.index');
        } catch (\Throwable $th) {
            return redirect()->back()->with('msg', 'Gagal menambahkan berat');
        }
    }

    public function update(StoreBeratRequest $request, Berat $berat)
    {
        $isUpdated = $berat->update($request->validated());
        if (!$isUpdated) {
            return redirect()->back()->with('msg', "Gagal mengupdate data berat");
        }

        return redirect()->route('berat.index');
    }

    public function destroy(Berat $berat)
    {
        $isDeleted = $berat->delete();
        if (!$isDeleted) {
            return redirect()->back()->with('msg', 'Gagal menghapus data berat');
        }

        return redirect()->route('berat.index');
    }
}
