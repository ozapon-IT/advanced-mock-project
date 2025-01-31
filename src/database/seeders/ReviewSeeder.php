<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 1)->get();
        if ($users->isEmpty()) {
            throw new \Exception("No users with role 1 (一般ユーザー) found in the database.");
        }

        $shops = Shop::all();
        if ($shops->isEmpty()) {
            throw new \Exception("No shops found in the database.");
        }

        $reviewTitles = [
            '感動のひとときを味わいました！',
            'また訪れたい素敵なお店です',
            '最高の料理とおもてなし',
            '至福の時間を過ごせました',
            'コスパ最強のレストラン！',
            '家族全員が大満足でした',
            '特別な日におすすめしたい',
            '仕事帰りにぴったりの名店',
            '雰囲気・味ともに満点です',
            'リピート確定のお店です！'
        ];

        $reviewContents = [
            '友人の誕生日で利用しましたが、店内の雰囲気がとても良く、スタッフの接客も丁寧で心地よいものでした。料理のクオリティも高く、一品一品が手の込んだ味付けで感動しました。特にメイン料理のステーキは絶品でした。また来たいと思います！',
            '家族での食事に利用しましたが、子供連れでも安心して楽しめるお店でした。メニューの種類も豊富で、どの料理も美味しかったです。価格もリーズナブルで、コスパがとても良いと感じました。次回は友人を誘って訪れたいと思います。',
            '仕事帰りに立ち寄りましたが、店内の落ち着いた雰囲気がとても気に入りました。料理の盛り付けも美しく、味も申し分なし。特に、シェフ特製のパスタが絶品でした。ワインの種類も豊富で、ペアリングを楽しめるのが良かったです。',
            'お店の雰囲気がとてもよく、デートにぴったりのロマンチックな空間でした。コース料理を注文しましたが、一品一品が美しく盛り付けられており、味も最高でした。特にデザートが素晴らしく、最後まで大満足のディナーになりました。',
            '友人と女子会で訪れましたが、スタッフの対応が素晴らしく、料理もとても美味しかったです。特に前菜の盛り合わせが豪華で、ワインとの相性も抜群でした。価格もリーズナブルで、コスパが良いお店だと感じました。また利用したいです。',
            'ランチで訪れましたが、ボリューム満点のメニューに驚きました。サラダ、スープ、メイン、デザートまでついてこの価格は本当にお得だと思います。特にメインのグリルチキンは香ばしく焼き上げられていて、とても美味しかったです。',
            'お店の方がとても親切で、サービスが行き届いていました。料理も見た目が美しく、味も大変満足できるものでした。特にシーフードパスタは魚介の旨みがしっかりと感じられ、大満足でした。特別な日にまた訪れたいと思います。',
            '週末に予約して行きましたが、店内は満席で賑わっていました。それでも料理の提供がスムーズで、待ち時間が少なかったのが好印象でした。お肉料理がとても美味しく、特にステーキは絶妙な焼き加減で最高でした。',
            '一人で訪れましたが、カウンター席があるので落ち着いて食事を楽しめました。シェフが気さくに話しかけてくれたのが嬉しかったです。お店のこだわりが詰まった料理はどれも素晴らしく、次回は友人を連れて来ようと思いました。',
            '何度もリピートしているお気に入りのお店です。毎回料理のクオリティが安定していて、どのメニューを選んでも間違いありません。スタッフの対応も丁寧で、居心地の良い空間が気に入っています。これからも通い続けたいお店です！'
        ];

        DB::beginTransaction();
        try {
            foreach ($shops as $shop) {
                $selectedUsers = $users->shuffle()->take(10);

                foreach ($selectedUsers as $user) {
                    $existingReview = Review::where('user_id', $user->id)
                        ->where('shop_id', $shop->id)
                        ->exists();

                    if (!$existingReview) {
                        Review::create([
                            'user_id' => $user->id,
                            'shop_id' => $shop->id,
                            'rating' => rand(1, 5),
                            'title' => $reviewTitles[array_rand($reviewTitles)],
                            'review' => $reviewContents[array_rand($reviewContents)],
                        ]);
                    }
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception("Failed to seed reviews: " . $e->getMessage());
        }
    }
}
