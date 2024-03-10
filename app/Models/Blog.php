<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model as Eloquent;
    use App\Models\Comment;

    class Blog extends Eloquent{
        protected $table = "blog";
        const CREATED_AT = "created";
        const UPDATED_AT = "updated";
        protected $fillable = ["id", "title", "author", "blog", "image", "tags", "created", "updated"];

        public function comment() {
            return $this->hasMany(Comment::class);
        }

        public function getComments() {
            $comments = [];
            foreach (Blog::find($this->id)->comment as $comment) {
                $comments[] = $comment;
            }
            return $comments;
        }

        public function numComments() {
            return count(Blog::find($this->id)->comment);        
        }

        public static function getAllTags() {
            $allTags = [];
    
            foreach (Blog::all() as $blog) {
                foreach (explode(", ", $blog->tags) as $tag) {
                    if (!in_array($tag, $allTags)) $allTags[] = $tag;
                }
            }
    
            return $allTags;
        }
        
        public static function countTag($tag) {
            $count = 0;
            foreach (Blog::all() as $blog) {
                if (in_array($tag, explode(", ", $blog->tags))) $count++;
            }
            return $count;
        }
    
        public static function printTags() {
            $tags = "";
            foreach (Blog::getAllTags() as $tag) {
                if (Blog::countTag($tag) >= 5) {
                    $tags .= "<span class=\"weight-5\">".$tag."</span><br>";
                } else $tags .= "<span class=\"weight-".Blog::countTag($tag)."\">".$tag."</span><br>";            
            }
    
            return $tags;
        }
    
        public static function getAllComments($blogs) {
            $allComments = [];
            foreach ($blogs as $blog) {
                foreach ($blog->comment as $comment) {
                    $allComments[] = [
                        'comment' => $comment->comment,
                        'user' => $comment->user,
                        'created' => $comment->created, // Convertir la fecha a un formato de timestamp
                        'blogId' => $blog->id,
                        'blogTitle' => $blog->title,
                    ];
                }
            }
    
            usort($allComments, function ($a, $b) {
                return strtotime($a['created']) - strtotime($b['created']);
            });
    
            return $allComments;
        }
    }
