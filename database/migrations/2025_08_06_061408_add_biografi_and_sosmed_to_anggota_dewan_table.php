<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBiografiAndSosmedToAnggotaDewanTable extends Migration
{
    public function up()
    {
        Schema::table('anggota_dewan', function (Blueprint $table) {
            $table->json('sosmed')->nullable()->after('kontak');

            $table->text('bio_latar')->nullable()->after('bio');
            $table->text('bio_karier')->nullable()->after('bio_latar');
            $table->text('bio_jabatan')->nullable()->after('bio_karier');
            $table->text('bio_visi')->nullable()->after('bio_jabatan');
            $table->text('bio_fokus')->nullable()->after('bio_visi');
        });
    }

    public function down()
    {
        Schema::table('anggota_dewan', function (Blueprint $table) {
            $table->dropColumn([
                'sosmed',
                'bio_latar',
                'bio_karier',
                'bio_jabatan',
                'bio_visi',
                'bio_fokus',
            ]);
        });
    }
}
