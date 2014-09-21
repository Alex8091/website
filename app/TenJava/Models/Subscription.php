<?php
namespace TenJava\Models;

use Eloquent;

/**
 * Class Subscription
 * @package TenJava\Models
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $gh_id
 * @property string $gh_username
 * @property string $email
 */
class Subscription extends Eloquent {
    protected $table = 'subscriptions';
    protected $guarded = ['id', 'updated_at', 'created_at'];
    protected $hidden = ['email'];
}