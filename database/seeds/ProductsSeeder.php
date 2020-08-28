<?php

use Illuminate\Database\Seeder;
use App\Products;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Products::create(
            [
                'nombre' => 'Martillo Metálico',
                'sku' => 'https://www.ferreteriasamir.com/6372-large_default/martillo-metalico-12onzas-23mm-stanprof.jpg',
                'descripcion' => 'Martillo Metálico 12onzas-23mm Stanprof',
            ]
        );
        Products::create(
            [
                'nombre' => 'Destornillador Eco',
                'sku' => 'https://www.ferreteriasamir.com/10439-large_default/destornillador-eco-516x8-pala-sukra-x20unidades.jpg',
                'descripcion' => 'Destornillador de Pala con Mangos de cuatro lóbulos diseñados ergonómicamente para mayor torque y comodidad. Mangos codificados por colores facilitando la rápida identificación del destornillador.',
            ]
        );
        Products::create(
            [
                'nombre' => 'Taladro Rotomartillo Perforador',
                'sku' => 'https://www.ferreteriasamir.com/6150-large_default/taladro-rotomartillo-perforador-demoledor-800w-sk-2401-kache-tools.jpg',
                'descripcion' => 'Una herramienta giratoria a la que se acopla un elemento de corte (broca) para efectuar perforaciones en madera, metal, plástico y otros materiales, además por su tecnología un taladro también sirve para atornillar/desatornillar elementos de sujeción, lijar, afilar y esmerilar superficies, y hasta para mezclar pintura o mortero.',
            ]
        );
        Products::create(
            [
                'nombre' => 'Taladro Rotomartillo Perforador',
                'sku' => 'https://www.ferreteriasamir.com/6150-large_default/taladro-rotomartillo-perforador-demoledor-800w-sk-2401-kache-tools.jpg',
                'descripcion' => 'Una herramienta giratoria a la que se acopla un elemento de corte (broca) para efectuar perforaciones en madera, metal, plástico y otros materiales, además por su tecnología un taladro también sirve para atornillar/desatornillar elementos de sujeción, lijar, afilar y esmerilar superficies, y hasta para mezclar pintura o mortero.',
            ]
        );
        Products::create(
            [
                'nombre' => 'Alicates Pro',
                'sku' => 'https://www.ferreteriasamir.com/5437-large_default/alicates-pro-de-corte-diagonal-de-alto-poder-8-stanley.jpg',
                'descripcion' => 'Alicates pro de corte diagonal de alto poder, corte con facilidad y rapidez.',
            ]
        );
        Products::create(
            [
                'nombre' => 'Pulidora Black & Decker',
                'sku' => 'https://www.ferreteriasamir.com/10307-large_default/pulidora-black-decker-angular-g650-4-650w-g650-b3.jpg',
                'descripcion' => 'Potente motor protegido contra la abrasión que aumenta su durabilidad, Mango auxiliar de dos, posiciones para mayor comodidad, Traba de eje para un sencillo cambio de disco, Ventana para fácil acceso y reemplazo de carbones.',
            ]
        );
    }
}
