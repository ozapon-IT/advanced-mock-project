<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Announce;
use Carbon\Carbon;
use Faker\Factory as Faker;

class AnnounceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $announcements = [
            [
                'title' => '新機能「クーポン配布」を開始しました',
                'body' => 'いつもご利用いただきありがとうございます。本日より、店舗ごとにクーポンを発行できる新機能を追加しました。お得なクーポンをチェックして、さらにお得にお食事を楽しんでください！'
            ],
            [
                'title' => 'アプリのメンテナンスのお知らせ',
                'body' => 'システムメンテナンスのため、◯月◯日（◯）の午前2時から午前5時まで、アプリのご利用が一時的にできなくなります。ご不便をおかけしますが、ご理解のほどよろしくお願いいたします。'
            ],
            [
                'title' => 'レビュー機能がパワーアップしました',
                'body' => 'レビュー投稿時に写真を添付できるようになりました！お店の雰囲気や料理の写真を共有して、他のユーザーと情報を共有しましょう！ぜひご活用ください。'
            ],
            [
                'title' => '人気店の予約がしやすくなりました',
                'body' => '混雑が予想される人気店に対し、事前予約枠を増やしました。お好きなお店の空席をすぐに確認できるようになりましたので、ぜひご利用ください！'
            ],
            [
                'title' => 'お問い合わせ窓口の受付時間変更',
                'body' => 'カスタマーサポートの受付時間が変更されました。新しい受付時間は、平日 9:00〜18:00 です。ご質問がございましたら、お気軽にお問い合わせください。'
            ],
            [
                'title' => 'アプリのパフォーマンス向上のお知らせ',
                'body' => 'アプリの動作を改善し、よりスムーズに操作できるようになりました。特に検索機能とお気に入り管理が快適になりましたので、ぜひご利用ください！'
            ],
            [
                'title' => 'ログイン時のセキュリティ強化',
                'body' => '安全性向上のため、ログイン時に二段階認証を導入しました。設定画面から有効化できますので、セキュリティ強化のためにご活用ください。'
            ],
            [
                'title' => 'ランキング機能の導入について',
                'body' => '人気の店舗をランキング形式で表示する新機能を追加しました。エリアごとのランキングを参考に、新しいお気に入りのお店を見つけてください！'
            ],
            [
                'title' => '年末年始の営業について',
                'body' => '一部の店舗では年末年始の営業時間が変更される場合があります。詳細は各店舗のページをご確認ください。楽しい年末年始をお過ごしください！'
            ],
            [
                'title' => '特別キャンペーン開催中！',
                'body' => '本日から1週間限定で、アプリ内の特定店舗で利用できる割引キャンペーンを実施しています。この機会にお得に食事を楽しんでください！'
            ],
            [
                'title' => 'お気に入り機能が改善されました',
                'body' => 'お気に入りの店舗が一覧で見やすくなり、簡単に管理できるようになりました！新たにタグ機能も追加され、より便利に利用できます。'
            ],
            [
                'title' => '予約キャンセルポリシー変更のお知らせ',
                'body' => '予約キャンセル時のルールが変更されました。一部の店舗ではキャンセル期限が厳しくなっておりますので、事前にご確認ください。'
            ],
            [
                'title' => '新しいジャンルが追加されました',
                'body' => '「韓国料理」「ベジタリアン」「スイーツ」など、新たなジャンルを追加しました。これまでよりも幅広い飲食店を検索できるようになりました！'
            ],
            [
                'title' => 'お知らせの通知機能を追加しました',
                'body' => 'アプリ内のお知らせをプッシュ通知で受け取れるようになりました。最新情報を見逃さないよう、通知設定をONにしてご利用ください。'
            ],
            [
                'title' => 'レビュー投稿でポイントが貯まります！',
                'body' => 'レビューを投稿すると、ポイントが貯まる新サービスを開始しました！貯まったポイントは割引クーポンと交換できますので、ぜひご利用ください！'
            ],
            [
                'title' => '新規ユーザー向けクーポン配布中！',
                'body' => '今なら新規会員登録すると、初回予約時に使える500円分のクーポンをプレゼント！ぜひこの機会にアプリをご利用ください。'
            ],
            [
                'title' => '新機能「テイクアウト予約」スタート！',
                'body' => '店舗での食事だけでなく、テイクアウトの事前予約ができるようになりました！忙しい日や特別な日に、スムーズにお食事を楽しんでください。'
            ],
            [
                'title' => 'アプリの不具合を修正しました',
                'body' => '一部の端末で発生していた検索機能の不具合を修正しました。引き続き快適にご利用いただけるよう改善を続けていきます。'
            ],
            [
                'title' => 'レストラン予約のリマインド通知が可能に！',
                'body' => '予約のリマインド通知機能が追加されました。事前に設定しておくと、予約前日に通知が届くので、うっかり忘れる心配がなくなります！'
            ],
            [
                'title' => 'おすすめ店舗の表示が改善されました',
                'body' => 'ユーザーの好みに基づいて、おすすめの店舗をより精度高く表示できるようになりました。新しいお気に入りの店をぜひ見つけてください！'
            ],
        ];

        foreach ($announcements as $announcement) {
            Announce::create([
                'title' => $announcement['title'],
                'body' => $announcement['body'],
                'sent_at' => Carbon::instance($faker->dateTimeBetween('-1 month', 'now')),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
