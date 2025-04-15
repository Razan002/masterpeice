<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // الحصول على الفئات
        $handicrafts = Category::where('name', 'Handicrafts & Heritage')->first();
        $jewelry = Category::where('name', 'Jewelry')->first();
        $food = Category::where('name', 'Local Food Products')->first();
        $natural = Category::where('name', 'Natural Products')->first();
        $homeEssentials = Category::where('name', 'Home Essentials')->first();

        // الحصول على مالك عشوائي للمنتجات (أول مستخدم في قاعدة البيانات)
        $owner = User::first();

        // إضافة بعض المنتجات عشوائيًا
        Product::create([
            'name' => 'Handmade Pottery Vase',
            'description' => 'A beautifully crafted pottery vase made by local artisans.',
            'price' => 25.99,
            'quantity' => 100,
            'owner_id' => $owner->id,
            'image' => 'pottery_vase.jpg',
            'category_id' => $handicrafts->id,
        ]);

        Product::create([
            'name' => 'Gold Ring',
            'description' => 'Elegant gold ring with intricate design.',
            'price' => 150.00,
            'quantity' => 50,
            'owner_id' => $owner->id,
            'image' => 'gold_ring.jpg',
            'category_id' => $jewelry->id,
        ]);

        Product::create([
            'name' => 'Organic Olive Oil',
            'description' => 'Pure organic olive oil, cold-pressed.',
            'price' => 18.50,
            'quantity' => 200,
            'owner_id' => $owner->id,
            'image' => 'olive_oil.jpg',
            'category_id' => $food->id,
        ]);

        Product::create([
            'name' => 'Herbal Soap Bar',
            'description' => 'Natural herbal soap made from organic ingredients.',
            'price' => 10.00,
            'quantity' => 150,
            'owner_id' => $owner->id,
            'image' => 'herbal_soap.jpg',
            'category_id' => $natural->id,
        ]);

        Product::create([
            'name' => 'Wooden Coffee Table',
            'description' => 'Elegant wooden coffee table with a rustic look.',
            'price' => 120.00,
            'quantity' => 75,
            'owner_id' => $owner->id,
            'image' => 'coffee_table.jpg',
            'category_id' => $homeEssentials->id,
        ]);
    }
}
