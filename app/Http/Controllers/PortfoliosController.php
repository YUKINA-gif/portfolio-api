<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Storage;

/**
 * [API]ポートフォリオデータ作成 class
 * 
 * ポートフォリオデータに関するコントローラー
 * ポートフォリオデータ作成
 * 
 * @access public
 * @author Nakanishi Yukina
 * @category DataCreate
 * @package Controller
 */
class PortfoliosController extends Controller
{
    /**
     * [GET]ポートフォリオデータ取得
     * 
     * ポートフォリオデータ取得
     * 
     * @access public
     * @param Request $request リクエストパラメータ
     * @return Response ポートフォリオデータ取得
     * @var array $ptf  ポートフォリオ全データ
     */
    public function get()
    {
        $ptf = Portfolio::all();

        if ($ptf) {
            return response()->json([
                "ptf" => $ptf
            ], 200);
        } else {
            return response()->json([
                "message" => "Not found"
            ], 404);
        }
    }

    /**
     * [POST]ポートフォリオデータ登録
     * 
     * ポートフォリオデータ登録
     * 
     * @access public
     * @param Request $request リクエストパラメータ
     * @return Response ポートフォリオデータ登録
     * @var array $ptf  新規レコード
     * @var image $image 画像(リクエスト)
     * @var string $path $imageをS3に保存しパスを取得
     * @var array $result 保存結果
     */
    public function post(Request $request)
    {
        // バリデーション設定
        $request->validate([
            "name" => ["required", "string"],
            "image" => ["required", "image"],
            "github" => ["required", "string"],
            "created" => ["required", "text"],
            "detail" => ["required", "text"],
            "difficulties" => ["required", "text"],
            "solutions" => ["required", "text"],
        ]);

        $image = $request->image;
        // S3に画像を保存
        $path = Storage::disk('s3')->putFile('/', $image, 'public');

        $ptf = new Portfolio();
        $result = $ptf->fill([
            "name" => $request->name,
            "image" => $path,
            "github" => $request->github,
            "created" => $request->created,
            "detail" => $request->detail,
            "difficulties" => $request->difficulties,
            "solutions" => $request->solutions,
        ])->save();

        if ($path && $result) {
            return response()->json([
                "message" => "Data created successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Could not process normally"
            ], 404);
        }
    }
}
