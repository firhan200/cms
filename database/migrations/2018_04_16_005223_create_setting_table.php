<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('value');
            $table->boolean('is_active');
            $table->boolean('is_deleted');
            $table->boolean('is_editable')->default(1);
            $table->timestamps();
        });

        //populate default setting
        DB::table('setting')->insert(
            array(
                'name' => 'pagination',
                'description' => 'total data row on 1 page',
                'value' => '10',
                'is_active' => 1,
                'is_deleted' => 0,
                'is_editable' => 0,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            )
        );
        DB::table('setting')->insert(
            array(
                'name' => 'user_default_password',
                'description' => 'reset user password to default password',
                'value' => '123456',
                'is_active' => 1,
                'is_deleted' => 0,
                'is_editable' => 0,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting');
    }
}
