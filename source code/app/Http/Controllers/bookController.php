<?php

namespace App\Http\Controllers;

use App\Models\buku;
use Illuminate\Http\Request;

class bookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = buku::latest()->paginate(5);
        return view('buku.index', compact('buku'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:10000'
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destination = 'image/';
            $imagename = date('YmdHis') . "-" . $image->getClientOriginalName() . "." . $image->getClientOriginalExtention();
            $image->move($destination, $imagename);
            $input['image'] = "$imagename";
        } 

        buku::create($input);

        return redirect()->route('buku.index')->with('success', 'buku berhasil di tambahkan');
        // else {
        //     unset($input['image']);
        // }

        // return redirect()->route('buku.index')->with('success', 'buku berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(buku $buku)
    {
        return view('buku.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit(buku $buku)
    {
        return view('buku.edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, buku $buku)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:10000'
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destination = 'image/';
            $imagename = date('YmdHis') . "-" . $image->getClientOriginalName() . "." . $image->getClientOriginalExtention();
            $image->move($destination, $imagename);
            $input['image'] = "$imagename";
        } else {
            unset($input['image']);
        }

        $buku->update($input);

        return redirect()->route('buku.index')->with('success', 'buku berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy(buku $buku)
    {
        $buku->delete();
        return redirect()->route('buku.index')->with('success', 'buku berhasil di hapus');
    }
}