<?php

  class Model_guru extends CI_Model
  {

    public $table = "tbl_guru";

    function save()
    {
      $user = array(
        'nama_lengkap' => $this->input->post('nama_guru', TRUE),
        'username' => $this->input->post('nuptk', TRUE),
        'password' => md5($this->input->post('password', TRUE)),
        'id_level_user' => 3,
        'foto' => 'user-siluet2.jpg'
      );

      $this->db->insert('tbl_user', $user);
      $id_user = $this->db->insert_id();

      $data = array(
        'id_user' => $id_user,
        'nuptk'       => $this->input->post('nuptk', TRUE),
        'nama_guru'   => $this->input->post('nama_guru', TRUE),
        'gender'      => $this->input->post('gender', TRUE),
      );

      $this->db->insert($this->table, $data);
    }

    function update()
    {
      $data = array(
        //tabel di database => name di form
        'nuptk'       => $this->input->post('nuptk', TRUE),
        'nama_guru'   => $this->input->post('nama_guru', TRUE),
        'gender'      => $this->input->post('gender', TRUE),
      );

      $user = array(
        'nama_lengkap' => $this->input->post('nama_guru', TRUE),
        'username' => $this->input->post('nuptk', TRUE),
        'password' => md5($this->input->post('password', TRUE)),
        'id_level_user' => 3,
        'foto' => 'user-siluet2.jpg'
      );

      $id_guru = $this->input->post('id_guru');
      $guru = $this->db->where('id_guru', $id_guru);
      $user = $this->db->where('id_user', $this->input->post('id_user'));

      $guru->update($this->table, $data);
      $user->update('tbl_user', $user);
    }

    function login($username, $password)
    {
      $this->db->where('username', $username);
      $this->db->where('password', md5($password));
      $user = $this->db->get('tbl_guru')->row_array();
      return $user;
    }

    // Fungsi untuk melakukan proses upload file
    public function upload_csv($filename){
      $this->load->library('upload'); // Load librari upload
      
      $config['upload_path'] = './csv/';
      $config['allowed_types'] = 'csv';
      $config['max_size']  = '2048';
      $config['overwrite'] = true;
      $config['file_name'] = $filename;
    
      $this->upload->initialize($config); // Load konfigurasi uploadnya
      if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
        // Jika berhasil :
        $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
        return $return;
      }else{
        // Jika gagal :
        $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
        return $return;
      }
    }


  }

?>