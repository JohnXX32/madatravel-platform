# Domaine

Fuseau Indian/Antananarivo. Montants en Ariary entier.

Entités : Location, Vehicle, Driver, Tour, Lead, Booking, Quote, Setting.

Booking confirmed|active bloque le véhicule si start_on <= other.end_on AND end_on >= other.start_on.

Tarif MVP : jours = max(1, end-start) ; total = daily*jours + chauffeur + frais lieux.
