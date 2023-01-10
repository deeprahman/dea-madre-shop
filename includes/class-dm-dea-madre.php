<?php

final class DM_Dea_Madre
{
    public function main()
    {
        
        DM_Home_Page::init();
        DM_Shop_Page::init();

        
    }

    public function afterSetupTheme()
    {
        $this->createPosts('home');
        $this->createPosts('shop');
    }


    public function createPosts(string $title_of_the_page ): int
    {
        if (
            $page_obj = get_page_by_title(
                $title_of_the_page,
                'OBJECT',
                'page'
            )
        ) {
            return $page_obj->ID;
        }

        $page_id = wp_insert_post(
            array(
                'comment_status' => 'close',
                'ping_status'    => 'close',
                'post_author'    => 1,
                'post_title'     => ucwords($title_of_the_page),
                'post_name'      => strtolower(str_replace(' ', '-', trim($title_of_the_page))),
                'post_status'    => 'publish',

                'post_type'      => 'page',
//'id_of_the_parent_page_if_it_available'
            )
        );
        
        return $page_id;
    }
}
