<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Number;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

class Coa extends Resource
{
	public static $globallySearchable = true;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Coa';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Name', 'product_name')->sortable()->rules('required', 'max:50'),
			Text::make('Number', 'coa_number')->sortable()->rules('required', 'max:50'),
	//		Text::make('File Name', 'coa_name')->sortable()->rules('required', 'max:50'),
			Text::make('Original Name', 'original_name')->sortable(),
			Date::make('Created at')->sortable(),
     //       File::make('Coa File', 'coa_name')->disk('s3')->storeOriginalName(),
            File::make('Coa File', 'coa_name')
                ->store(function (Request $request, $coa) {
                    return [
                        'coa_name' => $request->coa_name->store('/', 's3'),
                        'original_name' => $request->coa_name->getClientOriginalName(),
                    ];
                })
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
