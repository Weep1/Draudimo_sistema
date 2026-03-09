<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $brands = [
            'BMW' => ['F70', 'F74', 'G20', 'G70', 'NA0', 'U11', 'U10', 'NA5', 'G27', 'G14'],
            'Mercedes Benz' => ['A-Class', 'C-Class', 'E-Class', 'EQE', 'S-Class', 'CLA', 'EQA', 'EQB'],
            'Volkswagen' => ['Golf', 'Passat', 'Polo', 'Tiguan', 'Touareg', 'Arteon'],
            'Mazda' => ['CX-5', 'CX-30', '3', '6', 'MX-5'],
            'Chrysler' => ['300', 'Pacifica', 'Voyager'],
            'Mitsubishi' => ['Lancer', 'Outlander', 'Pajero', 'Eclipse Cross'],
            'Toyota' => ['Corolla', 'Camry', 'RAV4', 'Highlander', 'Yaris'],
            'Suzuki' => ['Swift', 'Vitara', 'Jimny', 'Baleno'],
            'Volvo' => ['XC40', 'XC60', 'XC90', 'S60', 'S90'],
            'Lexus' => ['IS', 'ES', 'RX', 'NX', 'UX', 'LC'],
            'Audi' => ['A3', 'A4', 'A5', 'A6', 'Q5', 'Q7', 'R8'],
            'Bentley' => ['Continental GT', 'Flying Spur', 'Bentayga'],
            'Ferrari' => ['F8', '488 GTB', 'Roma', 'Portofino', 'SF90'],
            'Lamborghini' => ['Huracan', 'Aventador', 'Urus'],
            'Aston Martin' => ['DB11', 'Vantage', 'DBX']
        ];

        $brand = fake()->randomElement(array_keys($brands));
        $model = fake()->randomElement($brands[$brand]);

        return [
            'reg_number' => strtoupper(fake()->bothify('???###')),
            'brand' => $brand,
            'model' => $model,
        ];
    }
}
