<?php

namespace App\Http\Controllers\Panitia;

use App\Expo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DataExpo extends Controller
{
    public function index()
    {
        return view('panitia/page/expo');
    }

    public function dataAll()
    {
        $data = Expo::all();

        $response = [];
        $response['data'] = $data->map(function($g) {
            return [
                'id' => $g->id,
                'nama_universitas' => $g->nama,
                'edited_by' => $g->edited_by,
                'updated_at' =>  $g->updated_at->format('l jS \\of F Y h:i:s A'),
            ];
        });

        return response()->json($response);
    }

    public function create()
    {
        return view('panitia/page/expo_create');
    }

    public function createProcess(Request $request)
    {
        $data = Expo::create([
           'nama' =>  $request->input('universitas'),
            'content' => $request->input('content'),
            'utara' => $request->input('utara'),
            'selatan' => $request->input('selatan'),
            'edited_by' => auth('panitia')->user()->fullname
        ]);

        return redirect()
            ->route('panitia_data_expo')
            ->with([
                'status' => 'success',
                'message' => 'berhasil menambah universitas'
            ]);
    }

    public function edit($id)
    {
        $data = Expo::find($id);

        if($data == null){
            return redirect()
                ->route('panitia_data_expo');
        }

        return view('panitia/page/expo_edit', compact('data'));
    }

    public function editProcess(Request $request, $id)
    {
        $data = Expo::find($id);

        if($data == null){
            return redirect()
                ->route('panitia_data_expo');
        }

        $data->update([
            'nama' =>  $request->input('universitas'),
            'content' => $request->input('content'),
            'utara' => $request->input('utara'),
            'selatan' => $request->input('selatan'),
            'edited_by' => auth('panitia')->user()->fullname
        ]);

        return redirect()
            ->route('panitia_data_expo')
            ->with([
                'status' => 'success',
                'message' => 'berhasil memperbarui data universitas'
            ]);
    }

    public function delete()
    {

    }
}
