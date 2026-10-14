<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('context')->nullable();
            $table->longText('objectives')->nullable();
            $table->longText('results')->nullable();
            $table->string('cover')->nullable();
            $table->json('gallery')->nullable();
            $table->json('indicators')->nullable();
            $table->string('location')->nullable();
            $table->date('started_at')->nullable();
            $table->date('ended_at')->nullable();
            $table->string('status')->default('publie');
            $table->boolean('featured')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
