<?php

namespace App\Http\Controllers;

use App\Models\DocumentAttachments;
// use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\DocumentAttachmentRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DocumentAttachmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $docsList = DocumentAttachments::orderBy('created_at', 'desc')->get();

            return response()->json([
                'success'   => true,
                'documents' => $docsList
            ], 200);
        } catch (ValidationException $e) {
            // Handles failed $request->validate() rules
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors'  => $e->errors()
            ], 422);
        }
        // catch (ModelNotFoundException $e) {
        //     // Handles ::findOrFail() / ::firstOrFail() when record not found
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Record not found.',
        //         'error'   => $e->getMessage()
        //     ], 404);

        // }
        catch (NotFoundHttpException $e) {
            // Handles route not found (404)
            return response()->json([
                'success' => false,
                'message' => 'The requested resource was not found.',
                'error'   => $e->getMessage()
            ], 404);
        } catch (QueryException $e) {
            // Handles DB errors (syntax, constraint violations, connection issues)
            Log::error('Database query error', [
                'message' => $e->getMessage(),
                'code'    => $e->getCode()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'A database error occurred.',
                'error'   => $e->getMessage()
            ], 500);
        } catch (HttpException $e) {
            // Handles abort() calls like abort(403), abort(401), etc.
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], $e->getStatusCode());
        } catch (\Exception $e) {
            // Catch-all for any unexpected exceptions
            Log::error('Unexpected error', [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(DocumentAttachmentRequest $request)
    {
        //
        try {

            $docsList = DocumentAttachments::orderBy('created_at', 'desc')->get();

            return response()->json([
                'success'   => true,
                'documents' => $docsList
            ], 200);
        } catch (ValidationException $e) {
            // Handles failed $request->validate() rules
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors'  => $e->errors()
            ], 422);
        }
        // catch (ModelNotFoundException $e) {
        //     // Handles ::findOrFail() / ::firstOrFail() when record not found
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Record not found.',
        //         'error'   => $e->getMessage()
        //     ], 404);

        // }
        catch (NotFoundHttpException $e) {
            // Handles route not found (404)
            return response()->json([
                'success' => false,
                'message' => 'The requested resource was not found.',
                'error'   => $e->getMessage()
            ], 404);
        } catch (QueryException $e) {
            // Handles DB errors (syntax, constraint violations, connection issues)
            Log::error('Database query error', [
                'message' => $e->getMessage(),
                'code'    => $e->getCode()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'A database error occurred.',
                'error'   => $e->getMessage()
            ], 500);
        } catch (HttpException $e) {
            // Handles abort() calls like abort(403), abort(401), etc.
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], $e->getStatusCode());
        } catch (\Exception $e) {
            // Catch-all for any unexpected exceptions
            Log::error('Unexpected error', [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(DocumentAttachmentRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
