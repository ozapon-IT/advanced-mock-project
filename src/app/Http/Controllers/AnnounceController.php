<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AnnounceRequest;
use App\Models\Announce;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendAnnouncementJob;
use App\Jobs\UpdateSentAtJob;

class AnnounceController extends Controller
{
    public function showAnnouncePage()
    {
        $announces = Announce::orderByDesc('created_at')->paginate(15);

        return view('admin.announce', compact('announces'));
    }

    public function send(AnnounceRequest $request)
    {
        $validatedData = $request->validated();

        $users = User::where('role', 1)->get();

        if ($users->isEmpty()) {
            return redirect()->route('admin.dashboard')->withErrors(['error' => '対象ユーザーが存在しません。']);
        }

        DB::beginTransaction();

        try {
            $announce = Announce::create($validatedData);

            foreach ($users as $user) {
                SendAnnouncementJob::dispatch($announce, $user);
            }

            UpdateSentAtJob::dispatch($announce);

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('お知らせメール送信エラー: ' . $e->getMessage());

            return redirect()->route('admin.dashboard')->withErrors(['error' => 'メール送信中にエラーが発生しました。']);
        }

        return redirect()->route('show.announce');
    }

    public function showDetailPage(Announce $announce)
    {
        return view('admin.announce_detail', compact('announce'));
    }
}
