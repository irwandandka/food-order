<?php

namespace Database\Seeders;

use App\Http\Livewire\Payment;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create(['name' => 'User', 'email' => 'user@gmail.com', 'email_verified_at' => now(), 'password' => bcrypt("user123"), 'roles' => 'user', 'remember_token' => Str::random(60)]);
        User::create(['name' => 'Admin', 'email' => 'admin@gmail.com', 'email_verified_at' => now(), 'password' => bcrypt("admin123"), 'roles' => 'admin', 'remember_token' => Str::random(60)]);

        Menu::create(['name' => 'Ayam Bakar Spesial', 'description' => 'Ayam bakar bumbu spesial dengan sambal terasi dengan nasi dan lalapan', 'price' => 15000, 'stock' => 18, 'image' => 'ayam-bakar.jpg']);
        Menu::create(['name' => 'Cumi Telur Asin', 'description' => 'Cumi goreng tepung dengan saus telur asin yang gurih dan creamy', 'price' => 20000, 'stock' => 12, 'image' => 'cumi-telur-asin.jpg']);
        Menu::create(['name' => 'Ikan Asam Pedas', 'description' => 'Ikan nila dimasak dengan kuah asam pedas dan potongan nanas', 'price' => 26000, 'stock' => 9, 'image' => 'ikan-asam-pedas.jpeg']);
        Menu::create(['name' => 'Mie Ayam Spesial', 'description' => 'Mie ayam dengan pangsit yang renyah dan bakso sebagai pelengkap', 'price' => 13000, 'stock' => 15, 'image' => 'mie-ayam.jpg']);
        Menu::create(['name' => 'Cumi Saus Padang', 'description' => 'Cumi dimasak dengan bumbu saus padang ala abang-abang kaki lima', 'price' => 18000, 'stock' => 14, 'image' => 'cumi-saus-padang.jpg']);
        Menu::create(['name' => 'Udang Telur Asin', 'description' => 'Udang goreng tepung dengan saus telur asin yang gurih dan creamy', 'price' => 22000, 'stock' => 11, 'image' => 'udang-telur-asin.jpg']);
        Menu::create(['name' => 'Tumis Tauge', 'description' => 'Tauge tumis dengan potongan ikan asin yang gurih', 'price' => 12000, 'stock' => 17, 'image' => 'tumis-tauge.jpg']);
        Menu::create(['name' => 'Ayam Kecap', 'description' => 'Ayam dimasak kuah kecap dengan potongan tomat dan cabai segar', 'price' => 14000, 'stock' => 19, 'image' => 'ayam-kecap.jpg']);
        Menu::create(['name' => 'Bakso Komplit', 'description' => 'Bakso komplit dengan 3 jenis bakso dan pangsit sebagai pelengkap', 'price' => 14000, 'stock' => 16, 'image' => 'bakso-komplit.jpg']);
    
        Payment::create(['name' => 'Transfer Bank BCA', 'account_number' => '0989 7667 8786', 'image' => 'bank-bca.jpg']);
        Payment::create(['name' => 'Dana', 'account_number' => '2983 9847 9744', 'image' => 'dana.jpg']);
        Payment::create(['name' => 'Bayar Langsung', 'account_number' => null, 'image' => 'cod.jpg']);
    }
}
