# Portfolio API

ポートフォリオの API です

## バージョン

-   PHP 7.4.15
-   Laravel 8.4
-   MySQL 8.0

## テーブル設計
|portfolios  |　|　|　|　|　|
| --- | --- |--- |--- |--- |--- |
| カラム名 | 型 | PRIMARY KEY |UNIQUE KEY |NOT NULL |FOREIGN KEY |
| id | unsigned bigint |○ | |○ | |
| name | varchar | ||○| | |
| image | varchar | ||○| | |
| github_front | varchar | ||| | |
| github_api | varchar | ||| | |
| created | varchar | ||○| | |
| url | varchar | ||○| | |
| detail | varchar | ||○| | |
| difficulties | varchar | ||○| | |
| solutions | varchar | ||○| | |
| created_at | timestamp | ||| | |
| updated_at | timestamp | ||| | |

|skills  |　|　|　|　|　|
| --- | --- |--- |--- |--- |--- |
| カラム名 | 型 | PRIMARY KEY |UNIQUE KEY |NOT NULL |FOREIGN KEY |
| id | unsigned bigint |○ | |○ | |
| name | varchar | ||○| | |
| skill | int | ||○| | |
| created_at | timestamp | ||| | |
| updated_at | timestamp | ||| | |



## API設計
| パス | メソッド | リクエストボディ |クエリパラメータ |パスパラメータ |概要 |
| --- | --- |--- |--- |--- |--- |
| /api/contact | POST |name,email,text | | |お問い合わせメール送信 |
| /api/portfolio | GET | | |  |制作物情報取得 |
| /api/portfolio | POST |name,image,git_front,git_api,created,url,detail,difficulties,solutions || |制作物登録 |
| /api/portfolio | PUT |name,image,git_front,git_api,created,url,detail,difficulties,solutions || |制作物更新 |
| /api/portfolio | DELETE |id || |制作物削除 |
| /api/portfolio/image | POST |image || |制作物画像更新 |
| /api/skill | GET | || | スキル情報取得|
| /api/skill | POST |name,skill || | スキル登録|

## API Document

[ GET ] 制作物の情報を取得します

```
/portfolio
```

レスポンス

```
<!-- 200 -->
{
  message: Get events successfully,
  "ptf": [
  {
    "id": 4,
    "name": "FesLive",
    "image": "feslive.png",
    "github_front": "https://github.com/YUKINA-gif/FesLive.git",
    "github_api": "https://github.com/YUKINA-gif/FesLive-api.git",
    "created": "7日",
    "detail": "趣味でイベント情報の収集を面倒に感じていたため、自分でアプリを作ることにしました。",
    "difficulties": "Twitter APIを使ったのですが、申請から利用までが初めてだったのでどのような機能があるか一から知ることに苦労しました。",
    "solutions": "まずはどのような機能があるかAPIをさわってから設計することで楽になり、情報収集も楽になりました。時間を取りつつ機能を足していく予定です！",
  }],
}

<!-- 404 -->
{
  "message" : "Not found"
}
```

[ POST ] 制作物の情報を登録します

```
/portfolio
```

リクエスト

```
{
  "name": "event name",
  "image": "portfolio-image.jpg",
  "detail":"制作物の説明です",
  "created": "7日",
  "guthub_front":"https://github.com/YUKINA-gif/〇〇.git",
  "guthub_api":"https://github.com/YUKINA-gif/〇〇.git",
  "difficulties" : "制作物の苦労した点を記載します",
  "solutions" : "苦労した点の解決方法を記載します"
}
```

レスポンス

```
<!-- 200 -->
{
  "message": "Portfolio updated successfully"
}

<!-- 404 -->
{
  "message" : "Could not process normally"
}
```

[ POST ] 制作物の画像を更新します

```
/portfolio
```

リクエスト

```
{
  "id" : "3",
  "image": "portfolio-image.jpg"
}
```

レスポンス

```
<!-- 200 -->
{
  "message": "Portfolio image updated successfully"
}

<!-- 404 -->
{
  "message" : "Could not process normally"
}

```

[ PUT ] 制作物情報を更新します

```
/portfolio
```

リクエスト

```
{
  "id" : "5",
  "name": "event name",
  "image": "portfolio-image.jpg",
  "detail":"制作物の説明です",
  "created": "7日",
  "guthub_front":"https://github.com/YUKINA-gif/〇〇.git",
  "guthub_api":"https://github.com/YUKINA-gif/〇〇.git",
  "difficulties" : "制作物の苦労した点を記載します",
  "solutions" : "苦労した点の解決方法を記載します" "name": "event update name",
  "tw_account": "EVENT_UPDATE_ACCOUNT",
  "image":"https://pbs.twimg.com/profile_images/〇〇〇.jpg",
  "address": event update address,
  "event_start_date":2021-09-20,
  "event_last_date":2021-09-21,
}
```

レスポンス

```
<!-- 200 -->
{
  "message": "Portfolio updated successfully"
}

<!-- 404 -->
{
  "message" : "Could not process normally"
}
```

[ DELETE ] 制作物情報を削除します

```
/portfolio
```

リクエスト

```
{
  "id" : "5"
}
```

レスポンス

```
<!-- 200 -->
{
  "message": "Portfolio deleted successfully"
}

<!-- 404 -->
{
  "message" : "Not found"
}
```

[ GET ] スキルデータ取得

```
/skill
```

レスポンス

```
<!-- 200 -->
{
  "skill": [
  {
    "id": 1,
    "name": "HTML",
    "skill": 5,
  },
}

<!-- 404 -->
{
  "message" : "Not found"
}
```

[ POST ] スキルデータ登録

```
/skill
```

リクエスト

```
{
  "name" : "スキル名",
  "skill": 4
}
```

レスポンス

```
<!-- 200 -->
{
  "message" : "Skill created successfully"
}

<!-- 404 -->
{
  "message" : "Could not process normally"
}
```

[ POST ] お問い合わせメール送信

```
/contact
```

リクエスト

```
{
  "name" : "名前",
  "email": "test@example.com",
  "test" : "お問い合わせ内容"
}
```

レスポンス

```
<!-- 200 -->
{
  "message" : "Mail Send"
}
```
