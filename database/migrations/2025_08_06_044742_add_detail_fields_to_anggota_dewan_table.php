<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailFieldsToAnggotaDewanTable extends Migration
{
    public function up()
    {
        Schema::table('anggota_dewan', function (Blueprint $table) {
            $table->json('pendidikan')->nullable()->after('fraksi');         // Menyimpan array pendidikan
            $table->json('pengalaman')->nullable()->after('pendidikan');     // Menyimpan array pengalaman
            $table->string('kontak')->nullable()->after('pengalaman');       // Link sosial media
            $table->text('bio')->nullable()->after('kontak');                // Biografi panjang
        });
    }

    public function down()
    {
        Schema::table('anggota_dewan', function (Blueprint $table) {
            $table->dropColumn(['pendidikan', 'pengalaman', 'kontak', 'bio']);
        });
    }
}
