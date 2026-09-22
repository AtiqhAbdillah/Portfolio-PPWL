<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table): void {
            if (! Schema::hasColumn('projects', 'title')) {
                $table->string('title')->nullable();
            }

            if (! Schema::hasColumn('projects', 'description')) {
                $table->text('description')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table): void {
            if (Schema::hasColumn('projects', 'title')) {
                $table->dropColumn('title');
            }

            if (Schema::hasColumn('projects', 'description')) {
                $table->dropColumn('description');
            }
        });
    }
};
