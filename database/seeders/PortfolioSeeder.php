<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            "name" => "Todo",
            "image" => "todo.png",
            "github_front" => "https://github.com/YUKINA-gif/task.git",
            "created" => "7日",
            "detail" => "勉強用にシンプルなTodoリストが欲しく、同時期にVue.jsを勉強したので作成しました。",
            "difficulties" => "当時はデータベースについてまだ勉強していなかったため、タスクをどのように保存すればいいかを考えるのに苦労しました。",
            "solutions" => "調べたところローカルストレージに保存する方法を知り、解決できました。"
        ];
        DB::table("portfolios")->insert(
            $param
        );

        $param = [
            "name" => "AlbumShare",
            "image" => "albumshare.png",
            "github_front" => "https://github.com/YUKINA-gif/Albumshare.git",
            "github_api" => "https://github.com/YUKINA-gif/AlbumShare-api.git",
            "created" => "18日",
            "detail" => "画像の扱いが苦手だったため克服できるアプリを作りたいと思い、作成しました。",
            "difficulties" => "画像の保存を初めてS3を使おうと思ったのですが、上手くいかず設定に時間がかかってしまいました。",
            "solutions" => "S3に関しての記事が多く、それらを参考に何とか設定完了できました！"
        ];
        DB::table("portfolios")->insert(
            $param
        );

        $param = [
            "name" => "飲食店予約アプリ",
            "image" => "rese.png",
            "github_front" => "https://github.com/YUKINA-gif/Rese.git",
            "github_api" => "https://github.com/YUKINA-gif/Rese-api.git",
            "created" => "2ヶ月",
            "detail" => "仕様書をもとに設計→開発→テストまでを各利用者(予約利用者用,店舗代表者用,管理者用)に合わせて開発しました。",
            "difficulties" => "答えがなく一からの開発で、設計が初めてだったので特に苦戦しました。",
            "solutions" => "開発しては修正を繰り返して理解を深めることができました！また、設計をしっかりすることで開発が楽になり、作りながら考えるよりも時間短縮になるのでとても大事だと知れました。"
        ];
        DB::table("portfolios")->insert(
            $param
        );

        $param = [
            "name" => "FesLive",
            "image" => "feslive.png",
            "github_front" => "https://github.com/YUKINA-gif/FesLive.git",
            "github_api" => "https://github.com/YUKINA-gif/FesLive-api.git",
            "created" => "7日",
            "detail" => "趣味でイベント情報の収集を面倒に感じていたため、自分でアプリを作ることにしました。",
            "difficulties" => "Twitter APIを使ったのですが、申請から利用までが初めてだったのでどのような機能があるか一から知ることに苦労しました。",
            "solutions" => "まずはどのような機能があるかAPIをさわってから設計することで楽になり、情報収集も楽になりました。時間を取りつつ機能を足していく予定です！"
        ];
        DB::table("portfolios")->insert(
            $param
        );

    }
}
