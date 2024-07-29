<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->bigInteger('phone')->nullable();
            $table->string('location')->nullable();
            $table->foreignId('department_id')->nullable()->constrained()->onDelete('cascade');
            // $table->enum('role', ['magang', 'admin', 'supervisor'])->default('magang');
            $table->enum('status', ['active', 'inactive', 'blocked'])->default('active');
            $table->string('about_me')->nullable();
            $table->foreignId('supervisor_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**dskjdksk
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
