<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TrelloWebhookController extends Controller
{
    // Untuk verifikasi webhook (Trello akan GET ke endpoint ini)
    public function verify(Request $request)
    {
        return response('OK', 200);
    }

    // Untuk menerima event dari Trello
    public function handle(Request $request)
    {
        // Simpan log untuk debugging
        Log::info('Trello Webhook:', $request->all());

        $actionType = $request->input('action.type');
        $card = $request->input('action.data.card');
        $board = $request->input('action.data.board');

        // Cek apakah ada data card dan board
        if (!$card || !$board) {
            return response()->json(['status' => 'ignored, no card/board'], 200);
        }

        // Mapping board Trello ke project
        $project = \App\Models\Project::where('trello_board_id', $board['id'])->first();
        if (!$project) {
            return response()->json(['status' => 'ignored, project not found'], 200);
        }

        // Proses event Trello
        if ($actionType === 'createCard') {
            // Tambahkan development baru jika belum ada
            $existing = \App\Models\Development::where('trello_card_id', $card['id'])->first();
            if (!$existing) {
                \App\Models\Development::create([
                    'name' => $card['name'],
                    'desc' => $card['desc'] ?? null,
                    'status' => 'todo', // Default, bisa diimprove dengan mapping list
                    'project_id' => $project->id,
                    'trello_card_id' => $card['id'],
                ]);
            }
        } elseif ($actionType === 'updateCard') {
            // Update development jika ada
            $development = \App\Models\Development::where('trello_card_id', $card['id'])->first();
            if ($development) {
                $development->update([
                    'name' => $card['name'],
                    'desc' => $card['desc'] ?? null,
                    // Bisa tambahkan update status jika ada info list
                ]);
            }
        } elseif ($actionType === 'deleteCard') {
            // Hapus development jika card dihapus di Trello
            $development = \App\Models\Development::where('trello_card_id', $card['id'])->first();
            if ($development) {
                $development->delete();
            }
        }
        // Tambahkan aksi lain sesuai kebutuhan

        return response()->json(['status' => 'ok']);
    }
}
