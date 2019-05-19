<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Screening_model extends CI_Model
{
    public function create_screening($time, $film, $cinema)
    {
        $this->db->trans_start();

        $screenings = [
            'time'           => $time,
            'film_id'        => $film,
            'cinema_id'      => $cinema
        ];

        $this->db->insert('tbl_screenings', $screenings);
        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE)
        {
         $this->db0>trans_rollback();
         return FALSE;
        } else {
         $this->db->trans_commit();
         return $insert_id;
        }
    }

    public function get_screenings()
    {
        return $this->db->select('*')
                        ->join('tbl_films', 'tbl_films.id = tbl_screenings.film_id')
                        ->join('tbl_cinema', 'tbl_cinema.id = tbl_screenings.cinema_id')
                        ->get('tbl_screenings')
                        ->result_array();
    }

    public function get_film_screenings($slug)
    {
        // Retrieves the film we are looking for from the slug and finds it's ID
        $film = $this->film_model->get_film($slug);
        $id = $film['id'];

        return $this->db->select('*')
                        ->join('tbl_films', 'tbl_films.id = tbl_screenings.film_id')
                        ->join('tbl_cinema', 'tbl_cinema.id = tbl_screenings.cinema_id')
                        ->get_where('tbl_screenings', ['film_id' => $id])
                        ->result_array();
    }
}
