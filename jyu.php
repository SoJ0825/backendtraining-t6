<?php
require_once 'vendor/autoload.php';

$faker = Faker\Factory::create();

for ($i = 0; $i < 50; $i++) {
    do {
        $names = $faker->unique()->Name();
    } while (strlen($names) > 10);

    if ($i % 10 == 9) {
        printf("%10s\n", $names);
    } else {
        printf("%10s, ", $names);
    }
}

