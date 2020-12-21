<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CircularRequest;
use App\Models\Circular;
use App\Traits\FileTrait;
use Illuminate\Http\Request;

class CircularController extends Controller
{
    use FileTrait;

    /**
     * @var Circular
     */
    private $circular;

    public function __construct(Circular $circular)
    {
        $this->circular = $circular;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $circulars = $this->circular->latest('created_at')->get();

        return view('admin.circulars.index', [
            'circulars' => $circulars
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.circulars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CircularRequest $request)
    {
        $data = $request->validated();

        preg_match_all('/(data:image\/[^;]+;base64[^"]+)/', $data['text'], $imagens);

        $paths = array();
        foreach ($imagens[0] as $imagen) {
            $path['archive'] = $this->base64File($imagen,'circular');
            $path['display'] = 0;
            $paths[] = $path;
        }

        $data['text'] = str_replace($imagens[0], array_column($paths, 'archive'), $data['text']);

        $this->circular->create($data);

        $toastr = array(
            [
                'type' => 'success',
                'message' => 'Circular cadastrada com sucesso!'
            ]
        );

        return redirect()->route('admin.circulars.index')->with('toastr', $toastr);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Circular $circular)
    {
        $circular->load(['recipients']);

        return view('admin.circulars.show', [
            'circular' => $circular
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Circular $circular)
    {
        return view('admin.circulars.edit', [
            'circular' => $circular
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CircularRequest $request, Circular $circular)
    {
        $data = $request->validated();
        $circular->update($data);

        $toastr = array(
            [
                'type' => 'info',
                'message' => 'Circular alterada com sucesso!'
            ]
        );

        return redirect()->route('admin.circulars.show', [
            'circular' => $circular
        ])->with('toastr', $toastr);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Circular $circular)
    {
        preg_match_all('/(?<=src=")([^"]+)/', $circular->text, $images);

        foreach ($images[0] as $image)
        {
            $this->removeFile($image, 'circular');
        }

        $circular->delete();

        $toastr = array(
            [
                'type' => 'info',
                'message' => 'Circular apagada com sucesso!'
            ]
        );

        return redirect()->route('admin.circulars.index')->with('toastr', $toastr);
    }
}
