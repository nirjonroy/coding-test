<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');


            $table->unsignedBigInteger('user_id');
                        $table->enum('transaction_type', ['deposit', 'withdrawal']);
                        $table->double('amount');
                        $table->string('description');
                        $table->date('date');
                        $table->decimal('total_withdrawal', 10, 2)->default(0.00);
                        $table->string('fee')->nullable();
                        $table->timestamps();

                        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
