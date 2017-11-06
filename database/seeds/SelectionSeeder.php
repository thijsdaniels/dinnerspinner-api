<?php

use App\Models\Recipe;
use App\Models\Selection;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Class SelectionSeeder
 */
class SelectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Selection::truncate();

        /** @var User $mrPoopyButthole */
        $mrPoopyButthole = User::where('username', 'mrpoopybutthole')->firstOrFail();

        /** @var Recipe $baconPancakes */
        $baconPancakes = Recipe::where('name', 'Bacon Pancakes')->firstOrFail();

        Selection::create([
            'user_id' => $mrPoopyButthole->getKey(),
            'recipe_id' => $baconPancakes->getKey(),
            'bought_at' => null,
            'cooked_at' => null,
        ]);
    }
}
