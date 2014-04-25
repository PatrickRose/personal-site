<?php
/**
 * An helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace {
/**
 * Tag
 *
 * @property integer $id
 * @property string $tag
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Blog[] $posts
 * @method static \Illuminate\Database\Query\Builder|\Tag whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Tag whereTag($value) 
 * @method static \Illuminate\Database\Query\Builder|\Tag whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Tag whereUpdatedAt($value) 
 */
	class Tag {}
}

namespace {
/**
 * Created by PhpStorm.
 * 
 * User: patrick
 * Date: 18/04/14
 * Time: 22:14
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $slug
 * @property-read \Illuminate\Database\Eloquent\Collection|\Tag[] $tags
 * @method static \Illuminate\Database\Query\Builder|\Blog whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Blog whereTitle($value) 
 * @method static \Illuminate\Database\Query\Builder|\Blog whereContent($value) 
 * @method static \Illuminate\Database\Query\Builder|\Blog whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Blog whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Blog whereSlug($value) 
 */
	class Blog {}
}

namespace {
/**
 * User
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\User whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\User whereUsername($value) 
 * @method static \Illuminate\Database\Query\Builder|\User wherePassword($value) 
 * @method static \Illuminate\Database\Query\Builder|\User whereRememberToken($value) 
 * @method static \Illuminate\Database\Query\Builder|\User whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\User whereUpdatedAt($value) 
 */
	class User {}
}

