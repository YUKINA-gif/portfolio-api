<?php

namespace App\Http\Controllers;


use App\Models\Skill;
use Illuminate\Http\Request;


/**
 * [API]スキルデータ class
 * 
 * スキルデータに関するコントローラー
 * スキルデータ取得、作成
 * 
 * @access public
 * @author Nakanishi Yukina
 * @category DataCreate
 * @package Controller
 */
class SkillsController extends Controller
{

    /**
     * [GET]スキルデータ取得
     * 
     * スキルデータ取得
     * 
     * @access public
     * @param Request $request リクエストパラメータ
     * @return Response スキルデータ取得
     * @var array $skill  スキル全データ
     */
    public function get()
    {
        $skill = Skill::all();

        if ($skill) {
            return response()->json([
                "skill" => $skill
            ], 200);
        } else {
            return response()->json([
                "message" => "Not found"
            ], 404);
        }
    }

    /**
     * [POST]スキルデータ登録
     * 
     * スキルデータ登録
     * 
     * @access public
     * @param Request $request リクエストパラメータ
     * @return Response スキルデータ登録
     * @var array $skill  新規レコード
     * @var array $result 保存結果
     */
    public function post(Request $request)
    {
        // バリデーション設定
        $request->validate([
            "name" => ["required", "string"],
            "skill" => ["required", "numeric"],
        ]);

        $skill = new Skill();
        $result = $skill->fill([
            "name" => $request->name,
            "skill" => $request->skill,
        ])->save();

        if ($result) {
            return response()->json([
                "message" => "Skill created successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Could not process normally"
            ], 404);
        }
    }
}
