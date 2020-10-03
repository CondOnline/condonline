<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\document;
use App\Traits\FileTrait;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    use FileTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = document::all();

        return view('user.documents.index', [
            'documents' => $documents
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(document $document)
    {
        $extension = explode(".", $document->document)[1];
        $filename = str_replace(' ', '_', $document->title).'.'.$extension;

        $response = $this->getFile($document->document, 'document', $filename);

        return $response;
    }
}
