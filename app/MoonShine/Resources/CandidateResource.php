<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Candidate;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Fields\Image;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Date;


/**
 * @extends ModelResource<Candidate>
 */
class CandidateResource extends ModelResource
{
    protected string $model = Candidate::class;

    protected string $title = 'Candidatos';

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
                    fn($item) => "$item->id. $item->nombres"
                )->searchable(),
                // Campo para mostrar el grado del salón seleccionado
                Text::make('DNI', 'student.dni')
                    ->readonly() // Solo lectura
                    ->hideOnForm(), // Oculto en formularios
                Image::make('Simbolo','simbolo')
                    ->disk('public')
                    ->dir('simbolos'),
                Switcher::make('Estado', 'estado'),
                Date::make('Inscripcion', 'fecha_inscripcion')
                    ->format('d.m.Y')

            ]),
        ];
    }

    /**
     * @param Candidate $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
