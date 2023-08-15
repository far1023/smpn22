<?php

  class Guru extends CI_Controller
  {
    
    function __construct()
    {
      parent::__construct();
      //checkAksesModule();
      $this->load->library('ssp');
      $this->load->model('model_guru');
    }

    function data()
    {

      // nama table
      $table      = 'tbl_guru';
      // nama PK
      $primaryKey = 'id_guru';
      // list field yang mau ditampilkan
      $columns    = array(
            //tabel db(kolom di database) => dt(nama datatable di view)
            array('db' => 'id_guru', 'dt' => 'id_guru'),
            array('db' => 'nuptk', 'dt' => 'nuptk'),
            array('db' => 'nama_guru', 'dt' => 'nama_guru'),
            array(
                'db' => 'gender',
                'dt' => 'gender',
                'formatter' => function($d) {
                  //Apabila $d bernilai L maka akan menampilkan 'Laki-Laki' apabila bernilai selain L akan menampilkan 'Perempuan'
                  return $d == 'P' ? 'Laki-Laki' : 'Perempuan';
                }
              ),
            //untuk menampilkan aksi(edit/delete dengan parameter id guru)
            array(
                  'db' => 'id_guru',
                  'dt' => 'aksi',
                  'formatter' => function($d) {
                      return anchor('guru/edit/'.$d, '<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-primary" data-placement="top" title="Edit"').' 
                      '.anchor('guru/delete/'.$d, '<i class="fa fa-times fa fa-white"></i>', 'class="btn btn-xs btn-danger" data-placement="top" title="Delete"');
                }
            )
        );

      $sql_details = array(
        'user' => $this->db->username,
        'pass' => $this->db->password,
        'db'   => $this->db->database,
        'host' => $this->db->hostname
        );

        echo json_encode(
          SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
         );

    }

    function index()
    {
      $this->template->load('template', 'guru/view');
    }

    function add()
    {
      if (isset($_POST['submit'])) {
        $this->model_guru->save();
        redirect('guru');
      } else {
        $this->template->load('template', 'guru/add');
      }
    }

    function edit()
    {
      if (isset($_POST['submit'])) {
        $this->model_guru->update();
        redirect('guru');
      } else {
        $id_guru     = $this->uri->segment(3);

        $data['guru'] = $this->db->select('guru.*, user.id_user, user.username')->join('tbl_user user', 'user.id_user = guru.id_user')->where('id_guru', $id_guru)->from('tbl_guru guru')->get()->row_array();

        $this->template->load('template', 'guru/edit', $data);
      }
    }

    function delete()
    {
      $id_guru = $this->uri->segment(3);
      if (!empty($id_guru)) {
        $guru = $this->db->where('id_guru', $id_guru)->get('tbl_guru')->row();

        $id_user = $guru->id_user;

        $this->db->where('id_guru', $id_guru)->delete('tbl_guru');

        $this->db->where('id_user', $id_user)->delete('tbl_user');
      }
      redirect('guru');
    }

  }

?>