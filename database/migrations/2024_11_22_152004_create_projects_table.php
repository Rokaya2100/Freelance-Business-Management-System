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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('status' ,['completed','20%','50%','80%','pending'])->default('pending');
            $table->text('description');
            $table->string('independent_attachments')->nullable();
            $table->string('customer_attachments')->nullable();
            $table->dateTime('exp_delivery_date');
            $table->dateTime('delivery_date')->nullable();
            $table->foreignId('client_id')->constrained('users');
            $table->foreignId('freelancer_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('section_id')->constrained()->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
