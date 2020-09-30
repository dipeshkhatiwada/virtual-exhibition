<?php

use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payment_method = [
            ["payment_method" => "Esewa"],
            ["payment_method" => "Khalti"],
            ["payment_method" => "Banking"],
        ];

        DB::table('payment_method')->insert($payment_method);
    }
}
