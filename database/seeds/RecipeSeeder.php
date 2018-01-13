<?php

use App\Models\Image;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Requirement;
use App\Models\User;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;

/**
 * Class RecipeSeeder
 */
class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();

        Recipe::truncate();

        /** @var User $mrPoopyButthole */
        $mrPoopyButthole = User::where('username', 'mrpoopybutthole')->firstOrFail();

        /** @var Recipe $recipe */
        $recipe = Recipe::create([
            'user_id' => $mrPoopyButthole->getKey(),
            'name' => 'Bacon Pancakes',
            'directions' => "Bacon ipsum dolor amet pastrami jerky bresaola sausage ground round beef venison corned beef frankfurter meatball. Strip steak shoulder fatback sirloin, bresaola swine jerky t-bone ground round cupim ham hock pastrami pancetta shankle. Doner bacon corned beef andouille pastrami kielbasa, chicken bresaola. Prosciutto ham pork, tri-tip flank ground round pancetta meatball pig landjaeger boudin. Pork loin frankfurter jerky capicola. Shank ham hock leberkas bacon turkey meatball.\r\nPork belly turducken spare ribs sirloin ball tip ribeye corned beef short loin ham hock beef ribs pastrami. Beef boudin sirloin, leberkas fatback kielbasa alcatra capicola pig shankle. Tail bresaola flank, fatback burgdoggen cupim ham hock boudin sausage pastrami pancetta. Biltong beef ribs spare ribs, cupim brisket boudin fatback meatloaf t-bone capicola pork pancetta ribeye. Spare ribs corned beef shank, boudin tail picanha pork chop meatball landjaeger pig salami cow cupim hamburger. Turducken cow prosciutto, kevin flank pig kielbasa ribeye brisket shankle.\r\nTongue shankle swine boudin alcatra venison. Short loin hamburger flank capicola landjaeger meatball shank venison doner chuck leberkas salami ball tip. Meatball short ribs beef chuck. Cupim biltong porchetta shank jowl capicola andouille shankle meatloaf chicken venison.",
            'duration_preparation' => 20,
            'duration_cooking' => 20,
            'difficulty' => -1,
            'rating' => 3.5,
        ]);

        /** @var Ingredient $milk */
        $milk = Ingredient::firstOrCreate([
            'name' => 'Milk',
        ]);

        /** @var Ingredient $eggs */
        $eggs = Ingredient::firstOrCreate([
            'name' => 'Eggs',
        ]);

        /** @var Ingredient $flour */
        $flour = Ingredient::firstOrCreate([
            'name' => 'Flour',
        ]);

        /** @var Ingredient $bacon */
        $bacon = Ingredient::firstOrCreate([
            'name' => 'Bacon',
        ]);

        /** @var Ingredient $syrup */
        $syrup = Ingredient::firstOrCreate([
            'name' => 'Maple Syrup',
        ]);

        $recipe->requirements()->create([
            'ingredient_id' => $milk->getKey(),
            'quantity' => 0.3,
            'unit' => Requirement::UNIT_LITERS,
        ]);

        $recipe->requirements()->create([
            'ingredient_id' => $eggs->getKey(),
            'quantity' => 2,
            'unit' => Requirement::UNIT_PIECES,
        ]);

        $recipe->requirements()->create([
            'ingredient_id' => $flour->getKey(),
            'quantity' => 300,
            'unit' => Requirement::UNIT_GRAMS,
        ]);

        $recipe->requirements()->create([
            'ingredient_id' => $bacon->getKey(),
            'quantity' => 150,
            'unit' => Requirement::UNIT_GRAMS,
        ]);

        $recipe->requirements()->create([
            'ingredient_id' => $syrup->getKey(),
        ]);
    }
}
