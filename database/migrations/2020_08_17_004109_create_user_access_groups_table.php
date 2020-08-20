<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAccessGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_access_groups', function (Blueprint $table) {
            $table->id();

            $table->string('title')->unique();
            $table->text('description');

            $table->timestamps();
        });

        DB::table('user_access_groups')->insert([
                'title' => 'Administrador',
                'description' => 'Grupo de administrador com todas as permissões'
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
        Schema::dropIfExists('user_access_groups');
    }
}
