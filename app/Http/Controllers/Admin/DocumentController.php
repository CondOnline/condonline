<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentStoreRequest;
use App\Http\Requests\DocumentUpdateRequest;
use App\Models\Document;
use App\Traits\FileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class DocumentController extends Controller
{
    use FileTrait;

    /**
     * @var Document
     */
    private $document;

    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.documents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentStoreRequest $request)
    {
        if(Gate::denies('admin.documents.create')){
            abort(403, 'This action is unauthorized.');
        }

        $data = $request->validated();

        $data['document'] = $this->fileUpload($request->document, 'document');

        $document = $this->document->create($data);

        $toastr = array(
            [
                'type' => 'success',
                'message' => 'Documento cadastrado com sucesso!'
            ]
        );

        return redirect()->route('user.documents.index')->with('toastr', $toastr);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        return view('admin.documents.edit', [
            'document' => $document
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentUpdateRequest $request, Document $document)
    {
        if(Gate::denies('admin.documents.edit')){
            abort(403, 'This action is unauthorized.');
        }

        $data = $request->validated();
        $document->update($data);

        $toastr = array(
            [
                'type' => 'info',
                'message' => 'Documento editado com sucesso!'
            ]
        );

        return redirect()->route('user.documents.index')->with('toastr', $toastr);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        $this->removeFile($document->document, 'document');

        DB::table('notifications')->where('data->document', $document->id)->delete();

        $document->delete();

        $toastr = array(
            [
                'type' => 'info',
                'message' => 'Documento removido com sucesso!'
            ]
        );

        return redirect()->route('user.documents.index')->with('toastr', $toastr);
    }
}
