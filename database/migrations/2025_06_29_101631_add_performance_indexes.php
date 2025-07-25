<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->index(['user_id', 'status']);
            $table->index(['status']);
            $table->index(['created_at']);
        });

        Schema::table('teams', function (Blueprint $table) {
            $table->index(['user_id']);
            $table->index(['project_id']);
            $table->index(['user_id', 'project_id']);
        });

        Schema::table('sprints', function (Blueprint $table) {
            $table->index(['project_id']);
            $table->index(['status']);
            $table->index(['end_date']);
        });

        Schema::table('developments', function (Blueprint $table) {
            $table->index(['project_id']);
            $table->index(['status']);
        });

        Schema::table('project_user_reads', function (Blueprint $table) {
            $table->index(['user_id', 'project_id']);
            $table->index(['read']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->index(['role']);
            $table->index(['email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'status']);
            $table->dropIndex(['status']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('teams', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['project_id']);
            $table->dropIndex(['user_id', 'project_id']);
        });

        Schema::table('sprints', function (Blueprint $table) {
            $table->dropIndex(['project_id']);
            $table->dropIndex(['status']);
            $table->dropIndex(['end_date']);
        });

        Schema::table('developments', function (Blueprint $table) {
            $table->dropIndex(['project_id']);
            $table->dropIndex(['status']);
        });

        Schema::table('project_user_reads', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'project_id']);
            $table->dropIndex(['read']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role']);
            $table->dropIndex(['email']);
        });
    }
};
