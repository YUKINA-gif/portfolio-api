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
        $ptf = Portfolio::orderBy('id', 'desc')->get();

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
            "github_front" => ["required", "string"],
            "github_api" => ["required", "string"],
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
            "github_front" => $request->github_front,
            "github_api" => $request->github_api,
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

    /**
     * [POST]ポートフォリオ画像更新
     * 
     * ポートフォリオ画像を更新する
     * 
     * @access public
     * @param Request $request  リクエストパラメータ
     * @return Response ポートフォリオ画像更新
     * @var string $image_pass  画像のパス
     * @var array $image  パスを配列に入れ回す
     * @var string $req_image  画像(リクエスト)
     * @var array $image_box  画像(リクエスト)のパスを入れる用の配列
     * @var string $image_update 画像(リクエスト)をDBに更新
     */
    public function store_image_update(Request $request)
    {
        // バリデーション設定
        $request->validate([
            "image" => ["required", "image"],
        ]);
        // DBから画像を取得
        $image_pass = Portfolio::where("id", $request->id)->get("image");
        // 取得した画像をS3から削除する
        foreach ($image_pass as $image) {
            Storage::disk('s3')->delete($image->image);
        };
        // 画像(リクエスト)
        $req_image = $request->image;
        // 画像(リクエスト)をS3に保存
        $path = Storage::disk('s3')->putFile('/', $req_image, 'public');

        // S3へ入れた際のパスを取得し、
        $image_box = [
            "image" => $path,
        ];
        // 画像(リクエスト)をDBに更新
        $image_update = Portfolio::where("id", $request->id)->update($image_box);

        if ($image_update) {
            return response()->json([
                "message" => "Portfolio image updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Not found"
            ], 404);
        }
    }

    /**
     * [PUT]ポートフォリオ情報更新
     * 
     * ポートフォリオ情報を更新する
     * 
     * @access public
     * @param Request $request  リクエストパラメータ
     * @return Response ポートフォリオ更新
     * @var array $items ポートフォリオデータ(リクエスト)
     * @var array $result_update ポートフォリオデータ(リクエスト)をDBへ更新
     */
    public function put(Request $request)
    {
        // バリデーション設定
        $request->validate([
            "name" => ["required", "string"],
            "image" => ["required", "image"],
            "github_front" => ["required", "string"],
            "github_api" => ["required", "string"],
            "created" => ["required", "text"],
            "detail" => ["required", "text"],
            "difficulties" => ["required", "text"],
            "solutions" => ["required", "text"],
        ]);

        $items = [
            "name" => $request->name,
            "github_front" => $request->github_front,
            "github_api" => $request->github_api,
            "created" => $request->created,
            "detail" => $request->detail,
            "difficulties" => $request->difficulties,
            "solutions" => $request->solutions,
        ];

        $result_update = Portfolio::where("id", $request->id)->update($items);

        if ($result_update) {
            return response()->json([
                "message" => "Portfolio updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Not found"
            ], 404);
        }
    }

    /**
     * [DELETE]ポートフォリオ情報削除
     * 
     * ポートフォリオ情報を削除する
     * 
     * @access public
     * @param Request $request  リクエストパラメータ
     * @return Response ポートフォリオ情報削除
     * @var string $image_pass DBから画像のパスを取得
     * @var array $image  パスを配列に入れ回す
     * @var string $result ID(リクエスト)から店舗を削除
     */
    public function delete(Request $request)
    {

        $image_pass = Portfolio::where("id", $request->id)->get("image");

        foreach ($image_pass as $image) {
            Storage::disk('s3')->delete($image->image);
        };
        $result = Portfolio::where("id", $request->id)->delete();
        if ($result) {
            return response()->json([
                "message" => "Portfolio deleted successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Not found"
            ], 404);
        }
    }
}
