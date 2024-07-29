<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use App\Models\SiteSetting;

class SystemController extends Controller
{

    public function index()
    {
        $siteSettings = SiteSetting::firstOrFail();
        return view('admin.system-settings.index', compact('siteSettings'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'instagram' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
        ]);

        $siteSetting = SiteSetting::find($id); 
        $siteSetting->update([
            'site_name' => $request->input('site_name'),
            'site_description' => $request->input('site_description'),
            'instagram' => $request->input('instagram'),
            'twitter' => $request->input('twitter'),
            'facebook' => $request->input('facebook'),
            'linkedin' => $request->input('linkedin'),
        ]);

        return redirect()->back()->with('success', 'Pengaturan umum sistem berhasil diperbarui!');
    }


    public function generalSettings()
    {
        $siteSettings = SiteSetting::firstOrFail();
        return view('admin.system-settings.general', compact('siteSettings'));
    }

    public function backupRestore()
    {
        $siteSettings = SiteSetting::firstOrFail();
        return view('admin.system-settings.backup-restore' , compact('siteSettings'));
    }

    public function backup()
    {
        Artisan::call('backup:run');
        return redirect()->back()->with('success', 'Backup created successfully!');
    }

    public function restore(Request $request)
    {
        $request->validate([
            'backup_file' => 'required|file'
        ]);

        $backupPath = $request->file('backup_file')->store('backups');

        $backupFile = storage_path('app/' . $backupPath);

        if (File::exists($backupFile)) {

            // Artisan::call('database:restore', ['--file' => $backupFile]);

            $dbName = env('DB_DATABASE');
            $dbUser = env('DB_USERNAME');
            $dbPassword = env('DB_PASSWORD');
            $command = "mysql -u {$dbUser} -p{$dbPassword} {$dbName} < {$backupFile}";

            $output = null;
            $returnVar = null;

            exec($command, $output, $returnVar);

            if ($returnVar === 0) {
                return redirect()->back()->with('success', 'Restore completed successfully!');
            } else {
                return redirect()->back()->with('error', 'Restore failed. Please check the backup file and try again.');
            }
        } else {
            return redirect()->back()->with('error', 'Backup file not found. Please check the file and try again.');
        }
    }

}
