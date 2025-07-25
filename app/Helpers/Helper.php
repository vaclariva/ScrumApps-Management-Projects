<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use ZipStream\Exception\FileNotFoundException;
use App\Models\Setting;

class Helper
{
    /**
     * Cek apakah email host sudah dikonfigurasi
     *
     * @return bool
     */
    public static function isEmailHostConfigured(): bool
    {
        try {
            $setting = Setting::first();

            return $setting &&
                   $setting->smtp_host &&
                   $setting->smtp_username &&
                   $setting->smtp_password &&
                   $setting->mail_from_address &&
                   $setting->from_name;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * Dapatkan pesan error jika email host belum dikonfigurasi
     *
     * @return string
     */
    public static function getEmailHostNotConfiguredMessage(): string
    {
        return 'Email host belum dikonfigurasi. Silakan atur konfigurasi email terlebih dahulu di menu Email Host.';
    }
}

if (! function_exists('formatDate')) {
    /**
     * Custom format date
     *
     * @param  string  $date
     * @param  string  $format
     * @return string
     */
    function formatDate($date, $format)
    {
        if (! $date) {
            return '';
        }

        return Carbon::parse($date)->translatedFormat($format);
    }
}

if (! function_exists('formatFromTo')) {
    /**
     * Format date to time stamp
     *
     * @param  string  $date
     * @param  string  $format_from
     * @param  string  $format_to
     * @return string
     */
    function formatFromTo($date, $format_from, $format_to)
    {
        if (! $date) {
            return '';
        }

        try {
            $date = Carbon::createFromLocaleFormat($format_from, config('app.locale'), $date)->translatedFormat($format_to);

            return $date;
        } catch (\Throwable $th) {
            return '';
        }
    }
}

if (! function_exists('smallestNumberNotInArray')) {
    /**
     * Mencari angka terkecil yang tidak ada dalam array
     */
    function smallestNumberNotInArray($array)
    {
        $flippedArray = array_flip($array);

        for ($i = 1; isset($flippedArray[$i]); $i++);

        return $i;
    }
}

if (! function_exists('rupiah')) {
    /**
     * @param  float  $angka
     * @param  bool  $prefix
     * @return string
     */
    function rupiah($angka, $prefix = true)
    {
        if (is_null($angka) || is_string($angka)) {
            return null;
        }

        if ($prefix) {
            $hasil_rupiah = 'Rp '.number_format($angka, 0, ',', '.');

            return $hasil_rupiah;
        }

        $hasil_rupiah = number_format($angka, 0, ',', '.');

        return $hasil_rupiah;
    }
}

if (! function_exists('limit_words')) {
    /**
     * @param  float  $angka
     * @param  bool  $prefix
     * @return string
     */
    function limit_words($string, $word_limit)
    {
        $string = strip_tags($string);
        $words = explode(' ', strip_tags($string));
        $return = trim(implode(' ', array_slice($words, 0, $word_limit)));

        if (strlen($return) < strlen($string)) {
            $return .= ' ...';
        }

        return $return;
    }
}

if (! function_exists('limit_characters')) {
    /**
     * Limit characters function.
     */
    function limit_characters(?string $string, int $start, int $end, string $placeholder = '...')
    {
        return $string
        ? mb_strimwidth($string, $start, $end, $placeholder)
        : '-';
    }
}

if (!function_exists('trimDecimalZero')) {
    function trimDecimalZero($number)
    {
        $exploadValue = explode('.', $number);

        if (count($exploadValue) > 1) {
            if (rtrim($exploadValue[1], '0') == '') {
                return $exploadValue[0];
            }

            return $exploadValue[0] . '.' . rtrim($exploadValue[1], '0');
        }

        return $exploadValue[0];
    }
}

if (!function_exists('listDays')) {
    function listDays()
    {
        return ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    }
}

if (!function_exists('translatedDays')) {
    function translatedDays()
    {
        return ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Minggu'];
    }
}

if (!function_exists('mappingDays')) {
    function mappingDays()
    {
        return ['monday' => 'Senin', 'tuesday' => 'Selasa', 'wednesday' => 'Rabu', 'thursday' => 'Kamis' , 'friday' => 'Jum\'at', 'saturday' => 'Sabtu', 'sunday' => 'Minggu'];
    }
}

if (!function_exists('mappingDaysShort')) {
    function mappingDaysShort()
    {
        return ['monday' => 'Sen', 'tuesday' => 'Sel', 'wednesday' => 'Rab', 'thursday' => 'Kam' , 'friday' => 'Jum', 'saturday' => 'Sab', 'sunday' => 'Mgg'];
    }
}

if (!function_exists('translateDayNameENToID')) {
    /**
     * Convert English day name to Indonesian day name.
     *
     * @param string $dayName
     * @return string
     */
    function translateDayNameENToID($dayName)
    {
        $days = [
            'sunday' => 'minggu',
            'monday' => 'senin',
            'tuesday' => 'selasa',
            'wednesday' => 'rabu',
            'thursday' => 'kamis',
            'friday' => 'jum\'at',
            'saturday' => 'sabtu',
        ];

        return $days[$dayName] ?? $dayName;
    }
}

if (!function_exists('listRoles')) {
    function listRoles()
    {
        return ['BusinessAnalyst', 'TeamDeveloper'];
    }
}

if (!function_exists('formatNumberId')) {
    /**
     * Format number to Indonesian standard with thousand separator and decimal point.
     * Trims trailing zeros from decimals.
     *
     * @param float|int $number
     * @param int $decimals
     * @return string
     */
    function formatNumberId($number, $decimals = 2): string
    {
        // Format awal dengan pemisah ribuan dan desimal
        $formatted = number_format($number, $decimals, ',', '.');

        // Pisahkan bagian desimal dengan bagian bilangan bulat
        [$integerPart, $decimalPart] = explode(',', $formatted);

        // Trim jika desimalnya 0 atau perlu dikurangi
        if ((int)$decimalPart === 0) {
            return $integerPart; // Jika desimalnya 0, hanya kembalikan bagian bilangan bulat
        }

        // Hapus trailing zero dari desimal, jika ada
        $decimalPart = rtrim($decimalPart, '0');

        // Gabungkan kembali bilangan bulat dan desimal (jika ada)
        return $integerPart . ',' . $decimalPart;
    }
}

