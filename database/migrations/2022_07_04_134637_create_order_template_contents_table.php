<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTemplateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_template_contents', function (Blueprint $table) {
            $table->id();
            $table->string('ean');
            $table->unsignedInteger('ordertemplate_id');
            $table->string('name');
            $table->string('variant')->nullable();
            $table->decimal('price',19,4)->default(0);
            $table->decimal('discount',19,4)->default(0);
            $table->decimal('step_price',19,4)->nullable();
            $table->unsignedInteger('step_value')->nullable();
            $table->unsignedInteger('package_qty')->nullable();
            $table->boolean('demi_package')->default(0);
            $table->boolean('multi_delivery')->default(0);
            $table->boolean('free')->default(0);
            $table->integer('free_stp')->nullable();
            $table->integer('free_qty')->nullable();
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('order_template_contents');
    }
}
