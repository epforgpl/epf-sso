<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Reason for this migration: when using social login (e.g. Facebook), the user may choose not to pass
 * their email address to our app.
 */
class SsoUsersNullableEmail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sso_users', function (Blueprint $table) {
            $table->dropUnique('sso_users_email_unique');
            $table->string('email', 255)->unique()->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sso_users', function (Blueprint $table) {
            $table->dropUnique('sso_users_email_unique');
            $table->string('email', 255)->unique()->nullable(false)->change();
        });
    }
}
