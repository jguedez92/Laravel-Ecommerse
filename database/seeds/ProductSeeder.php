<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'brand'=>'Yamaha',
                'model' =>'Xmax',
                'motor'=>'125cc',
                'license'=>'A1',
                'status'=>'available',
                'price'=>'80',
                'description'=>'Moto scooter perfecta para moverte por la ciudad y evitar el trafico',
                'categories'=>[1],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'brand'=>'Suzuki',
                'model' =>'Dr-650',
                'motor'=>'650',
                'license'=>'A2',
                'status'=>'available',
                'price'=>'110',
                'description'=>'Excelente motard para llevar al terreno como al a calle',
                'categories'=>[3],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'brand'=>'Honda',
                'model' =>'CB125',
                'motor'=>'125cc',
                'license'=>'A1',
                'status'=>'available',
                'price'=>'75',
                'description'=>'una moto muy versatil para disfrutar al maximo de la movilidad en dos ruedas para cualquier persona',
                'categories'=>[2],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'brand'=>'Kawasaki',
                'model' =>'Versys',
                'motor'=>'650',
                'license'=>'A2',
                'status'=>'available',
                'price'=>'130',
                'description'=>'una moto muy potente perfecta para usar y llevarla a donde quieras, ofrece una posicion de conduccion erguida',
                'categories'=>[5,13],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'brand'=>'Yamaha',
                'model' =>'MT-10',
                'motor'=>'1000cc',
                'license'=>'A',
                'status'=>'available',
                'price'=>'280',
                'description'=>'excelente moto que ofrece una experiencia de conduccion unica para conductores expertos de motocicletas',
                'categories'=>[6,17],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'brand'=>'Kawasaki',
                'model' =>'ZZR',
                'motor'=>'1400cc',
                'license'=>'A',
                'status'=>'available',
                'price'=>'300',
                'description'=>'exclente moto para viajes largos con una potencia excepcional',
                'categories'=>[4],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'brand'=>'Yamaha',
                'model' =>'XSR900',
                'motor'=>'900cc',
                'license'=>'A',
                'status'=>'available',
                'price'=>'170',
                'description'=>'una excelente moto con diseño clasico deportivo',
                'categories'=>[7],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'brand'=>'BMW',
                'model' =>'S1000RR',
                'motor'=>'1000cc',
                'license'=>'A',
                'status'=>'available',
                'price'=>'230',
                'description'=>'para los amantes de la velocidad, solo conductores experimentados',
                'categories'=>[8],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ]);
    }
}
