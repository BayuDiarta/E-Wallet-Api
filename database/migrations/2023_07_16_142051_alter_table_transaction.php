<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        DB::statement('ALTER TABLE transactions DROP CONSTRAINT transactions_type_check');
//
//        DB::statement('ALTER TABLE transactions ADD CONSTRAINT transactions_type_check CHECK (type IN (\'credit\', \'witdraw\', \'debit\'))');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        DB::statement('ALTER TABLE transactions DROP CONSTRAINT transactions_type_check CHECK (type IN (\'credit\', \'witdraw\', \'debit\'))');
    }
};
