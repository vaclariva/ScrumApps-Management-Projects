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
        // Add indexes to projects table
        Schema::table('projects', function (Blueprint $table) {
            $table->index(['user_id', 'status']);
            $table->index(['status']);
            $table->index(['created_at']);
        });

        // Add indexes to teams table
        Schema::table('teams', function (Blueprint $table) {
            $table->index(['user_id']);
            $table->index(['project_id']);
            $table->index(['user_id', 'project_id']);
        });

        // Add indexes to sprints table
        Schema::table('sprints', function (Blueprint $table) {
            $table->index(['project_id']);
            $table->index(['status']);
            $table->index(['end_date']);
        });

        // Add indexes to developments table
        Schema::table('developments', function (Blueprint $table) {
            $table->index(['project_id']);
            $table->index(['status']);
        });

        // Add indexes to project_user_reads table
        Schema::table('project_user_reads', function (Blueprint $table) {
            $table->index(['user_id', 'project_id']);
            $table->index(['read']);
        });

        // Add indexes to users table
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
        // Remove indexes from projects table
        Schema::table('projects', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'status']);
            $table->dropIndex(['status']);
            $table->dropIndex(['created_at']);
        });

        // Remove indexes from teams table
        Schema::table('teams', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['project_id']);
            $table->dropIndex(['user_id', 'project_id']);
        });

        // Remove indexes from sprints table
        Schema::table('sprints', function (Blueprint $table) {
            $table->dropIndex(['project_id']);
            $table->dropIndex(['status']);
            $table->dropIndex(['end_date']);
        });

        // Remove indexes from developments table
        Schema::table('developments', function (Blueprint $table) {
            $table->dropIndex(['project_id']);
            $table->dropIndex(['status']);
        });

        // Remove indexes from project_user_reads table
        Schema::table('project_user_reads', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'project_id']);
            $table->dropIndex(['read']);
        });

        // Remove indexes from users table
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role']);
            $table->dropIndex(['email']);
        });
    }
};
