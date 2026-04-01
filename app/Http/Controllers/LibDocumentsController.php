<?php

namespace App\Http\Controllers;

use App\Http\Requests\LibraryDocumentRequest;
use App\Models\LibDocuments;

use function PHPUnit\Framework\isEmpty;

class LibDocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $library = LibDocuments::all();
            if ($library->isEmpty()) {
                return response()->json(['success' => false, 'message' => 'No documents found.'], 404);
            }
            return response()->json(['success' => true, 'documents' => $library], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['success' => false, 'error' => $th->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LibraryDocumentRequest $request)
    {
        //

        try {
            $validated = $request->validated();
            $documentType = LibDocuments::create($validated);
            return response()->json(['success' => true, 'message' => "Document type [{$documentType->document_Type}] successfully saved"], 201);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'error' => $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $library = LibDocuments::findOrFail($id);
            return response()->json(['success' => true, `Added Document {$library} successfully`], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['success' => false, 'error' => $th->getMessage()], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(LibraryDocumentRequest $request, string $id)
    {
        try {

            $library = LibDocuments::findOrFail($id);
            $validated = $request->validated();
            $library->update($validated);
            return response()->json(['success' => true, 'message' => 'Document updated successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'error' => $th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $library = LibDocuments::findOrFail($id);
            $library->delete();

            return response()->json(['success' => true, 'message' => 'Document deactivated successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'error' => $th->getMessage()], 500);
        }
    }
}
