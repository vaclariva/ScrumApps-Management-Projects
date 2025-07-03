<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TrelloService
{
    private $apiKey;
    private $token;
    private $baseUrl = 'https://api.trello.com/1';

    public function __construct()
    {
        $this->apiKey = config('services.trello.key');
        $this->token = config('services.trello.token');
    }

    /**
     * Membuat board baru di Trello
     */
    public function createBoard($name, $description = null)
    {
        try {
            $response = Http::post($this->baseUrl . '/boards', [
                'name' => $name,
                'desc' => $description,
                'key' => $this->apiKey,
                'token' => $this->token,
                'defaultLists' => false,
            ]);

            if ($response->successful()) {
                $boardData = $response->json();

                $this->createDefaultLists($boardData['id']);

                return $boardData;
            }

            Log::error('Gagal membuat board Trello', [
                'response' => $response->json(),
                'status' => $response->status()
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error('Error saat membuat board Trello', ['error' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Membuat list default di board
     */
    private function createDefaultLists($boardId)
    {
        $lists = [
            ['name' => 'To Do', 'pos' => 1],
            ['name' => 'In Progress', 'pos' => 2],
            ['name' => 'Quality Assurance', 'pos' => 3],
            ['name' => 'Done', 'pos' => 4],
        ];

        foreach ($lists as $list) {
            Http::post($this->baseUrl . '/lists', [
                'name' => $list['name'],
                'idBoard' => $boardId,
                'pos' => $list['pos'],
                'key' => $this->apiKey,
                'token' => $this->token,
            ]);
        }
    }

    /**
     * Mendapatkan semua list di board
     */
    public function getBoardLists($boardId)
    {
        try {
            $response = Http::get($this->baseUrl . "/boards/{$boardId}/lists", [
                'key' => $this->apiKey,
                'token' => $this->token,
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            return [];
        } catch (\Exception $e) {
            Log::error('Error saat mengambil list board', ['error' => $e->getMessage()]);
            return [];
        }
    }

    /**
     * Membuat card di Trello
     */
    public function createCard($listId, $name, $description = null, $checklist = [])
    {
        try {
            $response = Http::post($this->baseUrl . '/cards', [
                'name' => $name,
                'desc' => $description,
                'idList' => $listId,
                'key' => $this->apiKey,
                'token' => $this->token,
            ]);

            if ($response->successful()) {
                $cardData = $response->json();

                // Buat checklist jika ada
                if (!empty($checklist)) {
                    $this->createChecklist($cardData['id'], $checklist);
                }

                return $cardData;
            }

            Log::error('Gagal membuat card Trello', [
                'response' => $response->json(),
                'status' => $response->status()
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error('Error saat membuat card Trello', ['error' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Membuat checklist di card
     */
    private function createChecklist($cardId, $checklistItems)
    {
        try {
            // Buat checklist
            $response = Http::post($this->baseUrl . '/checklists', [
                'name' => 'Checklist',
                'idCard' => $cardId,
                'key' => $this->apiKey,
                'token' => $this->token,
            ]);

            if ($response->successful()) {
                $checklistData = $response->json();

                // Tambahkan item ke checklist
                foreach ($checklistItems as $item) {
                    Http::post($this->baseUrl . "/checklists/{$checklistData['id']}/checkItems", [
                        'name' => $item['name'],
                        'key' => $this->apiKey,
                        'token' => $this->token,
                    ]);
                }
            }
        } catch (\Exception $e) {
            Log::error('Error saat membuat checklist', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Menambahkan member ke board
     */
    public function addMemberToBoard($boardId, $email)
    {
        try {
            $response = Http::put($this->baseUrl . "/boards/{$boardId}/members", [
                'email' => $email,
                'type' => 'normal',
                'key' => $this->apiKey,
                'token' => $this->token,
            ]);

            return $response->successful();
        } catch (\Exception $e) {
            Log::error('Error saat menambahkan member ke board', ['error' => $e->getMessage()]);
            return false;
        }
    }

    /**
     * Mendapatkan URL board Trello
     */
    public function getBoardUrl($boardId)
    {
        return "https://trello.com/b/{$boardId}";
    }

    /**
     * Update card di Trello
     */
    public function updateCard($cardId, $data = [])
    {
        try {
            $payload = array_merge($data, [
                'key' => $this->apiKey,
                'token' => $this->token,
            ]);
            $response = Http::put($this->baseUrl . "/cards/{$cardId}", $payload);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('Gagal update card Trello', [
                'response' => $response->json(),
                'status' => $response->status()
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error('Error saat update card Trello', ['error' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Hapus card di Trello
     */
    public function deleteCard($cardId)
    {
        try {
            $response = Http::delete($this->baseUrl . "/cards/{$cardId}", [
                'key' => $this->apiKey,
                'token' => $this->token,
            ]);

            return $response->successful();
        } catch (\Exception $e) {
            Log::error('Error saat menghapus card Trello', ['error' => $e->getMessage()]);
            return false;
        }
    }

    public function syncChecklist($cardId, $checklistGroups)
    {
        try {
            // Hapus semua checklist lama di card
            $response = Http::get($this->baseUrl . "/cards/{$cardId}/checklists", [
                'key' => $this->apiKey,
                'token' => $this->token,
            ]);
            if ($response->successful()) {
                foreach ($response->json() as $checklist) {
                    Http::delete($this->baseUrl . "/checklists/{$checklist['id']}", [
                        'key' => $this->apiKey,
                        'token' => $this->token,
                    ]);
                }
            }
            // Buat checklist baru per kategori
            foreach ($checklistGroups as $group) {
                if (empty($group['items'])) continue;
                $response = Http::post($this->baseUrl . '/checklists', [
                    'name' => $group['category'] ?: 'Checklist',
                    'idCard' => $cardId,
                    'key' => $this->apiKey,
                    'token' => $this->token,
                ]);
                if ($response->successful()) {
                    $checklistData = $response->json();
                    foreach ($group['items'] as $item) {
                        $itemResponse = Http::post($this->baseUrl . "/checklists/{$checklistData['id']}/checkItems", [
                            'name' => $item['name'],
                            'key' => $this->apiKey,
                            'token' => $this->token,
                        ]);
                        if (!empty($item['checked']) && $itemResponse->successful()) {
                            $checkItemId = $itemResponse->json()['id'];
                            Http::put($this->baseUrl . "/cards/{$cardId}/checkItem/{$checkItemId}", [
                                'state' => 'complete',
                                'key' => $this->apiKey,
                                'token' => $this->token,
                            ]);
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error('Error saat sync checklist Trello', ['error' => $e->getMessage()]);
        }
    }

    public function addAttachmentToCard($cardId, $url, $name = null)
    {
        try {
            $payload = [
                'url' => $url,
                'key' => $this->apiKey,
                'token' => $this->token,
            ];
            if ($name) {
                $payload['name'] = $name;
            }
            $response = Http::post($this->baseUrl . "/cards/{$cardId}/attachments", $payload);
            return $response->successful();
        } catch (\Exception $e) {
            Log::error('Error saat menambah attachment ke Trello', ['error' => $e->getMessage()]);
            return false;
        }
    }
}
