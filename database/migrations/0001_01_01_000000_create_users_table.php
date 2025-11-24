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
        // default from breeze
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('username', 50)->unique()->after('id');
            $table->enum('role', ['admin', 'user', 'seller'])->default('user')->after('password'); // admin | penjual | user

            $table->boolean('email_verified')
                ->default(false)
                ->after('email_verified_at');

            $table->string('otp_code', 10)->nullable()->after('email_verified');
            $table->timestamp('otp_expired_at')->nullable()->after('otp_code');

            $table->string('store_name', 100)->nullable()->after('otp_expired_at');
            $table->string('store_description', 255)->nullable()->after('store_name');
            $table->string('store_logo', 255)->nullable()->after('store_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // default from breeze
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'username',
                'role',
                'email_verified',
                'otp_code',
                'otp_expired_at',
                'store_name',
                'store_description',
                'store_logo',
            ]);
        });
    }
};
