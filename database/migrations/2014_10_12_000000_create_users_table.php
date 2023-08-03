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
        // SQL: create table users (....)
        // Naming Convetion
        // table name: plural
        // model name: Singular
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // `id` bigint auto_increament not null primary key
            $table->string('name'); // `name` varchar(255) not null
            $table->string('email')->unique(); // `email` varchar(255) not null unique
            $table->timestamp('email_verified_at')->nullable(); // `email_verified_at` null timestamp/datetime
            $table->string('password'); // `password` varchar(60)
            $table->rememberToken(); // `remmember_token`
            $table->timestamps(); // 1. `created_at` timestamp default current
                                  // 2. `updated_at` timestamp default current
        });
    }

    /**
     * Reverse the migrations. / Rollback the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
