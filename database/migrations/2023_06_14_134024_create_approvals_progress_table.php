<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('approvals_progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('demandeur_id');
            $table->unsignedBigInteger('badge_request_id');
            $table->unsignedBigInteger('approver_id')->nullable();
            $table->integer('step')->default(1);
            $table->integer('total_approvers');
            $table->boolean('approved')->default(false);
            $table->timestamp('approval_date')->nullable();
            $table->timestamps();

            $table->foreign('demandeur_id')->references('id')->on('users');
            $table->foreign('approver_id')->references('id')->on('approving');
            $table->foreign('badge_request_id')->references('id')->on('badge_requests');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvals_progress');
    }
};
