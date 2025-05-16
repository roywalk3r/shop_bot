<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->string('id')->primary();

            // Domain name for this tenant
            $table->string('domain')->unique()->nullable();

            // Tenant store name
            $table->string('name');

            // Subscription plan (free, basic, premium)
            $table->string('plan')->default('free');

            // Tenant status (active, inactive, suspended)
            $table->string('status')->default('active');

            // Owner of the tenant (reference to users table)
            $table->unsignedBigInteger('owner_id')->nullable();

            // Store settings as JSON
            $table->json('settings')->nullable();

            $table->timestamps();
            $table->json('data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
}
