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
        Schema::create('supplier', function (Blueprint $table) {
            $table->string('supplier_name')->primary();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->softDeletes();
        });

        Schema::create('user', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('email')->nullable();
            $table->string('access_token')->nullable();
            $table->string('refresh_token')->nullable();
            $table->timestamps();
        });

        Schema::create('product_category', function (Blueprint $table) {
            $table->id('category_id');
            $table->string('name');
            $table->jsonb('filters')->nullable();
            $table->softDeletes();
        });

        Schema::create('product', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignId('category_id')->nullable()->constrained('product_category', 'category_id')->nullOnDelete();

            $table->string('supplier_name')->nullable();
            $table->foreign('supplier_name')->references('supplier_name')->on('supplier')->nullOnDelete();

            $table->string('name');
            $table->string('handle')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->jsonb('attributes')->nullable();
            $table->softDeletes();
        });

        Schema::create('session', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->uuid('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('user')->nullOnDelete();

            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        Schema::create('shopping_cart_position', function (Blueprint $table) {
            $table->id('position_id');

            $table->string('session_id');
            $table->foreign('session_id')->references('id')->on('session')->cascadeOnDelete();

            $table->uuid('product_id');
            $table->foreign('product_id')->references('id')->on('product')->cascadeOnDelete();

            $table->integer('amount')->default(1);
            $table->jsonb('selected_options')->nullable();
        });

        Schema::create('invoice', function (Blueprint $table) {
            $table->id('invoice_id');
            $table->string('token')->unique();
            $table->date('order_date');
            $table->timestamps();
        });

        Schema::create('invoice_position', function (Blueprint $table) {
            $table->id('invoice_position_id');

            $table->foreignId('invoice_id')->constrained('invoice', 'invoice_id')->cascadeOnDelete();

            $table->uuid('product_id');
            $table->foreign('product_id')->references('id')->on('product')->nullOnDelete();

            $table->integer('amount');
            $table->decimal('price_per_unit', 10, 2);
            $table->jsonb('selected_options')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_position');
        Schema::dropIfExists('invoice');
        Schema::dropIfExists('shopping_cart_position');
        Schema::dropIfExists('session');
        Schema::dropIfExists('product');
        Schema::dropIfExists('product_category');
        Schema::dropIfExists('supplier');
        Schema::dropIfExists('user');
    }
};
