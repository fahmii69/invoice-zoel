<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
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
        DB::unprepared("
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Apel Green Smith', '50000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Apel Malang', '45000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Apel manalagi', '40000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Apel Red Import', '45000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Avocado', '45000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Banana Ambon', '17000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Banana Cavendish', '45000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Banana Hijau', '17000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Banana Kepok', '15000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Banana Kepok Green', '15000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Banana Mas', '15000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Banana Raja', '25000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Banana Susu', '30000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Bengkuang', '12500','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Coconut Grated Clean', '15000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Coconut Old Clean', '15000','PCS',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Coconut Whole', '10000','PCS',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Coconut Young Green', '11000','PCS',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Dragon Fruit Red', '25000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Dragon Fruit White', '0','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Grape Black Local', '0','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Grape Green inport', '85000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Grape Red Import', '75000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Guava', '15000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Kelengkeng', '65000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Kiwi', '75000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Lemon Import', '35000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Lime Green', '23000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Manggo Harum Manis', '30000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Manggo Manalagi', '30000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Manggo Young', '20000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Mangosteen', '40000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Melon Honey Dew', '12000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Melon Rock', '14000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Nangka Ripe', '45000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Orange Crush / Jeruk Purut', '45000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Orange Kintamani', '35000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Orange Lumajang', '35000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Orange Mandarin', '45000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Orange santang', '0','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Orange sunkist', '45000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Orange sunkist Local', '23000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Orange Tangerine', '35000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Papaya Ripe', '7000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('papaya Young', '5500','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Passion Fruit', '120000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Pear Green Import', '55000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Pineapple', '7000','PCS',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Pomegranate', '60000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Pomelo', '30000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Rambutan', '35000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Sawo / Sapadillo', '0','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Sirsak', '0','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Snake Fruit Bali', '25000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Snake Fruit Gula Pasir', '30000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Snake Fruit Pondoh', '20000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Star Fruit', '20000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Star Fruit Baby', '0','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Strawberry Grade A', '100000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Strawberry Grade B', '80000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Tamarillo', '25000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Tomato Big', '17500','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Tomato Cherry Red', '35000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Tomato Cherry Yellow', '60000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Tomato Green', '17000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Tomato Local', '17500','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Water melon Red', '8500','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Water melon Yellow', '15000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Basil Fresh', '45000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Basil Italian', '45000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Basil Sweet / Kemangi', '50000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Basil Thai', '45000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Bay Leaf', '15000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Bay Leaf Dried', '0','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Celery English', '75000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Celery Local', '25000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Celery Stick', '75000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Cinamon Stick', '90000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Coriander Leave', '110000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Dill', '80000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Fennel', '50000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Galangal', '12000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Ginger', '55000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Kapulaga', '0','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Keluwek / Pangi', '0','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Kencur', '80000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('ketumbar', '0','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Lemo Bali', '55000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Lime Leaf', '35000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Marjoran Leaf', '70000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Mint Leaf', '45000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Nutmeg Whole / Pala', '110000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Oregano Dried', '0','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Oregano Fresh', '100000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Parsley Curly', '35000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('parsley Italian', '40000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Rosemarry Leaf', '100000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Sage', '90000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Tamarin', '28000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Taragon Leaf', '80000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Thyme Leaf', '110000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Turmeric', '10000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Turmeric Leaf', '15000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Arcis', '75000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Alfafa Sprout', '45000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Asparagus', '80000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Banana Heart', '17000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Banana Leave', '4000','IKT',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Bangle', '0','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Bean Green / Buncis', '17000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Bean Green Baby', '30000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Bean Long', '15000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Bean Red', '27000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Bean Sprout Long', '11000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Bean Sprout Short', '15000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Bean String', '15000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Bean String Baby', '30000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Beetroot', '20000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Beetrot Baby', '20000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Belimbing Wuluh', '27000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Broccoli', '70000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Broccoli Clean', '85000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Cabbage Chicnnese', '12000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Cabbage Red', '35000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Cabbage White', '11000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Caisin', '15000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Capsicum Green', '35000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Capsicum Red', '45000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Capsicum Yellow', '55000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Carrot baby Local', '15000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Carrot Baby W/Leaf', '13000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('carrot Import', '25000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Carrot Local', '15000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Casava / Ketela pohon', '0','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Casava Leaf', '10000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Cauli Flower', '55000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Chilli Big Green', '28000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Chilli Big Red', '35000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Chilli Hot Green', '45000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Chilli Hot Red', '70000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Chilli Red Bird', '70000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Chilli Red Padi', '70000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Chive Local', '30000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Corn Baby', '30000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Corn Sweet', '12000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Corn Young', '15000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Cucumber Japanese', '17000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Cucumber Lcal', '10000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Edamame Beans', '0','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Eggplant Baby', '12000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Eggplant Itali', '17000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Eggplant Long', '12000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Enggplant Roung', '12000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Garlic Clean Peeled', '40000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Garlic Whole', '30000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Jackfruit Young / nangka Sayur', '13000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Kailan', '50000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Kailan Baby', '55000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Kale', '45000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Kangkung Akar', '13000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('kangkung Lombok', '12000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Kecicang / Bongkot', '13000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Leek / Pre', '35000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Lemon Grass', '15000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Lettuce Butter', '0','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Lettuce Frize Green', '30000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Lettuce Green Curly', '25000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Lettuce Ice Berg', '45000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Lettuce Lolo Verde', '35000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Lettuce loloroso Green', '30000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Lettuce Loloroso Red', '30000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Lettuce Endive Red', '35000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Lettuce Mesclum Mix', '55000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Lettuce Mix Green', '55000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Lettuce Mizuna', '40000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Lettuce Oak Leaf', '0','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Lettuce radicio', '40000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Lettuce Red curly', '15000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Lettuce Romain', '40000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Lettuce Romain Baby', '50000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Lettuce Rucola Baby', '30000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Lettuce Rucola Wild', '50000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Lettuce watercress', '30000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Mushroom Enoki', '80000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Musrhoom Bottom', '33000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Musrhoom Ear / Kuping', '0','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Musrhoom Oyester', '25000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Musrhoom Porchini', '0','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Musrhoom Portabella', '0','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Musrhoom Shimeji', '20000','PACK',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Musrhoom Shitake', '145000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Onion Bombay Red', '60000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('onion Bombay White', '22000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Onion Chives', '25000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Onion Spring', '40000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Pakis', '12000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Pandan Leaf', '15000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Pare', '20000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Pok Coy', '18000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Pok coy Baby', '20000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Potato Baby', '12000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Potato Cilembu', '0','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Potato Medium', '15000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Potato Super', '16000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Potato Sweet', '10000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Pumpkin Whole', '8000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Radish Red', '65000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Radish White', '0','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Shallot Clean', '40000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Shallot Whole', '30000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Snowpeas', '75000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Spinach English', '120000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Spinach Local', '10000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Sugar Cane', '0','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Taro / Talas', '0','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Turnip / Lobak', '15000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('zuccini Green', '40000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('zuccini Green Baby', '100000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('zuccini Yellow', '80000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Bawang Goreng', '135000','KG',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Beras Putri Sejati', '300000','KG',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Brown Sugar', '35000','KG',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Bumbu Pecel Karang Sari', '11000','PACK',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Bunga Jepun', '400','PCS',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Cakwe', '2000','PCS',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Candle Nut / Kemiri', '50000','KG',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Clove Whole', '290000','KG',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Cracker Melinjau', '80000','PACK',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Crackers Udang', '28000','PACK',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Egg Duck', '3000','PCS',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Egg Noodle', '0','DUZ',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Honey Blossom', '45000','BTL',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Ikan Teri Medan', '0','PACK',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Kacang Tanah', '25000','KG',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Ketan Hitam', '20000','KG',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Ketan Putih', '20000','KG',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Milk Kara 1 ltr', '45000','PACK',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Nut Meg whole', '200000','KG',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Pepper Black Powder', '150000','KG',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Pepper Black Whole', '70000','KG',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Pepper White Powder', '160000','KG',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Pepper White Whole', '80000','KG',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Pickle Tongchai', '0','PACK',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Sugar White Local', '17000','KG',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Sweet Tamarine 500 gr', '35000','KG',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Tabasco', '30000','BTL',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Tahu', '600','PCS',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Telor Ayam', '1500','PCS',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Telor Puyuh', '400','PCS',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Tempe', '2000','PACK',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Tepung Cakra Kembar', '9000','KG',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Tepung Segitiga Biru', '9000','KG',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Terasi Udang', '18000','KG',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('White Sugar Import', '17000','KG',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('eggplant small', '7000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Lettuce English Spinach', '80000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Red ginger', '70000','KG',3);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Edible flower', '13000','PACK',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Oreo mini', '15000','PCS',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Astor', '45000','PACK',1);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Strawberry', '115000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Klengkeng', '50000','KG',2);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Potato regular', '16000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Lettuce lolorosso', '30000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Okra', '45000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Baby kale', '45000','KG',4);
        INSERT INTO products(name, sale_price ,unit,category_id) VALUES('Arugula wild', '50000','KG',4);
        
        ");

        // $faker = Faker::create('id_ID');
        // for ($i = 0; $i < count($product[$i]); $i++) {
        //     Stock::create([
        //         'product_id' => $product[$i]->id,
        //         'quantity'   => $faker->randomNumber(2, false),
        //     ]);
        // }

        // $faker->addProvider(new \FakerRestaurant\Provider\id_ID\Restaurant($faker));

        // for ($i = 0; $i < 15; $i++) {
        //     $product = Product::create(
        //         [
        //             'category_id' => Category::inRandomOrder()->first()->id,
        //             'code'        => $faker->unique()->lexify('PDT-???????'),
        //             'name'        => $faker->unique()->foodName(),
        //             'buy_price'   => $faker->numerify('#000'),
        //             'sale_price'  => $faker->numerify('##000'),
        //             'created_at'  => now()->toDateTimeString(),
        //             'updated_at'  => now()->toDateTimeString(),
        //         ]
        //     );
        //     Stock::create([
        //         'product_id' => $product->id,
        //         'quantity'   => $faker->randomNumber(2, false),
        //     ]);
        // }
    }
}
