<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('email', 200);
            $table->string('password', 60);
            $table->string('api_token')->nullable();
            $table->string('reset_password_token')->nullable();
            $table->dateTime('reset_password_sent')->nullable();
            $table->boolean('is_active');
            $table->boolean('is_deleted');
            $table->timestamps();
        });

        //create default admin account
        DB::table('admin')->insert(
            array(
                'name' => 'Firhan',
                'email' => 'firhan.faisal1995@gmail.com',
                'password' => sha1('123456'),
                'api_token' => '',
                'reset_password_token' => '',
                'is_active' => 1,
                'is_deleted' => 0,
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
        Schema::dropIfExists('admin');
    }
}
