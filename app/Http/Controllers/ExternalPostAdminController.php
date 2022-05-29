<?php

namespace App\Http\Controllers;

use App\Models\Enums\ExternalPostStatus;
use App\Models\ExternalPost;

class ExternalPostAdminController
{
    public function index()
    {
        $pending = ExternalPost::query()
            ->where('status', ExternalPostStatus::PENDING())
            ->orderByDesc('date')
            ->get();

        $active = ExternalPost::query()
            ->where('status', ExternalPostStatus::ACTIVE())
            ->orderByDesc('date')
            ->paginate(20);

        return view('externalPostAdmin.index', [
            'pending' => $pending,
            'active' => $active,
        ]);
    }

    public function approve(ExternalPost $externalPost)
    {
        $externalPost->update([
            'status' => ExternalPostStatus::ACTIVE(),
        ]);

        return redirect()->action([self::class, 'index']);
    }

    public function remove(ExternalPost $externalPost)
    {
        $externalPost->delete();

        return redirect()->action([self::class, 'index']);
    }
}
