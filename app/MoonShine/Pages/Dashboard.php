<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use MoonShine\Pages\Page;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Decorations\Heading;
use MoonShine\Decorations\LineBreak as DecorationsLineBreak;



class Dashboard extends Page
{
    /**
     * @return array<string, string>
     */
    public function breadcrumbs(): array
    {
        return [
            '#' => $this->title()
        ];
    }

    public function title(): string
    {
        return $this->title ?: 'Tablero';
    }

    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
	{
		return [
            Heading::make('Title/Slug'),

        ];
	}
}


// <?php

// declare(strict_types=1);

// namespace App\MoonShine\Pages;

// use App\Models\Article;
// use App\Models\Comment;
// use MoonShine\Apexcharts\Components\DonutChartMetric;
// use MoonShine\Apexcharts\Components\LineChartMetric;
// use MoonShine\Components\Layout\Header;
// use MoonShine\Decorations\LineBreak as DecorationsLineBreak;
// use MoonShine\Laravel\Pages\Page;
// use MoonShine\UI\Components\Heading;
// use MoonShine\UI\Components\Layout\Column;
// use MoonShine\UI\Components\Layout\Grid;
// use MoonShine\UI\Components\Layout\LineBreak;
// use MoonShine\UI\Components\Metrics\Wrapped\ValueMetric;


// class Dashboard extends Page
// {
//     public function getBreadcrumbs(): array
//     {
//         return [
//             '#' => $this->getTitle()
//         ];
//     }

//     public function getTitle(): string
//     {
//         return 'Dashboard';
//     }

//     public function components(): array
// 	{
// 		return [
//             Header::make('Welcome to MoonShine!', 1),

//             Header::make('Demo version', 1),

//             DecorationsLineBreak::make(),

//         //     Grid::make([
//         //         Column::make([
//         //             ValueMetric::make('Articles')
//         //                 ->value(Article::query()->count()),
//         //         ])->columnSpan(6),

//         //         Column::make([
//         //             ValueMetric::make('Comments')
//         //                 ->value(Comment::query()->count()),
//         //         ])->columnSpan(6),

//         //         Column::make([
//         //             DonutChartMetric::make('Подписчики')
//         //                 ->columnSpan(6)
//         //                 ->values(['CutCode' => 10000, 'Apple' => 9999]),
//         //         ])->columnSpan(6),

//         //         Column::make([
//         //             LineChartMetric::make('Заказы')
//         //                 ->line([
//         //                     'Выручка 1' => [
//         //                         now()->format('Y-m-d') => 100,
//         //                         now()->addDay()->format('Y-m-d') => 200
//         //                     ]
//         //                 ])
//         //                 ->line([
//         //                     'Выручка 2' => [
//         //                         now()->format('Y-m-d') => 300,
//         //                         now()->addDay()->format('Y-m-d') => 400
//         //                     ]
//         //                 ], '#EC4176'),
//         //         ])->columnSpan(6)
//         //     ]),
//         ];
// 	}
// }