use App\Http\Controllers\TrelloWebhookController;

Route::post('/trello/webhook', [TrelloWebhookController::class, 'handle']);
Route::get('/trello/webhook', [TrelloWebhookController::class, 'verify']); // Untuk verifikasi webhook Trello
