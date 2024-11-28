<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vote;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Image;
use MoonShine\Fields\Checkbox;
use App\Models\Candidate;
use MoonShine\Handlers\ExportHandler;
use App\Enums\StatusEnum;
use MoonShine\Fields\Enum;


/**
 * @extends ModelResource<Vote>
 */
class VoteResource extends ModelResource
{
    protected string $model = Vote::class;

    protected string $title = 'Votes';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                BelongsTo::make(
                    'Alumno',
                    'student',
                    fn($item) => "$item->nombres"
                )->searchable()
                ->showOnExport(),

                BelongsTo::make(
                    'Elecciones',
                    'election',
                    fn($item) => "$item->año_academico"
                )->searchable()
                ->showOnExport(),
                BelongsTo::make('Candidato', 'candidate', Candidate::class)
                ->withImage('simbolo', 'public', 'simbolos')
                ->showOnExport(),
                Image::make('Simbolo','candidate.simbolo')
                    ->disk('public')
                    ->dir('simbolos')
                    ->readonly() // Solo lectura
                    ->hideOnForm(), // Oculto en formularios
                Checkbox::make('Votacion', 'is_blank_vote')
                    ->onValue('en blanco')
                    ->offValue('voto')
                    ->showOnExport(),
            ]),
        ];
    }

    /**
     * @param Vote $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
