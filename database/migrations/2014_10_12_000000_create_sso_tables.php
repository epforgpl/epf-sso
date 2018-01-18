<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSsoTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->boolean('email_verified');
            $table->string('password', 255);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('social_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('provider_user_id', 255);
            $table->string('provider', 255);
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
	});

        Schema::create('oauth_scopes', function (Blueprint $table) {
            $table->text('scope');
            $table->boolean('is_default');
	});

        Schema::create('oauth_clients', function (Blueprint $table) {
            $table->string('client_id', 255);
            $table->string('client_secret', 255);
            $table->string('redirect_uri', 2000);
            $table->string('grant_types', 80);
            $table->string('scope', 255);
            $table->string('user_id', 255);
            $table->primary('client_id');
	});

        Schema::create('oauth_access_tokens', function (Blueprint $table) {
            $table->string('access_token', 255);
            $table->string('client_id', 255);
            $table->string('user_id', 255);
            $table->timestamp('expires');
            $table->string('scope', 2000);
            $table->primary('access_token');
	});

        Schema::create('oauth_authorization_codes', function (Blueprint $table) {
            $table->string('authorization_code', 255);
            $table->string('client_id', 255);
            $table->string('user_id', 255);
            $table->string('redirect_uri', 2000);
            $table->timestamp('expires');
            $table->string('scope', 2000);
            $table->primary('authorization_code');
	});

        Schema::create('oauth_refresh_tokens', function (Blueprint $table) {
            $table->string('refresh_token', 255);
            $table->string('client_id', 255);
            $table->string('user_id', 255);
            $table->timestamp('expires');
            $table->string('scope', 2000);
            $table->primary('refresh_token');
	});

        Schema::create('oauth_jwt', function (Blueprint $table) {
            $table->string('client_id', 255);
            $table->string('subject', 255);
            $table->string('public_key', 2000);
            $table->primary('client_id');
	});

        Schema::create('oauth_public_keys', function (Blueprint $table) {
            $table->string('client_id', 255);
            $table->string('public_key', 2000);
            $table->string('private_key', 2000);
            $table->string('encryption_algorithm', 255)->default('RS256');
	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('social_users');
        Schema::dropIfExists('oauth_scopes');
        Schema::dropIfExists('oauth_clients');
        Schema::dropIfExists('oauth_access_tokens');
        Schema::dropIfExists('oauth_authorization_codes');
        Schema::dropIfExists('oauth_refresh_tokens');
        Schema::dropIfExists('oauth_jwt');
        Schema::dropIfExists('oauth_public_keys');
    }
}
