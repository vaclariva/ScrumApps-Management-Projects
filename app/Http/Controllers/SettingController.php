<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Setting\UpdateSMTPRequest;
use Spatie\DbDumper\Databases\MySql as DBDumper;
use App\Http\Requests\Setting\UpdateTwoFactorRequest;

class SettingController extends Controller
{
    /**
     * Define properties.
     */
    protected Setting $setting;

    /**
     * Define contruct.
     */
    public function __construct()
    {
        $this->setting = Setting::first();
    }

    /** =================================
     * TWO FACTOR SETTINGS
    ==================================== */

    /**
     * Show the page for two factor settings.
     */
    public function showTwoFactorPage(): View
    {
        try {
            return view('setting.two-factor', [
                'enabled_2fa' => auth()->user()->enabled_2fa ? true : false,
            ]);
        } catch (\Throwable $th) {
            info($th);

            abort(500);
        }
    }

    /**
     * Update two factor settings.
     */
    public function updateTwoFactor(UpdateTwoFactorRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            auth()->user()->update($request->validated());

            if (! auth()->user()->enabled_2fa) {
                auth()->user()->twoFactors()->delete();
            }


            DB::commit();

            return response()->json([
                'message' => trans('admin.update-success'),
                'redirect' => route('settings.twofactors.index'),
            ]);
        } catch (\Throwable $th) {
            info($th);
            DB::rollBack();

            return response()->json([
                'message' => trans('admin.update-failed'),
            ], 500);
        }
    }


    /** =================================
     * SMTP EMAIL SETTINGS
    ==================================== */

    /**
     * Show the page for smtp settings.
     */
    public function showSMTPPage(): View
    {
        try {
            return view('setting.email-host', [
                'setting' => $this->setting,
            ]);
        } catch (\Throwable $th) {
            info($th);

            abort(500);
        }
    }

    /**
     * Update SMTP settings.
     */
    public function updateSMTP(UpdateSMTPRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $setting = $this->setting->update($request->validated());

            // Perbarui smtp_port berdasarkan type_of_encryption
            if ($request->type_of_encryption == 'tls') {
                $this->setting->update(['smtp_port' => '587']);
            } else {
                $this->setting->update(['smtp_port' => '465']);
            }

            DB::commit();

            return response()->json([
                'message' => trans('admin.update-success'),
                'redirect' => route('settings.smtps.index'),
            ]);
        } catch (\Throwable $th) {
            info($th);
            DB::rollBack();

            return response()->json([
                'message' => trans('admin.update-failed'),
            ], 500);
        }
    }

    /** =================================
     * SMTP EMAIL SETTINGS
    ==================================== */

    /**
     * Show the page for smtp settings.
     */
    public function databaseBackupPage(): View
    {
        try {
            return view('setting.database-backup');
        } catch (\Throwable $th) {
            info($th);

            abort(500);
        }
    }

    /**
     * for download database backup.
     */
    public function databaseBackupDownload()
    {
        try {

            $dbName = config('app.name').'_'.now()->format('d_m_y_H_i_s').'.sql';
            $backupPath = Storage::path($dbName);

            DBDumper::create()
                ->setDbName(config('database.connections.mysql.database'))
                ->setUserName(config('database.connections.mysql.username'))
                ->setPassword(config('database.connections.mysql.password'))
                ->setHost(config('database.connections.mysql.host'))
                ->setPort(config('database.connections.mysql.port'))
                ->dumpToFile($backupPath);

            return response()->download($backupPath)->deleteFileAfterSend(true);

        } catch (\Throwable $th) {
            info($th);

            abort(500);
        }
    }

}
