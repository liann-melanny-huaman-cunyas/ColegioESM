<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Fields\Number;
use MoonShine\Fields\Enum;
use App\Enums\StateEnum;


/**
 * @extends ModelResource<Student>
 */
class StudentResource extends ModelResource
{
    protected string $model = Student::class;

    protected string $title = 'Students';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
            ID::make()->sortable(),
            BelongsTo::make(
                'Salon',
                'classroom',
                fn($item) => "$item->grade - $item->section"
            )->searchable(),

            // Campo para mostrar el grado del salón seleccionado
            Text::make('Grado', 'classroom.grade')
                ->readonly() // Solo lectura
                ->hideOnForm(), // Oculto en formularios

            // Campo para mostrar la sección del salón seleccionado
            Text::make('Sección', 'classroom.section')
                ->readonly() // Solo lectura
                ->hideOnForm(),
            Number::make('DNI', 'dni')
                ->required()
                ->placeholder('N° de DNI'),
            Text::make('Nombre', 'nombres')
                ->showOnExport(),
            Text::make('Apellido Paterno', 'apellido_paterno')
                ->showOnExport(),
            Text::make('Apellido Materno', 'apellido_materno')
                ->showOnExport(),
            Enum::make('Estado de Matrícula', 'estado_matricula')
            ->attach(StateEnum::class)
            ->default(StateEnum::DEFINITIVA->value),

            ]),
        ];
    }

    /**
     * @param Student $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
