<?php

namespace Database\Seeders;

use App\Models\Orders\OrderStatus;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{


    protected static $productJsonString = '[
        {
          "product_id": "5c6adce0-63b6-11ec-90d6-0242ac120003",
          "title": "Timeless style",
          "image_url": "https:\/\/content.rolex.com\/dam\/new-watches-2021\/homepage\/roller\/all-watches\/watches_0003_m126200-0020-datejust_portrait.jpg?imwidth=420",
          "description": "The Datejust\u2019s enduring aesthetics make it instantly recognizable. The characteristic shape of the Oyster case, the 18 ct gold fluted bezel, the Cyclops lens over the date and the five-piece link Jubilee bracelet \u2013 specially made for the model \u2013 all contributed to making this watch a classic. ",
          "price": "6000.00"
        },
        {
          "product_id": "5c6ae334-63b6-11ec-90d6-0242ac120003",
          "title": "Oyster Perpetual",
          "image_url": "https:\/\/content.rolex.com\/dam\/new-watches-2020\/homepage\/roller\/all-watches\/watches_0007_m124300-0001-perpetual-41_portrait.jpg?imwidth=420",
          "description": "Watches in the Oyster Perpetual range are direct descendants of the original Oyster, the world\u2019s first waterproof wristwatch, on which Rolex has built its reputation since 1926. These watches benefit from all the fundamental features of the Oyster Perpetual collection \u2013 excellent chronometric precision, a waterproof Oyster case, and self-winding of the movement via a Perpetual rotor. Displaying hours, minutes and seconds, made exclusively of Oystersteel and featuring a sophisticated finish, these are chronometer wristwatches in their purest form. The anti-reflective coating applied to the back of the sapphire crystal on the new generation Oyster Perpetual ensures optimal legibility of the dial.",
          "price": "9000.00"
        },
        {
          "product_id": "5c6ae474-63b6-11ec-90d6-0242ac120003",
          "title": "Cosmograph Daytona",
          "image_url": "https:\/\/content.rolex.com\/dam\/new-watches-2021\/homepage\/roller\/all-watches\/watches_0012_m116519ln-0038-cosmograph-daytona_portrait.jpg?imwidth=420",
          "description": "The Cosmograph Daytona is inextricably linked to the world of motor racing. It allows drivers to measure elapsed time and read average speeds on its trademark tachymetric bezel. The watch pays tribute to a place \u2013 Daytona, Florida \u2013 where passion for speed and racing developed in the early 20th century. The name embodies the historic and privileged bonds between Rolex and motor sport, which were strengthened in 2013 by the brand\u2019s entry into the world of Formula 1\u00ae racing as Global Partner and Official Timepiece.",
          "price": "12000.00"
        },
        {
          "product_id": "5c6ae6ae-63b6-11ec-90d6-0242ac120003",
          "title": "LADY-DATEJUST",
          "image_url": "https:\/\/content.rolex.com\/dam\/2021\/upright-bba-with-shadow\/m279458rbr-0001.png?impolicy=v6-upright&imwidth=270",
          "description": "The light reflections on the case sides and lugs highlight the elegant profile of the 28 mm Oyster case, which is fitted with a diamond-set bezel. Rolexs classic feminine watch, the Lady-Datejust is in the lineage of the Datejust, the emblematic model that has been a byword for style and accurate timekeeping.",
          "price": "3000.00"
        },
        {
          "product_id": "5c6ae7bc-63b6-11ec-90d6-0242ac120003",
          "title": "PEARLMASTER 39",
          "image_url": "https:\/\/content.rolex.com\/dam\/2021\/upright-bba-with-shadow\/m86409rbr-0001.png?impolicy=v6-upright&imwidth=270",
          "description": "The Oyster Perpetual Pearlmaster 39 in 18 ct white gold with a diamond-paved dial, featuring a diamond-set bezel, case and signature Pearlmaster bracelet",
          "price": "3500.00"
        }
      ]';


    
    protected static function productJsonToArray(){

        $productArray = json_decode(static::$productJsonString);
        
        DB::beginTransaction();

        try{
            foreach( $productArray as  $product){
                Product::create([
                    'product_id' => $product->product_id,
                    'title' => $product->title,
                    'image_url' => $product->image_url,
                    'description' => $product->description,
                    'price' => $product->price,
                ]);
            }
            DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }

    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Product::all()->count() == 0){
            static::productJsonToArray();
        }
    }
}
