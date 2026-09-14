<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeadRequest;
use App\Models\Lead;
use App\Services\WhatsAppLinkService;
use Illuminate\Http\RedirectResponse;

class LeadController extends Controller
{
    public function store(StoreLeadRequest $request, WhatsAppLinkService $whatsApp): RedirectResponse
    {
        $lead = Lead::query()->create($request->validated());
        $lead->load(['vehicle', 'tour', 'pickupLocation']);

        return redirect()->away($whatsApp->forLead($lead));
    }
}
