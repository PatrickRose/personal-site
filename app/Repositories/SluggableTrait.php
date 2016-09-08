<?php

namespace PatrickRose\Repositories;

trait SluggableTrait {

    public function makeSlug()
    {
        $fieldToSlug = $this->getSluggableField();
        
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($this->$fieldToSlug));
        $count = static::where("slug", "LIKE", $slug)->count();
        if ($count != 0) {
            $count += 1;
            $slug .= "-{$count}";
        }

        $this->slug = $slug;
        
        return $slug;
    }

    abstract protected function getSluggableField();
}
