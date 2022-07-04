<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_templates', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamp('dead_line');
            $table->Double('franco')->nullable();
            $table->unsignedInteger('brand_id');
            $table->text('comment')->nullable();
            $table->string('status')->default('Brouillon');
            $table->boolean('multi_deliveries')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_templates');
    }
}
