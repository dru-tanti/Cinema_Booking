<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Film_model extends CI_Model
{
    public function create_film($title, $runtime, $release, $categories)
    {
        // Create a slug and confirmes that a category has been selected
        $slug = url_title($title, 'dash', TRUE);
        if ($categories == NULL) $categories = [];

        // A Transaction is used to make sure that no incomplete information is submitted.
        $this->db->trans_start();

            $film = [
                'title'     => $title,
                'slug'      => $slug,
                'runtime'   => $runtime,
                'release'   => $release
            ];

            $this->db->insert('tbl_films', $film);
            $insert_id = $this->db->insert_id();

            // Since multiple categories can be chosen, we'll need a loop.
            if (count($categories) > 0)
            {
                $inserts = [];
                foreach ($categories as $cat)
                {
                    $inserts [] = [
                        'film_id'       => $insert_id,
                        'category_id'   => $cat
                    ];
                }
                $this->db->insert_batch('tbl_film_category', $inserts);
            }

        // The query is complete
        $this->db->trans_complete();

        // If the query was not successful, do not register anything in the database.
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        }
        else
        {
            $this->db->trans_commit();
            return $insert_id;
        }
    }


    // Retrieve the list of categories as an array.
    public function get_categories()
    {
        return $this->db->get('tbl_categories')->result_array();
    }

    // Retrieve a list of categories as an [id = name] array.
    public function get_categories_array()
    {
        // use a defined function to get the rows we need.
        $results = $this->get_categories();
        $categories = [];

        // fill in the blank array using a foreach loop.
        foreach ($results as $row) $categories[$row['id']] = $row['name'];
        return $categories;
    }

    // Retrieves the categories for an film
    public function get_film_categories($film_id)
    {
        $results = $this->db->select('category_id')
        ->get_where('tbl_film_category', ['id' => $film_id])
        ->result_array();

        $ids = [];
        foreach ($results as $row) $ids[] = $row['category_id'];

        return $ids;
    }

    // Retrieves all the films in the database.
    public function get_films()
    {
        return $this->db->select('title')
                        ->get('tbl_films')
                        ->result_array();
    }
}
