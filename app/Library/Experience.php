<?php

namespace App\Library;

use DB;

class Experience
{
    public function getExperiencesForUser($userId) {
//         SELECT 
// 	e.`elem_id` 
// 	, e.`src_type` AS elem_type
// 	, et.`elem_type_name`
// 	, et.`elem_type_name_official`
// 	, e.`elem_name`
// 	-- , ap_u.`acad_plan`
// FROM 
// 	`pathways`.`portfolio` pf 
// 		INNER JOIN 
// 	`pathways`.`elements` e 
// 			ON pf.`elem_id` = e.`elem_id`
// 		INNER JOIN 
// 	`pathways`.`elem_types` et
// 			ON et.`elem_type_id` = e.`src_type`
// WHERE 
// 	pf.`stud_emplid` = 4836716

		$experiences = DB::connection('mysql2')
			->table("portfolio")
			->join("elements", "portfolio.elem_id", "=", "elements.elem_id")
			->join("elem_types", "elements.src_type", "=", "elem_types.elem_type_id")
			->where("portfolio.exper_type", "observed")
			->where("portfolio.stud_emplid", $userId)
			->select("elements.elem_id", "elements.elem_name", "elements.src_type", "elem_types.elem_type_name", "elem_types.elem_type_name_official")
			->get();
		return $experiences;
    }

    public function getDescriptorForExperience($experience) {
    	 $experienceEntry = DB::connection('mysql2')->table("elements")
    	 	->where("elem_id", $experience)
    	 	->join("elem_types", "elements.src_type", "=", "elem_types.elem_type_id")
    	 	->get();
    	 return $experienceEntry->first();
    }


    public function getTypesOfCoCurriculars() {
    	$types = DB::connection('mysql2')
			->table("co_curricular_types")
			->get();
		return $types;
    }

    public function createCocurricular($cocurricularType, $cocurricularDescriptor, $userId) {

    	$coCurricularId = DB::connection('mysql2')
			->table("co_curriculars")
			->insertGetId(["cc_name"=>$cocurricularDescriptor, "update_emplid" =>$userId, "update_date"=>\Carbon\Carbon::now()]);

		DB::connection('mysql2')
			->table("co_curricular_type_assoc")
			->insert(["cc_id"=>$coCurricularId, "cc_type_id" =>$cocurricularType, "create_emplid"=>$userId, "create_date"=>\Carbon\Carbon::now()]);

		$elementId = DB::connection('mysql2')
			->table("elements")
			->insertGetId(["elem_name"=>$cocurricularDescriptor, "src_id" =>$coCurricularId, "src_db"=>"", "src_tbl"=>"co_curriculars", "src_type"=>"cc", "create_date"=>\Carbon\Carbon::now(), "create_emplid"=>$userId]);

		DB::connection('mysql2')
			->table("portfolio")
			->insert(["stud_emplid"=>$userId, "path_id" =>0, "elem_id"=>$elementId, "update_emplid"=>$userId, "update_date"=>\Carbon\Carbon::now()]);

		return $elementId;


    }


}