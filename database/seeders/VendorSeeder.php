<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendors = [
            [
                'name'    => 'UD. Benteng Baru Cikampek',
                'email'   => 'bentengbaru_cikampek@yahoo.com',
                'address' => 'Jl. Jend. Sudirman No.5, RT.9/RW.3, Pangulah Sel., Kec. Kotabaru, Kabupaten Karawang, Jawa Barat 4137',
                'phone'   => '02648334295',
            ],
            [
                'name'    => 'PT Sinar Metalindo Utama',
                'email'   => 'info@sinarmetalworks.com',
                'address' => 'Jl. Cilember 319 Cimahi 40522, Jawa Barat, Indonesia',
                'phone'   => '0226652797',

            ],
            [
                'name'    => 'PT. Samudera Insan Teknik',
                'email'   => 'marketing@samuderainsanteknik.com',
                'address' => 'Jl. Holis No.263, Caringin, Kec. Bandung Kulon, Kota Bandung, Jawa Barat 40212',
                'phone'   => '087820563580',

            ],
            [
                'name'    => 'CV. Makmur Santosa',
                'email'   => '-',
                'address' => 'Jl. Naripan No.143, Kb. Pisang, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40111',
                'phone'   => '085102290090',

            ],
            [
                'name'    => 'PT. Phompi Mitra Sentosa',
                'email'   => 'pt.phompimitrasentosa@gmail.com',
                'address' => 'Jl. Bima Marga No. 28, Bekasi Selatan',
                'phone'   => '082111612105',

            ],
            [
                'name'    => 'PT. Nipsea Paint And Chemicals',
                'email'   => 'enquiry@nipponpaint-indonesia.com',
                'address' => 'Jl Ancol Barat I/A5/C No.12, Jakarta 14430 – Indonesia',
                'phone'   => '0216900546',

            ],
            [
                'name'    => 'PT.Jotun Indonesia',
                'email'   => 'csd.id@jotun.com',
                'address' => 'Kawasan Industri MM2100, Jalan Irian III,Blok KK1Cikarang Barat, Bekasi 17846',
                'phone'   => '02189982657',

            ],
            [
                'name'    => 'PT.PROTECH AUTOMATION SOLUTION',
                'email'   => 'uun@ptprotech.com',
                'address' => 'Jl. Jalur Sutra Timur kav.20 Blok 7A No. 15Alam Sutra Serpong Tangerang 15144',
                'phone'   => '02130055158',

            ],
            [
                'name'    => 'PT. Arita Prima Indonesia Tbk',
                'email'   => 'irpan.dwi@arita.co.id',
                'address' => 'Bandung Brand Office: Jl.Sentra Raya Komplek Town Place No.19 Baros –Cimahi',
                'phone'   => '02220671988',

            ],
            [
                'name'    => 'PT. SUPLINDO 88',
                'email'   => 'suplindo88@gmail.com',
                'address' => 'Ruko Metro Sunter Blok B 29 Jl. Danau Sunter Utara Jakarta 14340',
                'phone'   => '081315883352',

            ],
            [
                'name'    => 'PT CHEMITRA ABADI',
                'email'   => 'info@chemitra-abadi.com',
                'address' => 'Synergy Building 11.02 Alam Sutera Tangerang 15139',
                'phone'   => '02130448258',

            ],
            [
                'name'    => 'PT. AXIA MULTI SARANA',
                'email'   => 'danu.axia@gmail.com',
                'address' => 'Graha Mas Fatmawati Blok A9 Jl. Rs. Fatmawati Kav. 71 Jakarta Selatan, Indonesia',
                'phone'   => '081213328689',

            ],
            [
                'name'    => 'PT. Wilo Pumps Indonesia',
                'email'   => 'mohamadgigih.gulanang.2@wilo.com',
                'address' => 'Altira Business Park Blok A01-A02 Jl Yos Sudarso Kav 85 Sunter Jaya, Tanjung Priok Kel Sunter Jaya Kec Tanjung Priok Jakarta, 14350,',
                'phone'   => '6281119117826',

            ],
            [
                'name'    => 'PT. ANUGERAH TEKNIK MANDIRI',
                'email'   => 'roesli.grundfos@gmail.com',
                'address' => 'Jl. Gagak No. 6, Makassar',
                'phone'   => '6281354853175',

            ],
            [
                'name'    => 'PT. Tsurumi Pompa Indonesia',
                'email'   => 'hasbi.tsurumi@gmail.com',
                'address' => 'Komplek Ruko Glodok Plaza Blok F, No. 119 Jl. Mangga Besar 1, Jakarta Barat',
                'phone'   => '081315892199',

            ],
            [
                'name'    => 'PT. Gapa Citra Mandiri',
                'email'   => 'sales@gapacitramandiri.co.id',
                'address' => 'Jl. H. Zainuddin No.47, RT.5/RW.14, Gandaria Utara,',
                'phone'   => '0217399108',

            ],
            [
                'name'    => 'PT. Dheka Visi Tama',
                'email'   => 'dhekavisitama@gmail.com',
                'address' => 'jl letnan sutopo bsd sektor xiv ruko golden madrid blok d no 26 room 397,',
                'phone'   => '081293802865',

            ],
            [
                'name'    => 'PT. Electra Instrumen',
                'email'   => 'ferdianto@electra.co.id',
                'address' => 'Jl. Boulevard Barat Kelapa Gading Plaza Pasifik Blok A4 No.92 Jakarta 14240',
                'phone'   => '0214521391',

            ],
            [
                'name'    => 'CV. Sinar Terang Fastener',
                'email'   => '-',
                'address' => 'Jl. Moh. Toha No.266, Karasak, Kec. Astana anyar, Kota Bandung, Jawa Barat 40243',
                'phone'   => '0225200269',

            ],
            [
                'name'    => 'PT. Intan Pertiwi Nusantara',
                'email'   => 'intanpertiwinusantara@gmail.com',
                'address' => 'Jl. Raya Jatiwaringin Blok A/13 Kel. Cipinang Melayu, Kec. Makasar – Jakarta Timur',
                'phone'   => '02122863068',

            ],
            [
                'name'    => 'PT. LOTUS HEXAGONAL PVC',
                'email'   => '-',
                'address' => 'Jl. Juru mudi Raya No.28 Kebon Besar, Tangerang',
                'phone'   => '081287831198',

            ],
            [
                'name'    => 'PD. Pusaka',
                'email'   => '-',
                'address' => 'Jl. Sunda No.35, Kb. Pisang, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40112',
                'phone'   => '0224238942',

            ],
            [
                'name'    => 'TB. Baraya',
                'email'   => '-',
                'address' => 'Jl. Raya Plered, Plered, Kec. Plered, Kabupaten Purwakarta, Jawa Barat 41162',
                'phone'   => '085959483618',

            ],
            [
                'name'    => 'PD. Skill (CV. Jaya Teknik)',
                'email'   => '-',
                'address' => 'Jl. Jenderal Sudirman No. 232, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta',
                'phone'   => '081283916588',

            ],
            [
                'name'    => 'Tijaya Motor',
                'email'   => '-',
                'address' => 'Jl. Raya Sawit – Bojong KM.3 , Linggasari,Darangdan, Purwakarta',
                'phone'   => '087805398448',
            ],
            [
                'name'    => 'Somil Akas',
                'email'   => '-',
                'address' => 'Dusun Lebakwangi Darangdan Puwakarta',
                'phone'   => '081387873411',
            ],
        ];

        foreach ($vendors as $vendor) {
            Vendor::create($vendor);
        }
    }
}
