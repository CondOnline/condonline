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
            $table->foreignId('user_group_id')->constrained();

            $table->string('cpf')->nullable()->unique();
            $table->string('rg')->nullable();
            $table->string('gender')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->date('birth')->nullable();
            $table->string('photo')->nullable();
            $table->double('status')->default(1);

            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
                'user_group_id' => 1,
                'name' => 'Administrador',
                'email' => 'admin@admin.com.br',
                'email_verified_at' => now(),
                'password' => bcrypt('12345678')
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}