<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->integer('author_id');
            $table->enum('type', ['Sarana', 'Prasarana', 'Kamtibmas']);
            $table->string('jenis', 255);
            $table->date('tanggal');
            $table->time('waktu');
            $table->string('lokasi', 255);
            $table->string('merk', 255);
            $table->integer('biaya');
            $table->enum('status', ['sudah diterimah admin', 'sedang dikerjakan', 'selesai']);
            $table->text('deskripsi');
            $table->string('foto', 255);
            $table->string('foto_perbaikan', 255);
            $table->text('kegiatan_perbaikan');
            $table->string('pihak_terlibat', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporans');
    }
}
