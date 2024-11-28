<?php

declare(strict_types=1);

namespace App\Providers;

use App\MoonShine\Resources\CandidateResource;
use App\MoonShine\Resources\ClassroomResource;
use App\MoonShine\Resources\ElectionResource;
use App\MoonShine\Resources\StudentResource;
use App\MoonShine\Resources\VoteResource;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;
use MoonShine\Contracts\Resources\ResourceContract;
use MoonShine\Menu\MenuElement;
use MoonShine\Pages\Page;
use Closure;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    /**
     * @return list<ResourceContract>
     */
    protected function resources(): array
    {
        return [];
    }

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [];
    }

    /**
     * @return Closure|list<MenuElement>
     */
    protected function menu(): array
    {
        return [
            MenuGroup::make(static fn() => __('moonshine::ui.resource.system'), [
                MenuItem::make(
                    static fn() => __('moonshine::ui.resource.admins_title'),
                    new MoonShineUserResource()
                ),
                MenuItem::make(
                    static fn() => __('moonshine::ui.resource.role_title'),
                    new MoonShineUserRoleResource()
                ),
            ]),


            MenuGroup::make('Gestión Estudiantes', [
                MenuItem::make('Salones', new ClassroomResource())->icon('heroicons.book-open'),
                MenuItem::make('Estudiantes', new StudentResource())->icon('heroicons.document-plus'),
            ])->icon('heroicons.folder'),

            MenuGroup::make('Elecciones', [
                MenuGroup::make('Gestión Candidatos', [
                    MenuItem::make('Añadir Elecciones', new ElectionResource())
                        ->icon('heroicons.outline.clipboard-document-list'),
                    MenuItem::make('Añadir Candidato', new CandidateResource())
                        ->icon('heroicons.outline.document-check'),
                ])->icon('heroicons.outline.academic-cap'),
                MenuItem::make('Resultados', new VoteResource)->icon('heroicons.user-group')->icon('heroicons.academic-cap'),
            ])
            ->icon('heroicons.pencil-square'), // Icono principal del grupo
        ];
    }

    /**
     * @return Closure|array{css: string, colors: array, darkColors: array}
     */
    protected function theme(): array
    {
        return [
            'colors' => [
                // Colores base
                'primary' => 'rgb(97, 66, 38)',          // Azul grisáceo (3D5873)
                'secondary' => 'rgb(240, 196, 62)',       // Amarillo dorado (F0C43E)
                'body' => 'rgb(97, 66, 38)',              // Marrón oscuro derivado de la paleta

                // Paleta de tonos oscuros (dark)
                'dark' => [
                    'DEFAULT' => 'rgb(61, 55, 45)',        // Marrón neutro oscuro
                    50 => 'rgb(97, 66, 38)',               // Marrón oscuro
                    100 => 'rgb(87, 59, 34)',             
                    200 => 'rgb(77, 52, 30)',             
                    300 => 'rgb(67, 45, 26)',             
                    400 => 'rgb(57, 38, 22)',             
                    500 => 'rgb(48, 32, 19)',             
                    600 => 'rgb(40, 26, 16)',             
                    700 => 'rgb(33, 21, 13)',             
                    800 => 'rgb(27, 17, 10)',             
                    900 => 'rgb(21, 13, 8)',              
                ],

                // Colores de notificación
                'success-bg' => 'rgb(240, 196, 62)',       // Amarillo dorado cálido (F0C43E)
                'success-text' => 'rgb(61, 88, 115)',      // Azul grisáceo oscuro para contraste
                'warning-bg' => 'rgb(240, 196, 62)',       // Amarillo dorado
                'warning-text' => 'rgb(61, 88, 115)',      // Azul grisáceo
                'error-bg' => 'rgb(224, 62, 65)',          // Rojo intenso (E03E41)
                'error-text' => 'rgb(255, 255, 255)',      // Blanco para contraste
                'info-bg' => 'rgb(61, 88, 115)',           // Azul grisáceo
                'info-text' => 'rgb(97, 66, 38)',          // Marrón oscuro para contraste
            ],

            'darkColors' => [
                'body' => 'rgb(48, 32, 19)',               // Marrón oscuro como fondo
                'success-bg' => 'rgb(97, 66, 38)',         // Marrón medio para mayor contraste
                'success-text' => 'rgb(240, 196, 62)',     // Amarillo cálido para texto
                'warning-bg' => 'rgb(224, 62, 65)',        // Rojo cálido
                'warning-text' => 'rgb(255, 255, 255)',    // Blanco para contraste
                'error-bg' => 'rgb(102, 38, 38)',          // Rojo oscuro
                'error-text' => 'rgb(240, 196, 62)',       // Amarillo dorado
                'info-bg' => 'rgb(61, 88, 115)',           // Azul grisáceo
                'info-text' => 'rgb(240, 196, 62)',        // Amarillo cálido para contraste
            ]
        ];
    }


}
