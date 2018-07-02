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
        Schema::create('sso_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->nullable();
            $table->string('email', 255)->unique();
            $table->boolean('email_verified')->default(false);
            $table->string('password', 255);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('sso_password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sso_social_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('provider_user_id', 255);
            $table->string('provider', 255);
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('sso_users');
        });

        // Note - columns marked with "// NN" mean: Making this NOT NULL b/c I don't see a reason for nullable,
        // contrary to setup on https://github.com/bshaffer/oauth2-server-php. If there are problems, can revert.

        Schema::create('sso_oauth_clients', function (Blueprint $table) {
            $table->string('client_id', 255);
            $table->string('client_secret', 255); // NN
            $table->string('redirect_uri', 2000); // NN
            // Grant types allowed for this client ('authorization_code', 'client_credentials', 'refresh_token',
            // 'jwt_bearer', 'password' (= user credentials)). NULL means all are supported. I don't see a reason to
            // allow anything other than 'authorization_code'.
            $table->string('grant_types', 255)->nullable()->default('authorization_code');
            $table->string('scope', 4000);
            // I couldn't find out the use for this when it's filled in (single user client?)
            $table->string('user_id', 255)->nullable();
            $table->primary('client_id');
        });

        Schema::create('sso_oauth_access_tokens', function (Blueprint $table) {
            $table->string('access_token', 255);
            $table->string('client_id', 255);
            $table->string('user_id', 255); // NN
            $table->timestamp('expires');
            $table->string('scope', 4000); // NN
            $table->primary('access_token');
        });

        Schema::create('sso_oauth_authorization_codes', function (Blueprint $table) {
            $table->string('authorization_code', 255);
            $table->string('client_id', 255);
            $table->string('user_id', 255); // NN
            $table->string('redirect_uri', 2000); // NN
            $table->timestamp('expires');
            $table->string('scope', 4000); // NN
            $table->string('id_token', 1000); // NN
            $table->primary('authorization_code');
        });

        Schema::create('sso_oauth_public_keys', function (Blueprint $table) {
            $table->string('client_id', 255)->nullable();
            $table->string('public_key', 2000); // NN
            $table->string('private_key', 2000); // NN
            $table->string('encryption_algorithm', 255)->default('RS256'); // NN
        });

        // I'm not sure if we need this table. Adding just in case.
        Schema::create('sso_oauth_scopes', function (Blueprint $table) {
            $table->string('scope', 255);
            $table->boolean('is_default')->default(false); // NN
            $table->primary('scope');
        });

        // I'm not sure if we need this table. Adding just in case.
        Schema::create('sso_oauth_refresh_tokens', function (Blueprint $table) {
            $table->string('refresh_token', 255);
            $table->string('client_id', 255);
            $table->string('user_id', 255); // NN
            $table->timestamp('expires');
            $table->string('scope', 4000); // NN
            $table->primary('refresh_token');
        });

        // I'm not sure if we need this table. Adding just in case.
        Schema::create('sso_oauth_jwt', function (Blueprint $table) {
            $table->string('client_id', 255);
            $table->string('subject', 255);
            $table->string('public_key', 2000);
            $table->primary('client_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sso_users');
        Schema::dropIfExists('sso_password_resets');
        Schema::dropIfExists('sso_social_users');
        Schema::dropIfExists('sso_oauth_scopes');
        Schema::dropIfExists('sso_oauth_clients');
        Schema::dropIfExists('sso_oauth_access_tokens');
        Schema::dropIfExists('sso_oauth_authorization_codes');
        Schema::dropIfExists('sso_oauth_refresh_tokens');
        Schema::dropIfExists('sso_oauth_jwt');
        Schema::dropIfExists('sso_oauth_public_keys');
    }
}
