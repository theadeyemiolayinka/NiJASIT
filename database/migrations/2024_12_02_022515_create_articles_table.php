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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('abstract');
            $table->text('citation');
            $table->json('keywords');
            $table->json('authors');

            $table->text('file');
            $table->text('cover');

            $table->text('references')->nullable();
            $table->text('affiliations')->nullable();
            $table->text('funding')->nullable();
            $table->text('acknowledgements')->nullable();
            $table->text('conflicts')->nullable();
            $table->text('data_availability')->nullable();
            $table->text('license')->nullable();
            $table->text('doi')->nullable();

            $table->text('status')->nullable();

            $table->foreignId('user_id')->constrained();
            $table->foreignId('issue_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
