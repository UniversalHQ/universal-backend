<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;
use Illuminate\Support\Arr;

abstract class Resource extends JsonResource
{
    /**
     * Keeps track of the current mode.
     *
     * @var string
     */
    public static $mode = [];

    /**
     * Keeps track of the current presentation.
     *
     * @var string
     */
    public static $presentation = [];

    abstract public function data(Request $request): array;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        if (is_null($this->resource)) {
            return [
                'resource' => class_basename($this),
            ];
        }

        if (is_array($this->resource)) {
            return array_merge($this->resource, [
                'resource' => class_basename($this),
            ]);
        }

        return [
            'id'       => $this->id,
            'resource' => class_basename($this),

            $this->merge($this->data($request)),

            'created_at' => $this->created_at->timestamp ?? null,
            'updated_at' => $this->updated_at->timestamp ?? null,
            'deleted_at' => $this->deleted_at->timestamp ?? new MissingValue(),
        ];
    }

    /**
     * Set the current mode for this resource.
     *
     * @param $presentation
     *
     * @return JsonResource
     */
    public static function present($presentation)
    {
        static::$presentation[static::class] = $presentation;
        return new static([]);
    }

    /**
     * Create new anonymous resource collection.
     *
     * @param mixed $resource
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public static function collection($resource)
    {
        static::$mode[static::class] = 'collection';

        return parent::collection($resource);
    }

    /**
     * Merge a value when in resource mode
     *
     * @param mixed $value
     *
     * @return \Illuminate\Http\Resources\MergeValue|mixed
     */
    public function mergeWhenResource($value)
    {
        return $this->mergeWhen((static::$mode[static::class] ?? null) != 'collection', $value);
    }

    /**
     * Merge a value when in collection mode
     *
     * @param mixed $value
     *
     * @return \Illuminate\Http\Resources\MergeValue|mixed
     */
    public function mergeWhenCollection($value)
    {
        return $this->mergeWhen((static::$mode[static::class] ?? null) == 'collection', $value);
    }

    /**
     * Merge a value based on a given representation.
     *
     * @param mixed $presentation
     * @param mixed $value
     *
     * @return \Illuminate\Http\Resources\MergeValue|mixed
     */
    public function mergeWhenPresenting($presentation, $value)
    {
        $condition = in_array(static::$presentation[static::class] ?? null, Arr::wrap($presentation));

        return $this->mergeWhen($condition, $value);
    }

    /**
     * Merge a value based on a given condition.
     *
     * @param bool  $condition
     * @param mixed $value
     *
     * @return \Illuminate\Http\Resources\MergeValue|mixed
     */
    public function mergeUnless($condition, $value)
    {
        return $this->mergeWhen(!$condition, $value);
    }

    /**
     * Merge a value based on a given representation.
     *
     * @param mixed $presentation
     * @param mixed $value
     *
     * @return \Illuminate\Http\Resources\MergeValue|mixed
     */
    public function mergeUnlessPresenting($presentation, $value)
    {
        $condition = in_array(static::$presentation[static::class] ?? null, Arr::wrap($presentation));

        return $this->mergeUnless($condition, $value);
    }
}