<?php

namespace App\Http\Controllers;

use App\Models\MateriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MateriController extends Controller
{
    public function index()
    {
        $materis = MateriModel::all();
        return view('materi', compact('materis'));
    }

    public function store(Request $request){
        $request->validate([
            'kategori' => 'required',
            'judul' => 'required',
            'mentor' => 'required',
            'youtube' => 'required',
            'ringkasan' => 'required',
        ]);

        $extensi = $request->file('ringkasan')->extension();
        $filename = Str::random(15) . '.' . $extensi;
        try {
            Storage::putFileAs('public/data', $request->file('ringkasan'), $filename);


            $model = MateriModel::create([
                'kategori' => $request->kategori,
                'judul' => $request->judul,
                'slug' => Str::slug($request->judul),
                'mentor' => $request->mentor,
                'youtube' => $request->youtube,
                'ringkasan' => $filename,
            ]);
            $model->save();
               return redirect()->back()->with(session()->flash('status', 'Data Berhasil DItambahkan'));
        } catch (\Throwable $th) {
            //throw $th;
             return redirect()->back()->with(session()->flash('danger', 'Internal Server Error'));
        }
      
     
    }
    public function hapus($slug)
    {
        $data = MateriModel::where('slug', $slug)->first();
        Storage::delete($data['ringkasan']);
        $data->delete();
        return redirect()->back();
    }

    public function edit($slug)
    {
        $edit = MateriModel::where('slug', $slug)->first();
        return view('editmateri', compact('edit'));
    }

    public function update(Request $request)
    {
        $data = [
            'kategori' => 'required',
            'judul' => 'required',
            'mentor' => 'required',
            'youtube' => 'required',
        ];
        if ($request->file('ringkasan')) {
            $data['ringkasan'] = 'required';
        }
        $request->validate($data);

        $targetItem = MateriModel::where('id', $request->id)->first(); //memilih data yang akan diupdate
        if ($request->file('ringkasan')) {
            Storage::delete($targetItem->ringkasan); //hapus data lama
            $extensi = $request->file('ringkasan')->extension();
            $imgname = Str::random(15) . '.' . $extensi;
            $file = Storage::putFileAs('public/data', $request->file('ringkasan'), $imgname); //tambah file baru

            $update['ringkasan'] = $file;
        }
        $update['kategori'] = $request->get('kategori');
        $update['judul'] = $request->get('judul');
        $update['mentor'] = $request->get('mentor');
        $update['youtube'] = $request->get('youtube');

        MateriModel::where('id', $request->id)->update($update);
        return redirect('/materi');
    }
}
