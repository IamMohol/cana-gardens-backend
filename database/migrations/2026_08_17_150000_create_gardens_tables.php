<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name', 150)->default('Cana Gardens');
            $table->string('tagline', 255)->default('The stunning countryside wedding venue you thought you would never find.');
            $table->string('phone_primary', 50)->default('+254 706 948 574');
            $table->string('phone_secondary', 50)->default('+254 722 527 927');
            $table->string('email')->default('info@canagardens.co.ke');
            $table->string('address', 255)->default('Off Kiambu Road, Nairobi, Kenya');
            $table->string('opening_hours', 150)->default('Monday - Sunday: 8:00am - 7:00pm');
            $table->string('consultation_hours', 150)->default('Grounds open for viewing 7:00am - 6:00pm');
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('whatsapp_number', 30)->default('254706948574');
            $table->string('video_url')->nullable();
            $table->string('video_poster')->nullable();
            $table->timestamps();
        });

        Schema::create('hero_slides', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150)->nullable();
            $table->string('image_url');
            $table->string('alt_text', 200)->default('Cana Gardens');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->string('slug')->unique();
            $table->string('icon_name', 50)->default('ring');
            $table->text('short_description')->nullable();
            $table->text('detailed_description')->nullable();
            $table->string('cover_image')->nullable();
            $table->boolean('featured')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('feature_highlights', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->text('description');
            $table->string('icon_name', 50)->default('city');
            $table->string('column_side', 10)->default('left');
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->string('slug')->unique();
            $table->string('image_url');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('gallery_items', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->string('category', 30)->default('weddings');
            $table->string('image_url');
            $table->string('caption', 255)->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug')->unique();
            $table->string('cover_image');
            $table->text('excerpt');
            $table->text('content');
            $table->string('category', 100)->default('Events');
            $table->string('author', 100)->default('Cana Gardens');
            $table->date('published_at');
            $table->string('read_time', 50)->default('3 min read');
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('phone', 50);
            $table->string('email')->nullable();
            $table->string('event_type', 50)->default('wedding');
            $table->integer('estimated_guests')->nullable();
            $table->date('event_date')->nullable();
            $table->text('message');
            $table->string('status', 20)->default('new');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inquiries');
        Schema::dropIfExists('blog_posts');
        Schema::dropIfExists('gallery_items');
        Schema::dropIfExists('activities');
        Schema::dropIfExists('feature_highlights');
        Schema::dropIfExists('services');
        Schema::dropIfExists('hero_slides');
        Schema::dropIfExists('site_settings');
    }
};
