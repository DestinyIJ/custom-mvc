<?php 
    use Illuminate\Database\Eloquent\Model as Eloquent;

    class User extends Eloquent
    {
        protected $table = 'users';

        public $name;

        protected $fillable = [
            'name',
            'email'
        ];
    }