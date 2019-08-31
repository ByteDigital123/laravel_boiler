<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ImageFileService;

class FileController extends Controller
{
    protected $fileService;

    public function __construct(ImageFileService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->all();

        return $this->fileService->handle($attributes['file']);
    }
}
