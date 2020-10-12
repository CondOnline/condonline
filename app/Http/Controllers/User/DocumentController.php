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
        $DocumentsNews = Auth()->user()->unreadNotifications()
                                        ->whereType('App\Notifications\NewDocument')
                                        ->get()
                                        ->pluck('data.document')
                                        ->toArray();

        $documents = document::latest('created_at')->get();

        return view('user.documents.index', [
            'documents' => $documents,
            'DocumentsNews' => $DocumentsNews
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
        Auth()->user()->unreadNotifications()->where('data->document', $document->id)->get()->markAsRead();

        $extension = explode(".", $document->document)[1];
        $filename = tirarEspacos(tirarAcentos($document->title)).'.'.$extension;

        $response = $this->getFile($document->document, 'document', $filename);

        return $response;
    }
}
