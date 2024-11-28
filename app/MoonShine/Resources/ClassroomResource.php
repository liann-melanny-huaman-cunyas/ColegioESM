<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Classroom;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Text;
use MoonShine\Fields\Select;
use App\Enums\GradeEnum;
use App\Enums\SectionEnum;
use MoonShine\Fields\Enum;


/**
 * @extends ModelResource<Classroom>
 */
class ClassroomResource extends ModelResource
{
    protected string $model = Classroom::class;

    protected string $title = 'Classrooms';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Enum::make('Grado', 'grade')
                    ->attach(GradeEnum::class)
                    ->default(GradeEnum::FIRST->value),
                Enum::make('Sección', 'section')
                    ->attach(SectionEnum::class)
                    ->default(SectionEnum::A->value),
            ]),
        ];
    }

    /**
     * @param Classroom $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
