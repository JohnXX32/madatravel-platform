<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city');
            $table->boolean('is_airport')->default(false);
            $table->unsignedInteger('extra_fee_mga')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('category');
            $table->string('brand');
            $table->string('model');
            $table->unsignedSmallInteger('year')->nullable();
            $table->unsignedTinyInteger('seats')->default(5);
            $table->string('transmission')->default('manual');
            $table->string('fuel')->default('diesel');
            $table->boolean('has_ac')->default(true);
            $table->boolean('suitable_for_piste')->default(false);
            $table->string('status')->default('available');
            $table->unsignedInteger('daily_rate_mga');
            $table->unsignedInteger('chauffeur_daily_rate_mga')->default(0);
            $table->unsignedInteger('deposit_mga')->default(0);
            $table->text('description_fr')->nullable();
            $table->text('description_en')->nullable();
            $table->timestamps();
        });

        Schema::create('location_vehicle', function (Blueprint $table) {
            $table->foreignId('location_id')->constrained()->cascadeOnDelete();
            $table->foreignId('vehicle_id')->constrained()->cascadeOnDelete();
            $table->primary(['location_id', 'vehicle_id']);
        });

        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->json('languages')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });

        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title_fr');
            $table->string('title_en');
            $table->text('summary_fr')->nullable();
            $table->text('summary_en')->nullable();
            $table->unsignedTinyInteger('duration_days');
            $table->string('default_vehicle_category')->nullable();
            $table->boolean('includes_driver')->default(true);
            $table->boolean('includes_hotels')->default(false);
            $table->string('price_unit')->default('vehicle');
            $table->unsignedInteger('base_price_mga');
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->foreignId('vehicle_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('tour_id')->nullable()->constrained()->nullOnDelete();
            $table->date('start_on');
            $table->date('end_on');
            $table->foreignId('pickup_location_id')->nullable()->constrained('locations')->nullOnDelete();
            $table->foreignId('dropoff_location_id')->nullable()->constrained('locations')->nullOnDelete();
            $table->unsignedTinyInteger('pax')->default(2);
            $table->boolean('with_driver')->default(true);
            $table->string('customer_name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('locale', 5)->default('fr');
            $table->text('message')->nullable();
            $table->string('source')->default('web');
            $table->string('status')->default('new');
            $table->timestamps();
        });

        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('vehicle_id')->constrained()->restrictOnDelete();
            $table->foreignId('driver_id')->nullable()->constrained()->nullOnDelete();
            $table->date('start_on');
            $table->date('end_on');
            $table->string('status')->default('confirmed');
            $table->unsignedInteger('total_mga')->default(0);
            $table->string('currency_quoted', 3)->default('MGA');
            $table->decimal('fx_rate_to_eur', 12, 4)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['vehicle_id', 'start_on', 'end_on']);
        });

        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained()->cascadeOnDelete();
            $table->foreignId('booking_id')->nullable()->constrained()->nullOnDelete();
            $table->json('payload')->nullable();
            $table->unsignedInteger('total_mga');
            $table->unsignedInteger('total_eur')->nullable();
            $table->string('pdf_path')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotes');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('leads');
        Schema::dropIfExists('tours');
        Schema::dropIfExists('drivers');
        Schema::dropIfExists('location_vehicle');
        Schema::dropIfExists('vehicles');
        Schema::dropIfExists('locations');
        Schema::dropIfExists('settings');
    }
};
