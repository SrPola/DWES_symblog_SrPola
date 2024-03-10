<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model as Eloquent;
    use App\Models\Comment;

    class Users extends Eloquent{
        protected $table = "users";
        const CREATED_AT = "created";
        const UPDATED_AT = "updated";
        protected $fillable = ["id", "user", "password", "email", "profile", "tags", "created", "updated"];

        public function comment() {
            return $this->hasMany(Comment::class);
        }

        public function getComments() {
            return $this->comments;
        }

        public function numComments() {
            return $this->comments ? count($this->comments) : 0;        
        } 
    }
