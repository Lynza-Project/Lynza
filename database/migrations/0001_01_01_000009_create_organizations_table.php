<?php

use App\Models\Address;
use App\Models\Theme;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('organizations', static function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(Address::class)->nullable();
            $table->foreignIdFor(Theme::class)->nullable();
            $table->string('type');
            $table->string('logo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
