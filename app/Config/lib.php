<?php
    use App\Models\Blog;

    function getAllTags() {
        $allTags = [];

        foreach (Blog::all() as $blog) {
            foreach (explode(", ", $blog->tags) as $tag) {
                if (!in_array($tag, $allTags)) $allTags[] = $tag;
            }
        }

        return $allTags;
    }
    
    function countTag($tag) {
        $count = 0;
        foreach (Blog::all() as $blog) {
            if (in_array($tag, explode(", ", $blog->tags))) $count++;
        }
        return $count;
    }

    function printTags() {
        $tags = "";
        foreach (getAllTags() as $tag) {
            if (countTag($tag) >= 5) {
                $tags .= "<span class=\"weight-5\">".$tag."</span><br>";
            } else $tags .= "<span class=\"weight-".countTag($tag)."\">".$tag."</span><br>";            
        }

        return $tags;
    }

    function getAllComments($blogs) {
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
    