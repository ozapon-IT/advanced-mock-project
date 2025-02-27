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
- 一般ユーザー
  - メールアドレス: test@user1.com パスワード: testuser1
> ログインできる一般ユーザーはuser1~user10まで用意しています。それぞれメールアドレスとパスワードのuser+数字を変えてください。

- 店舗代表者
  - メールアドレス: test@daihyousha1.com パスワード: daihyousha1
> ログインできる店舗代表者はdaihyousha1~daihyousha20まで用意しています。それぞれメールアドレスとパスワードのdaihyousha+数字を変えてください。

- 管理者
  - メールアドレス: test@admin.com パスワード: testadmin
 
## 機能一覧

### **一般ユーザー向け機能**
- **店舗検索**：エリア・ジャンル・キーワードを指定して飲食店を検索可能  
- **予約機能**：店舗の予約を作成・変更・キャンセル可能  
- **レビュー投稿機能**：訪問した店舗のレビューを投稿できる  
- **お気に入り登録**：気に入った店舗をブックマークして管理  

### **管理者向け機能**
- **店舗代表者の登録**：管理者が店舗代表者を登録し、管理可能  
- **お知らせメール作成＆送信**：登録ユーザーに対してお知らせメールを作成・送信  

### **店舗代表者向け機能**
- **店舗情報編集機能**：店舗名・店舗画像・エリア・ジャンルなどの情報を編集可能  
- **店舗メニュー編集機能**：提供するメニューの追加・編集が可能  
- **予約状況確認機能**：店舗の予約状況を一覧で確認可能 

## 使用技術(実行環境)
### AWS
- EC2
  - Docker(docker-compose)
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
### CI/CD
  - Github Actions

## テーブル設計
[rese-table.pdf](https://github.com/ozapon-IT/advanced-mock-project/raw/main/docs/rese-table.pdf)

## 環境構築

### Dockerビルド

1. `git clone git@github.com:ozapon-IT/advanced-mock-project.git`
2. `docker-compose up -d --build`

> MySQL、phpMyAdmin、MailHogは、OSによって起動しない場合があるのでそれぞれのPCに合わせて `docker-compose.yml` ファイルを編集してください。

### Laravel環境構築

1. `docker-compose exec php bash`
2. `composer install`
3. `cp .env.development.example .env`
4. `php artisan key:generate`
5. `php artisan storage:link`
6. `php artisan migrate`
7. `php artisan db:seed`

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

5. 動作確認
  - 1. `stripe listen --forward-to http://localhost/api/stripe/webhook`でstripe listenモードにします。
  - 2. アプリケーションの店舗詳細ページの予約フォームで必要項目を選択し、予約ボタンを押します。
  - 3. Stripeのテスト用カード番号（例：4242 4242 4242 4242）を使用して決済を完了します。
  - 4. 予約完了ページにリダイレクトされ、予約が完了することを確認します。

6. 参考資料
- [Stripe公式ドキュメント - Stripe CLI](https://docs.stripe.com/stripe-cli/overview)

---

## 使用技術

- Laravel Framework 10.48.23
- Laravel Fortify 1.24
- PHP 8.2.26 (cli)
- MySQL 9.1.0 for Linux on x86_64
- Nginx 1.27.2
- phpMyAdmin 5.2.1
- MailHog 1.14.7
- Stripe Stripe-php 16.2
- Stripe CLI 1.21.11

---

## ER図
![飲食店予約アプリRese:ER図](https://github.com/user-attachments/assets/385cf5fa-6a26-4c71-ab9c-15e23acb5f92)


---

## URL

- 開発環境 : [http://localhost](http://localhost)  
- phpMyAdmin : [http://localhost:8080](http://localhost:8080)
- MailHog : [http://localhost:8025](http://localhost:8025)
- Stirpe公式 : [https://dashboard.stripe.com/register](https://dashboard.stripe.com/register)
- 本番環境 : [https://rese-prod-aws.com](https://rese-prod-aws.com)

---

## 本番環境

### 開発環境と本番環境について

- 同じリポジトリでmain(develop)ブランチは開発環境、production-mainブランチで本番環境のコードをそれぞれ管理しています。
- また、.env.development.example(開発環境用)、.env.production.example(本番環境用)で構築を切り分けています。
> 初回デプロイ時は、docker-compose.prod.ymlも用意し、`docker-compose -f docker-compose.prod.yml up -d --build`で構築しました。

### 本番環境(AWS)のネットワーク構成

- VPC内
  - パブリックサブネット
    - EC2(WEBサーバー)
  - プライベートサブネット
    - RDS(MySQL)
- VPC外
  - S3(ストレージ)
- これら全て同じ東京リージョンに配置しています。
- また、独自ドメインを取得&SSL化(Let's encrypt)し、AWSのSESをメール送信サーバーとして利用しています。
