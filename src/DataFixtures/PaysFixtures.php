<?php

namespace App\DataFixtures;

use App\Entity\Pays;
use Faker\Factory as Faker;
use App\DataFixtures\ContinentFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PaysFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
    	$faker = Faker::create();

	    for($i = 0; $i < 30; $i++) {
		
            $pays = new Pays();
            $pays->setName($faker->unique()->word);
			
			$randomContinent = random_int(0,5);
			$continent = $this->getReference("continent$randomContinent");
			$pays->setContinent($continent);

            $this->addReference("pays$i", $pays);
			$manager->persist($pays);
	    }

        $manager->flush();
    }
    
	
	public function getDependencies(){
		return([
			ContinentFixtures::class
		]);
	}
}