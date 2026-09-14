<?php

namespace App\Services;

use App\Models\Lead;
use App\Models\Setting;

class WhatsAppLinkService
{
    public function forLead(Lead $lead): string
    {
        $number = preg_replace('/\D+/', '', (string) Setting::getValue('whatsapp_number', '261320000000'));
        $text = $this->message($lead);

        return 'https://wa.me/'.$number.'?text='.rawurlencode($text);
    }

    public function message(Lead $lead): string
    {
        $start = $lead->start_on?->format('d/m/Y');
        $end = $lead->end_on?->format('d/m/Y');
        $driver = $lead->with_driver ? 'avec chauffeur' : 'sans chauffeur';
        $subject = $lead->type === 'tour'
            ? ($lead->tour?->title_fr ?? 'un circuit')
            : ($lead->vehicle?->displayName() ?? 'un véhicule');
        $pickup = $lead->pickupLocation?->name ?? 'à préciser';

        if ($lead->locale === 'en') {
            $driver = $lead->with_driver ? 'with driver' : 'self-drive';
            return "Hello MadaTravel, I would like {$subject} from {$start} to {$end}, pickup {$pickup}, {$driver}. Name: {$lead->customer_name}.";
        }

        return "Bonjour MadaTravel, je souhaite {$subject} du {$start} au {$end}, prise en charge {$pickup}, {$driver}. Nom : {$lead->customer_name}.";
    }
}
