<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * Связанная с моделью таблица.
     *
     * @var string
     */
    protected $table = 'articles';

    /**
     * Атрибуты, для которых разрешено массовое назначение.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'heading_id'
    ];

    /**
     * Атрибуты, которые должны быть приведены к нативным типам.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'heading_id' => 'integer'
    ];

    /**
     * Пользователь
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Рубрика
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function heading()
    {
        return $this->belongsTo(Heading::class);
    }

    /**
     * Тэги
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags');
    }

    /**
     * Комментарии
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Ревизии
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function revisions()
    {
        return $this->hasMany(Revision::class)->withoutGlobalScopes(['current']);
    }

    /**
     * Текущая ревизия
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function current_revision()
    {
        return $this->hasOne(Revision::class);
    }
}
