<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Election;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Date;
use MoonShine\Fields\Enum;
use App\Enums\EstadoEnum;
use MoonShine\Fields\Number;

/**
 * @extends ModelResource<Election>
 */
class ElectionResource extends ModelResource
{
    protected string $model = Election::class;

    protected string $title = 'Elections';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Number::make('Año academico', 'año_academico'),
                Enum::make('Estado', 'estado')
                ->attach(EstadoEnum::class)
                ->default(EstadoEnum::A->value),
            ]),
        ];
    }

    /**
     * @param Election $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
