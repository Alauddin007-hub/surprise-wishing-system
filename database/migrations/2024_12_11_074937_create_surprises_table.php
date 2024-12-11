<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('surprises', function (Blueprint $table) {
            $table->id();
            $table->string('recipient_name');
            $table->string('recipient_email');
            $table->text('message');
            $table->string('media_path')->nullable();
            $table->timestamp('send_at');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surprises');
    }
};
