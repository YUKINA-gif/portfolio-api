<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            "name" => "HTML",
            "skill" => 5,
        ];
        DB::table("skills")->insert(
            $param
        );

        $param = [
            "name" => "CSS",
            "skill" => 5,
        ];
        DB::table("skills")->insert(
            $param
        );

        $param = [
            "name" => "Vue.js/JavaScript",
            "skill" => 4,
        ];
        DB::table("skills")->insert(
            $param
        );

        $param = [
            "name" => "Laravel/PHP",
            "skill" => 4,
        ];
        DB::table("skills")->insert(
            $param
        );

        $param = [
            "name" => "GitHub",
            "skill" => 3.5,
        ];
        DB::table("skills")->insert(
            $param
        );

        $param = [
            "name" => "MySQL",
            "skill" => 3.5,
        ];
        DB::table("skills")->insert(
            $param
        );

        $param = [
            "name" => "AWS(S3)",
            "skill" => 3,
        ];
        DB::table("skills")->insert(
            $param
        );
    }
}
