<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Revision extends Model
{
    /**
     * Связанная с моделью таблица.
     *
     * @var string
     */
    protected $table = 'revisions';

    /**
     * Атрибуты, для которых разрешено массовое назначение.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'is_current',
        'article_id'
    ];

    /**
     * Атрибуты, которые должны быть приведены к нативным типам.
     *
     * @var array
     */
    protected $casts = [
        'is_current' => 'boolean',
        'article_id' => 'integer'
    ];

    /**
     * "Загружающий" метод модели.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        //получаем только текущую ревизию
        static::addGlobalScope('current', function (Builder $builder) {
            $builder->where('is_current', 1);
        });
    }

    /**
     * Запись
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
