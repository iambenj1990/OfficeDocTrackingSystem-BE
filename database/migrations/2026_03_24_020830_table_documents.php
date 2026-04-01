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
        //
        Schema::create('tbl_documents', function (Blueprint $table) {
            $table->id()->index();
            $table->string('title', 500)->index(); // changed from longText
            $table->longText('subject')->nullable();
            $table->longText('keywords')->nullable()->index();
            $table->longText('issuer')->nullable();
            $table->boolean('range_dates')->default(false);
            $table->string('contact_person', 200)->nullable();
            $table->boolean('need_approval')->default(false);
            $table->string('contact_number', 200)->nullable();
            $table->string('document_type', 200)->nullable()->index(); // fixed default
            $table->date('issue_date');
            $table->date('effect_date');
            $table->string('encoded_by', 200)->index();
            $table->timestamps();
            $table->softDeletes();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('tbl_documents');
    }
};
