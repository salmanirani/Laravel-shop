<?php

namespace App;

use App\Wishlists;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function photo()
    {
        return $this->belongsTo(Photo::class);

    }
    public function ports()
    {
        return $this->hasMany(Port::class);

    }


    public function photos()
    {
        return $this->hasMany(Photo::class);

    }
    public function postal()
    {
        return $this->hasMany(Postal::class);

    }
    public function deliveries()
    {
        return $this->hasMany(Delivery::class);

    }

    public function maps()
    {
        return $this->hasMany(Map::class);

    }
    public function warehouses()
    {
        return $this->hasMany(Warehouse::class);

    }
    public function wishlist()
    {
        return $this->hasMany(Wishlists::class);

    }
    public function shops()
    {
        return $this->hasMany(Shop::class);

    }

    public function isAdmin()
    {
        foreach ($this->roles as $role) {
            if ($role->name == 'مدیر' && $this->status == 1) {
                return true;
            }
        }
        return false;
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function instagram()
    {
        return $this->hasMany(Instagram::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class);
    }

    public function orders()
    {
//        هر کاربر چندین سفارش داره
        return $this->hasMany(Order::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
  public function mtcomments()
    {
        return $this->hasMany(Mtcomment::class);
    }

    public function settings()
    {
        return $this->hasMany(Setting::class);
    }

    public function domains()
    {
        return $this->hasMany(Domain::class);
    }
    public function slider()
    {
        return $this->hasMany(Slider::class);

    }
    public function medals()
    {
        return $this->hasMany(Medal::class);

    }

    public function sizecolorcart()
    {
        return $this->hasMany(SizeColorCart::class);

    }
    public function carts()
    {
        return $this->hasMany(Cart::class);

    }

}
