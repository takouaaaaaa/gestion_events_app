<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\EventSportif;
use App\Models\Photo;
use App\Models\Team;
use App\Models\Categorie;
use App\Models\Athlete;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create users and their events
        $users = User::factory(3)->create();

        $users->each(function ($user) {
            $user->eventSportifs()->saveMany(
                EventSportif::factory(random_int(1, 3))
                    ->create(['user_id' => $user->id])
                    ->each(function ($event) {
                        // Create event logo using PhotoFactory
                        $event->logo()->save(
                            Photo::factory()
                                ->withPath('photos/events/logos', 'storage/default-photos/events/logos/event-' . random_int(1, 5) . '.png')
                                ->withName($event->name . '-logo')
                                ->create()
                        );

                        // Create event poster using PhotoFactory
                        $event->poster()->save(
                            Photo::factory()
                                ->withPath('photos/events/posters', 'storage/default-photos/events/posters/event-poster-' . random_int(1, 3) . '.png')
                                ->withName($event->name . '-poster')
                                ->create()
                        );
                    })
            );
        });

        // Create teams (without logos)
        $teams = Team::factory(10)->create();

        // Create categories and athletes
        EventSportif::all()->each(function ($event) use ($teams) {
            Categorie::factory(random_int(3, 6))
                ->create(['event_sportif_id' => $event->id])
                ->each(function ($categorie) use ($teams) {
                    Athlete::factory(random_int(3, 8))
                        ->create([
                            'categorie_id' => $categorie->id,
                            'team_id' => $teams->random()->id,
                        ])
                        ->each(function ($athlete) {
                            // Create athlete photo using PhotoFactory
                            $athlete->photo()->save(
                                Photo::factory()
                                    ->withPath('photos/athletes', 'storage/default-photos/athletes/avatar-' . random_int(1, 3) . '.png')
                                    ->withName($athlete->first_name . '-' . $athlete->last_name . '-photo')
                                    ->create()
                            );
                        });
                });
        });

        // In DatabaseSeeder.php, replace the comments section with:
        EventSportif::all()->each(function ($event) use ($users) {
            // XOR: Choose either to comment on event OR athletes
            if (rand(0, 1)) { // 50% chance to comment on event
                $event->comments()->saveMany(
                    Comment::factory(random_int(1, 3))
                        ->create([
                            'user_id' => $users->random()->id,
                            'commentable_id' => $event->id,
                            'commentable_type' => EventSportif::class,
                        ])
                );
            } else { // Comment on random athletes
                $athletes = $event->athletes()->inRandomOrder()->take(rand(1, 3))->get();
                $athletes->each(function ($athlete) use ($users) {
                    $athlete->comments()->saveMany(
                        Comment::factory(random_int(1, 2))
                            ->create([
                                'user_id' => $users->random()->id,
                                'commentable_id' => $athlete->id,
                                'commentable_type' => Athlete::class,
                            ])
                    );
                });
            }
        });
    }
}
