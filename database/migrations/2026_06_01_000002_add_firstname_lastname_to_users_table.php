<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('firstname')->nullable()->after('id');
            $table->string('lastname')->nullable()->after('firstname');
        });

        // Populate firstname/lastname from existing `name` where possible
        DB::table('users')->get()->each(function ($user) {
            if (! empty($user->name)) {
                $parts = preg_split('/\s+/', trim($user->name), 2);
                DB::table('users')->where('id', $user->id)->update([
                    'firstname' => $parts[0] ?? null,
                    'lastname' => $parts[1] ?? null,
                ]);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['firstname', 'lastname']);
        });
    }
};
