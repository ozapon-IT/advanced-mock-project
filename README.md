# 飲食店予約アプリ Rese
「Rese」は、**シンプルで使いやすい飲食店予約サービス**を提供することを目的としたWebアプリケーションです。  
ユーザーが直感的に操作できるよう設計されており、店舗検索から予約、レビュー投稿までをスムーズに行えるようになっています。

<img width="1462" alt="Reseトップページ" src="https://github.com/user-attachments/assets/04948843-7258-44bb-a55b-2c9909369cce" />

## 作成した目的
近年、外部の飲食店予約サービスを利用する飲食店が増えていますが、多くのプラットフォームでは予約ごとに手数料が発生し、店舗側の負担となっています。  
また、店舗独自のブランディングや顧客管理を行いたくても、既存のサービスでは自由度が制限されることが少なくありません。  

そこで「Rese」では、**飲食店が手数料を気にせず、自社で運営できる予約サービスを提供すること**を目的としています。  
店舗側が自ら予約を管理できるシステムを構築することで、**コスト削減・顧客データの一元管理・自由なプロモーション戦略の実現**を可能にします。  
これにより、飲食店の経営効率向上と、ユーザーにとってよりシンプルで使いやすい予約体験の提供を目指します。

## アプリケーションURL
 [https://rese-prod-aws.com](https://rese-prod-aws.com)

### アカウント情報
アプリの上部左側メニューアイコンをクリック->Loginでログインページに遷移します。下記のダミーデータのアカウントでログインし、アプリの機能を使用できます。
- 一般ユーザー
  - メールアドレス: test@user1.com パスワード: testuser1
> ログインできる一般ユーザーはuser1~user10まで用意しています。それぞれメールアドレスとパスワードのuser+数字を変えてください。

- 店舗代表者
  - メールアドレス: test@daihyousha1.com パスワード: daihyousha1
> ログインできる店舗代表者はdaihyousha1~daihyousha20まで用意しています。それぞれメールアドレスとパスワードのdaihyousha+数字を変えてください。

- 管理者
  - メールアドレス: test@admin.com パスワード: testadmin
 
## 機能一覧
### **基本機能(全ユーザー向け)機能**
- ログイン
- ログアウト
- 飲食店一覧取得
- 飲食店詳細取得
- 飲食店検索(エリア・ジャンル・キーワード)
- レビュー一覧取得
  
### **一般ユーザー向け機能**
- 会員登録
- メール認証
- ユーザー予約情報取得
- ユーザー飲食店お気に入り一覧取得
- ユーザー飲食店予約情報取得
- ユーザー訪問店一覧取得
- 飲食店お気に入り追加
- 飲食店お気に入り削除
- 飲食店予約情報追加
- 飲食店予約情報変更
- 飲食店予約情報削除
- レビュー作成
- レビュー更新
- 予約完了メール送信(予約完了後に予約詳細とQRコード画像が送信されます)
- 予約リマインダーメール送信(予約当日の朝8:00に送信されます)  

### **管理者向け機能**
- 店舗代表者登録
- 一般ユーザー向けお知らせメール作成&送信
- 一般ユーザー向けお知らせメール履歴一覧取得 

### **店舗代表者向け機能**
- 店舗情報作成(店舗名・店舗画像・エリア・ジャンル・店舗概要)
- 店舗情報更新
- 店舗メニュー作成(メニュー名・金額)
- 店舗メニュー更新
- 予約一覧取得
- 予約詳細取得
- ユーザー来店処理(ユーザーにメール送信されたQRコードを読み取り予約詳細ページの来店ボタンを押すと、予約一覧から除れ、ユーザーのマイページの行ったお店に追加)
- 予約リマインダーメール送信(予約当日の朝8:00に予約一覧が送信されます) 

## 使用技術(実行環境)
### AWS
- EC2
  - Docker 26.1.3(Docker Compose v2.33.0)
    - PHP 8.2.27(Laravel 10.48.28)
    - Nginx 1.27.4
    - Redis 7.4.2
- RDS
  - MySQL 8.4.4
- S3
- Route53
- SES
### SSL化
- ドメイン
  - お名前.com
- SSL証明書
  - Let's encrypt
### Stripe
- テストアカウント
   
### CI/CD
- Github Actions

## テーブル設計
<img width="1310" alt="スクリーンショット 2025-02-28 19 06 39" src="https://github.com/user-attachments/assets/ff0afabb-14f8-4981-9903-20b65fc49293" />
<img width="1304" alt="スクリーンショット 2025-02-28 19 06 54" src="https://github.com/user-attachments/assets/a0cf4562-6232-44b3-b80f-1e94f629c206" />
<img width="1307" alt="スクリーンショット 2025-02-28 19 07 06" src="https://github.com/user-attachments/assets/6ab951b7-d392-4c10-80e3-dde7ec80af81" />
<img width="1303" alt="スクリーンショット 2025-02-28 19 07 15" src="https://github.com/user-attachments/assets/2950af18-468c-4b17-a536-5f75c1137e37" />
<img width="1306" alt="スクリーンショット 2025-02-28 19 07 24" src="https://github.com/user-attachments/assets/7130d053-ef10-44a5-8d32-2886a51e451e" />

## ER図
![advanced-mock-project erd](https://github.com/user-attachments/assets/8e460c3d-851e-4a81-9298-cbf7510d9d5b)


## 環境構築(ローカル環境)

### Dockerビルド

1. `git clone git@github.com:ozapon-IT/advanced-mock-project.git`
2. `docker-compose up -d --build`

> MySQL、phpMyAdmin、MailHogは、OSによって起動しない場合があるのでそれぞれのPCに合わせて `docker-compose.yml` ファイルを編集してください。

### Laravel環境構築

Dockerコンテナ起動後は、下記のコマンドが自動で実行される為(docker-entrypoint.shに定義)特に手動で実行するコマンドはありません。
1. `composer install`
2. `cp .env.development.example .env`
3. `php artisan key:generate`
4. `php artisan storage:link`
5. `php artisan migrate`
6. `php artisan db:seed`
7. `supervisorctl start all`

> ローカル環境で予約機能(予約完了メール送信、予約情報取得等)を確認する場合、下記のStripeセットアップとStripe Webhookローカルテストが必要です。なお、Stripe決済画面にはインターネットに接続されていないと接続エラー(マイページにリダイレクトされます)になってしまいます。

### アカウント情報

Laravel環境構築後ダミーデータのアカウントでアプリにログインできます。
- 一般ユーザー
  - メールアドレス: test@user1.com パスワード: testuser1
> ログインできる一般ユーザーはuser1~user10まで用意しています。それぞれメールアドレスとパスワードのuser+数字を変えてください。

- 店舗代表者
  - メールアドレス: test@daihyousha1.com パスワード: daihyousha1
> ログインできる店舗代表者はdaihyousha1~daihyousha20まで用意しています。それぞれメールアドレスとパスワードのdaihyousha+数字を変えてください。

- 管理者
  - メールアドレス: test@admin.com パスワード: testadmin

### Stripeセットアップ

1. Stripeアカウントの作成とAPIキーの取得
- Stripeの[公式サイト](https://dashboard.stripe.com/register)でテストアカウントを作成します。
- ダッシュボードから「テスト用APIキー」を取得します。
2. 環境変数の設定

`.env` ファイルに以下を追加します
```
STRIPE_SECRET_KEY=your_test_secret_key
STRIPE_PUBLIC_KEY=your_test_public_key
```
> 注：your_test_secret_key と your_test_public_key は、Stripeダッシュボードから取得したテスト用のキーに置き換えてください。

### Webhook のローカルテスト方法

ホストマシン（Docker が動作しているマシン）に Stripe CLI をインストールして Webhook をローカルでテストします。

1. Stripe CLI のインストール
`brew install stripe/stripe-cli/stripe`
2. Stripe CLI の認証
`stripe login`
3. Webhook URL の確認
`http://localhost/api/stripe/webhook`
4. Webhook リスニングの設定
- Stripe CLI を使用して、Webhook イベントを Laravel アプリケーションに転送します。
  
`stripe listen --forward-to http://localhost/api/stripe/webhook`
- `stripe listen`実行時に表示されるシークレットキーを確認。

`Ready! Your webhook signing secret is whsec_xxxxxxxxxx`
- .envファイルに設定
  
`STRIPE_WEBHOOK_SECRET=whsec_xxxxxxxxxx`

5. 参考資料
- [Stripe公式ドキュメント - Stripe CLI](https://docs.stripe.com/stripe-cli/overview)

### 動作確認
1. `stripe listen --forward-to http://localhost/api/stripe/webhook`でstripe listenモードにします。
2. アプリケーションの店舗詳細ページの予約フォームで必要項目を選択し、予約ボタンを押します。
3. Stripeのテスト用カード番号（例：4242 4242 4242 4242）を使用して決済を完了します。
4. 予約完了ページにリダイレクトされ、予約が完了することを確認します(マイページに予約情報が追加)。
5. ユーザーのメールアドレスに予約完了メールが送信されていることを確認します(MailhogのMIMEタブからQRコード画像をダウンロードできます)。 

---

## 使用技術(開発環境)

- Docker 27.3.1
- Docker Compose v2.30.3
- PHP 8.2.27(Laravel 10.48.25)
- Nginx 1.27.4
- MySQL 9.2.0 for Linux on x86_64
- phpMyAdmin 5.2.2
- MailHog latest
- Stripe Stripe-php 16.4
- Stripe CLI 1.24.0

---

## URL

- 本番環境 : [https://rese-prod-aws.com](https://rese-prod-aws.com)
- 開発環境 : [http://localhost](http://localhost)
- phpMyAdmin : [http://localhost:8080](http://localhost:8080)
- MailHog : [http://localhost:8025](http://localhost:8025)
- Stirpe公式 : [https://dashboard.stripe.com/register](https://dashboard.stripe.com/register)

---

## 開発環境と本番環境について

- 同じリポジトリでmain(develop)ブランチは開発環境、production-mainブランチで本番環境のコードをそれぞれ管理しています。
- また、.env.development.example(開発環境用)、.env.production.example(本番環境用)で構築を切り分けています。
> 初回デプロイ時は、mainブランチにdocker-compose.prod.ymlを追加し、`docker-compose -f docker-compose.prod.yml up -d --build`で構築しました。

---
