<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSocialLinkRequest;
use App\Models\SocialLink;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SocialLinkController extends Controller
{
    public function edit(): View
    {
        $socialLink = SocialLink::query()->firstOrNew();

        return view('admin.social-links.edit', compact('socialLink'));
    }

    public function update(UpdateSocialLinkRequest $request): RedirectResponse
    {
        SocialLink::query()->firstOrNew()->fill($request->validated())->save();

        return redirect()
            ->route('admin.social-links.edit')
            ->with('success', 'Ijtimoiy tarmoqlar muvaffaqiyatli yangilandi.');
    }
}
