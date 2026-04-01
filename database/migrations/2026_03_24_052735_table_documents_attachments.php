<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_document_attachments', function (Blueprint $table){

          $table->id();

            // Relationship to parent document
            $table->unsignedBigInteger('document_id')->index();

            // File location on local filesystem
            $table->string('file_path', 500);         // e.g. storage/documents/2024/report.pdf
            $table->string('file_name', 255);         // original filename e.g. report.pdf
            $table->string('disk', 50)->default('local'); // Laravel disk name, e.g. 'local', 'public'

            // Who uploaded it & when
            $table->string('uploaded_by', 200);       // or unsignedBigInteger if linked to users table

            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraint
            $table->foreign('document_id')
                  ->references('id')
                  ->on('tbl_documents')
                  ->onDelete('cascade');  // deleting a document removes its files too




        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('tbl_document_attachments');
    }
};
