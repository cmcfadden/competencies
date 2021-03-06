<?php


use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class readiness_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		factory(\App\Models\Competency::class, 10)->create()->each(function ($u) {
        	
			$faker = Faker::create();
        	foreach(factory(\App\Models\DescriptorTrait::class, 10)->make() as $item) {
        		$u->descriptorTraits()->save($item);	
        	}

        	for($i=1; $i<=3; $i++) {
	    	     $level = new \App\Models\Level([
	            	'level_number' => $i,
	            	'level_description' => $faker->text
	        	]);
	    		$u->levels()->save($level);
        	}
        	

        
        	$traits = $u->descriptorTraits()->pluck('id');

        	foreach(range(1,10) as $index){
        		$descriptor = new \App\Models\Descriptor([
                	'descriptor_text' => $faker->text,
                	'descriptor_as_question' => $faker->text,
                	'trait_id'=> $faker->randomElement($traits->all())
            	]);
        		$u->descriptors()->save($descriptor);
        	}

    		
   	 	});
    }
}
