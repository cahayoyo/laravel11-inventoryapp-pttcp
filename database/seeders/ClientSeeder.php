<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            [
                'name'    => 'PDAM Kota Tangerang',
                'email'   => 'pelayanan@tirtabenteng.co.id',
                'address' => 'Komplek PU Prosida Bendungan 10 Kel. Mekarsari Kec. Neglasari Kota Tangerang',
                'phone'   => '0215587234',
                'image'   => 'defaultclient.png',
            ],
            [
                'name'    => 'PT. Mitra Tirta Indonesia Bandung',
                'email'   => 'mitratirta@gmail.com',
                'address' => 'Jl. Saninten No.16, Cihapit, Kec. Bandung Wetan, Kota Bandung, Jawa Barat 40114',
                'phone'   => '08112421202',
                'image'   => 'defaultclient.png',
            ],
            [
                'name'    => 'PDAM Tirta Kahuripan Kab Bogor',
                'email'   => 'pdamtirtakahuri[an@gmail.com',
                'address' => 'Jl. Tegar Beriman, Sukahati, Kec. Cibinong, Kabupaten Bogor, Jawa Barat 16913',
                'phone'   => '0211500862',
                'image'   => 'defaultclient.png',
            ],
            [
                'name'    => 'PT. Alindatama BC',
                'email'   => '-',
                'address' => 'Kota Mega Regency Complex, JL. Cibarusah Km. 10, Cikarang, Cibarusahjaya, Kec. Cibarusah, Kabupaten Bekasi, Jawa Barat 17340',
                'phone'   => '02189953333',
                'image'   => 'defaultclient.png',
            ],
            [
                'name'    => 'PT. Sri Pertiwi Sejati',
                'email'   => '-',
                'address' => 'JL. Raya Cikarang-Cibarusah Km. 12, Cikarang Barat, Pasirsari, Cikarang Sel., Kabupaten Bekasi, Jawa Barat 17530',
                'phone'   => '02189845437',
                'image'   => 'defaultclient.png',
            ],
            [
                'name'    => 'PDAM Tirta Rangga Kab Subang',
                'email'   => 'perumda_am@tirtarangga.com',
                'address' => 'Jalan Darmodiharjo No.2 Kabupaten Subang Provinsi Jawa Barat - Indonesia',
                'phone'   => '0260412052',
                'image'   => 'defaultclient.png',
            ],
            [
                'name'    => 'PDAM Tirta Wening Kota Bandung',
                'email'   => 'bdg@perumdatirtawening.co.id',
                'address' => 'JL. Badak Singa No.10 Bandung',
                'phone'   => '0222509030',
                'image'   => 'defaultclient.png',
            ],
            [
                'name'    => 'PDAM Tirta Bhagasasi Kab Bekasi',
                'email'   => 'customercare@tirtabhagasasi.co.id',
                'address' => 'Jl. Kalimalang BTB 25, Jl. Tegal Danas, Kec. Cikarang Pusat, Kabupaten Bekasi, Jawa Barat 17530, Indonesia',
                'phone'   => '02189327101',
                'image'   => 'defaultclient.png',
            ],
            [
                'name'    => 'Dinas Tata Ruang dan Permukiman Kota Depok',
                'email'   => 'disrumkim@depok.go.id',
                'address' => 'Kantor Pemerintahan Depok, Jl. Margonda No.54, Depok, Kec. Pancoran Mas, Kota Depok, Jawa Barat 16431',
                'phone'   => '082311835135',
                'image'   => 'defaultclient.png',
            ],
            [
                'name'    => 'PT. Hero Supermarket',
                'email'   => 'hero@spermarket.co.id',
                'address' => 'PPF9+WH9, Jl. HR Rasuna Said, Pd. Jaya, Kec. Pd. Aren, Kota Tangerang Selatan, Banten 15220',
                'phone'   => '02183788000',
                'image'   => 'defaultclient.png',
            ],
            [
                'name'    => 'Kementerian PUPR Prov Bangka Belitung',
                'email'   => '-',
                'address' => 'Jl. Mentok No.Km.4, Kace Tim., Kec. Mendo Bar., Kota Pangkal Pinang, Kepulauan Bangka Belitung 33173',
                'phone'   => '0717434394',
                'image'   => 'defaultclient.png',
            ],
            [
                'name'    => 'Kementerian PUPR Prov Jawa Barat',
                'email'   => '-',
                'address' => 'Jl. Penjernihan 1 No.19 10, RT.10/RW.6, Bend. Hilir, Kecamatan Tanah Abang, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10210',
                'phone'   => '-',
                'image'   => 'defaultclient.png',
            ],
            [
                'name'    => 'Dinas Bina Marga dan Sumber Daya Air Kota Depok',
                'email'   => '-',
                'address' => 'Jalan Raya Jakarta - Bogor KM.34,5, Sukamaju Baru, Bogor, Sukamaju Baru, Kec. Tapos, Kota Depok, Jawa Barat 16455',
                'phone'   => '0218779988',
                'image'   => 'defaultclient.png',
            ],
            [
                'name'    => 'PT. AETRA Air',
                'email'   => 'customercare@pamjaya.co.id',
                'address' => 'PT Aetra Air Tangerang Jl. Raya Curug No.27, Kadu Jaya, Curug, Tangerang Banten 15810',
                'phone'   => '0215985477',
                'image'   => 'defaultclient.png',
            ],
            [
                'name'    => 'PDAM Tirta Asasta',
                'email'   => 'info@tirtaasastadepok.co.id',
                'address' => 'Jl. Legong Raya No. 1 Kel. Mekarjaya Kec. Sukmajaya Kota Depok',
                'phone'   => '02177820897',
                'image'   => 'defaultclient.png',
            ],
            [
                'name'    => 'Kementerian PUPR Prov Sulawesi Utara',
                'email'   => '-',
                'address' => 'Karampuang, Panakkukang, Makassar City, South Sulawesi 90231',
                'phone'   => '0411441960',
                'image'   => 'defaultclient.png',
            ],
            [
                'name'    => 'Kementerian PUPR Prov Jambi',
                'email'   => 'bwssumatera6@pu.go.id',
                'address' => 'Jalan Lintas Timur No. 01, Mendalo Darat, Kota Jambi',
                'phone'   => '0741445115',
                'image'   => 'defaultclient.png',
            ],
            [
                'name'    => 'Pemerintah Provinsi Jawa Barat Dinas Kesehatan RSUD Al Ihsan',
                'email'   => '-',
                'address' => 'Jl. Kiastramanggala, Baleendah, Kec. Baleendah, Kabupaten Bandung, Jawa Barat 40375',
                'phone'   => '0225940872',
                'image'   => 'defaultclient.png',
            ],
            [
                'name'    => 'Kementerian PUPR Prov Sumatera Utara',
                'email'   => 'satkerwilayah1bppw@gmail.com',
                'address' => 'Jl. Gaperta No. 289 Medan',
                'phone'   => '0618475742',
                'image'   => 'defaultclient.png',
            ],
            [
                'name'    => 'Perumda Tirta Jaya Mandiri Sukabumi',
                'email'   => 'perumdaairminumtirtajayamandiri@gmail.com',
                'address' => 'Jalan Cireundeu No. 5 Karangtengah Cibadak, Kabupaten Sukabumi Jawa Barat',
                'phone'   => '0266532408',
                'image'   => 'defaultclient.png',
            ],
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }
    }
}
