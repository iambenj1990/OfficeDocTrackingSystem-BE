<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentRequest;
use App\Models\Documents;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            //code...
        } catch (ValidationException $e) {
            // Handles failed $request->validate() rules
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors'  => $e->errors()
            ], 422);
        } catch (NotFoundHttpException $e) {
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

       public function incoming(Request $request)
    {
        //
            $outgoing = $request->validate([
            'office' => 'required,',
            'document_type' => 'required',
        ]);

        try {
            //code...
        } catch (ValidationException $e) {
            // Handles failed $request->validate() rules
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors'  => $e->errors()
            ], 422);
        } catch (NotFoundHttpException $e) {
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

     public function outgoing(Request $request)
    {
        //
        $outgoing = $request->validate([
            'office' => 'required,',
            'document_type' => 'required',
        ]);
        try {
            //code...
        } catch (ValidationException $e) {
            // Handles failed $request->validate() rules
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors'  => $e->errors()
            ], 422);
        } catch (NotFoundHttpException $e) {
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
    public function store(DocumentRequest $request)
    {
        //

        try {
            //code...

            $duplicate = Documents::where('title', $request->validated()['title'])->first();

            if ($duplicate) {
                return response()->json([
                    'success' => false,
                    'message' => 'A document with the same title already exists.',
                    'data'    => $duplicate
                ], 409); // 409 Conflict
            }

            $docs = Documents::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Document created successfully.',
                'data'    => $docs
            ], 201);
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
    public function show(Documents $documents)
    {
        //
        try {
            //code...
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
     * Show the form for editing the specified resource.
     */
    public function edit(Documents $documents)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Documents $documents)
    {
        //
        try {
            //code...
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
     * Remove the specified resource from storage.
     */
    public function destroy(Documents $documents)
    {
        //
        try {
            //code...
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
}
