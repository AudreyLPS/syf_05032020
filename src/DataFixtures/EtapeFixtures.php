<?php

namespace App\DataFixtures;

use App\Entity\Etape;
use Faker\Factory as Faker;
use App\DataFixtures\PaysFixtures;
use App\DataFixtures\ContinentFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EtapeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
    	$faker = Faker::create();

	    for($i = 0; $i < 60; $i++) {
		    $etape = new Etape();
		    $etape->setName( $faker->sentence(3) );
		    $etape->setDescription( $faker->text(200) );
		    $etape->setDuration( $faker->randomFloat(0, 1, 15) );
			$etape->setImage('default.jpg');
			
			$randomPays = random_int(0,29);
			$pays = $this->getReference("pays$randomPays");
			$etape->setPays($pays);

		    $manager->persist($etape);
	    }

        $manager->flush();
	}
	
	public function getDependencies(){
		return([
			PaysFixtures::class
		]);
	}
}