<?php

namespace App\Enums;

enum PublicationType: string
{
    case ScientificArticle = 'scientific_article';
    case Abstract = 'abstract';
    case Dissertation = 'dissertation';

    public function label(): string
    {
        return match ($this) {
            self::ScientificArticle => 'Ilmiy maqolalar',
            self::Abstract => 'Avtoreferatlar',
            self::Dissertation => 'Dissertatsiyalar',
        };
    }
}
