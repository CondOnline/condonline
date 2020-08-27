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
            $table->foreignId('user_access_group_id')->constrained();

            $table->string('name');
            $table->string('cpf')->nullable()->unique();
            $table->string('rg')->nullable();
            $table->string('gender')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->date('birth')->nullable();
            $table->string('photo')->nullable();

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->boolean('dweller')->default(1);
            $table->boolean('blocked')->default(0);
            $table->boolean('first_login')->default(1);


            $table->timestamps();
        });

        DB::table('users')->insert([
                'user_access_group_id' => 1,
                'name' => 'Administrador',
                'birth' => \Carbon\Carbon::parse('1900-01-01'),
                'email' => 'admin@admin.com.br',
                'email_verified_at' => now(),
                'password' => bcrypt('12345678'),
                'dweller' => 0
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
