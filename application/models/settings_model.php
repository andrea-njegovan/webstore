<?php
class Settings_model extends CI_Model {
    public function __construct() {
        parent:: __construct();

        $this->load->library('form_validation');
    }

    /**
     * Fetch Additional Data From products table
     * @param $id
     * @return mixed
     */
	public function get_product($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('products');
		return $query->row();
	}

    /**
     * Insert Product in products table
     * @param $data
     */
	public function insert_product($data) {
		$this->db->insert('products', $data);
	}

    /**
     * Update Product Details
     * @param $data
     * @param $id
     */
	public function update_product($data, $id) {
		$this->db->where('id', $id);
		$this->db->update('products', $data);
	}

    /**
     * Publish Product
     * @param $id
     */
	public function publish_product($id){
		$data = array(
               		'published' => 1
            	);

		$this->db->where('id', $id);
		$this->db->update('products', $data); 
	}

    /**
     * Unpublish Product
     * @param $id
     */
	public function unpublish_product($id){
		$data = array(
               		'published' => 0
            	);

		$this->db->where('id', $id);
		$this->db->update('products', $data); 
	}

    /**
     * Delete Product
     * @param $id
     */
	public function delete_product($id){
		$this->db->where('id', $id);
		$this->db->delete('products', $data);
	}

    /**
     * Verify Entered Product Data
     * @return bool
     */
    function verify_product() {
        //Validation Rules
        $this->form_validation->set_rules('title','Title','trim|required|min_length[4]|xss_clean');
        $this->form_validation->set_rules('description','Description','trim|required|xss_clean');
        $this->form_validation->set_rules('specifications','Specifications','trim|required|xss_clean');
        $this->form_validation->set_rules('price','Price','trim|required|xss_clean');
        $this->form_validation->set_rules('published','Publish','required');
        $this->form_validation->set_rules('category','Category','required');

        if (!$this->form_validation->run()) {
            return false ;
        } else {
            return true;
        }
    }


    /**
     * Fetch Data From categories table
     * @param null $order_by
     * @param string $sort
     * @param null $limit
     * @param int $offset
     * @return mixed
     */
	public function get_categories($order_by = null, $sort = 'DESC', $limit = null, $offset = 0){
		$this->db->select('*');
		$this->db->from('categories');	
		if($limit != null){
			$this->db->limit($limit, $offset);
		}
		if($order_by != null){
			$this->db->order_by($order_by, $sort);
		}
		$query = $this->db->get();
		return $query->result();
	}
	
	//Get Single Category
	public function get_category($id){
		$this->db->where('id',$id);
		$query = $this->db->get('categories');
		return $query->row();
	}
	
	//Insert Category
	public function insert_category($data) {
		$this->db->insert('categories', $data);
	}
	
	//Update Category
	public function update_category($data, $id){
		$this->db->where('id', $id);
		$this->db->update('categories', $data);
	}
	
	//Delete Category
	public function delete_category($id){
		$this->db->where('id', $id);
		$this->db->delete('categories', $data);
	}

    /**
     * Verify Entered Category
     * @return bool
     */
    function verify_category() {
        //Validation Rule
        $this->form_validation->set_rules('name','category name','trim|required|min_length[4]|xss_clean');

        if (!$this->form_validation->run()) {
            return false ;
        } else {
            return true;
        }
    }


    /**
     * Fetch Data From admins table
     * @param null $order_by
     * @param string $sort
     * @param null $limit
     * @param int $offset
     * @return mixed
     */
	public function get_admins($order_by = null, $sort = 'DESC', $limit = null, $offset = 0){
		$this->db->select('*');
		$this->db->from('admins');	
		if($limit != null){
			$this->db->limit($limit, $offset);
		}
		if($order_by != null){
			$this->db->order_by($order_by, $sort);
		}
		$query = $this->db->get();
		return $query->result();
	}
	
	//Get Single Admin
	public function get_admin($id){
		$this->db->where('id', $id);
		$query = $this->db->get('admins');
		return $query->row();
	}
	
	//Insert Admin
	public function insert_admin($data) {
		$this->db->insert('admins', $data);
	}
	
    //Update Admin
	public function update_admin($data, $id){
		$this->db->where('id', $id);
		$this->db->update('admins', $data);
	}
	
	//Delete Admin
	public function delete_admin($id){
		$this->db->where('id', $id);
		$this->db->delete('admins', $data);
	}

    /**
     * Verify Entered Admin Data
     * @return bool
     */
    function verify_admin() {
        //Validation Rules
        $this->form_validation->set_rules('first_name','First Name','trim|required|xss_clean');
        $this->form_validation->set_rules('last_name','Last Name','trim|required|xss_clean');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('username','Username','trim|required|min_length[3]|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'matches[confirm_password]');

        if (!$this->form_validation->run()) {
            return false ;
        } else {
            return true;
        }
    }


    /**
     * Fetch Data From home_settings table
     * @param null $order_by
     * @param string $sort
     * @param null $limit
     * @param int $offset
     * @return mixed
     */
	public function get_home($order_by = null, $sort = 'DESC', $limit = null, $offset = 0){
		$this->db->select('*');
		$this->db->from('home_settings');	
		if($limit != null){
			$this->db->limit($limit, $offset);
		}
		if($order_by != null){
			$this->db->order_by($order_by, $sort);
		}
		$query = $this->db->get();
		return $query->result();
	}
	
	//Get Single Home
	public function get_single_home($id){
		$this->db->where('id',$id);
		$query = $this->db->get('home_settings');
		return $query->row();
	}
	
	//Insert Home
	public function insert_home($data) {
		$this->db->insert('home_settings', $data);
	}
	
	//Update Home
	public function update_home($data, $id) {
		$this->db->where('id', $id);
		$this->db->update('home_settings', $data);
	}
	
	// Publish Home
	public function publish_home($id){
		$data = array(
               		'published' => 1
            	);

		$this->db->where('id', $id);
		$this->db->update('home_settings', $data); 
	}
	
	// Unpublish Home
	public function unpublish_home($id){
		$data = array(
               		'published' => 0
            	);

		$this->db->where('id', $id);
		$this->db->update('home_settings', $data); 
	}
	
	// Delete Home
	public function delete_home($id){
		$this->db->where('id', $id);
		$this->db->delete('home_settings', $data);
	}

    /**
     * Verify Entered Home Page Data
     * @return bool
     */
    function verify_home() {
        //Validation Rules
        $this->form_validation->set_rules('title','Title','trim|required|min_length[4]|xss_clean');
        $this->form_validation->set_rules('description','Description','trim|required|xss_clean');
        $this->form_validation->set_rules('button_title','Button Title','trim|required|xss_clean');
        $this->form_validation->set_rules('button_link','Button Link','trim|required|xss_clean');
        $this->form_validation->set_rules('published','Publish','required');

        if (!$this->form_validation->run()) {
            return false ;
        } else {
            return true;
        }
    }


    /**
     * Fetch Data From about_settings table
     * @param null $order_by
     * @param string $sort
     * @param null $limit
     * @param int $offset
     * @return mixed
     */
	public function get_about($order_by = null, $sort = 'DESC', $limit = null, $offset = 0){
		$this->db->select('*');
		$this->db->from('about_settings');	
		if($limit != null){
			$this->db->limit($limit, $offset);
		}
		if($order_by != null){
			$this->db->order_by($order_by, $sort);
		}
		$query = $this->db->get();
		return $query->result();
	}
	
	//Get Single About
	public function get_single_about($id){
		$this->db->where('id',$id);
		$query = $this->db->get('about_settings');
		return $query->row();
	}
	
	//Insert About
	public function insert_about($data) {
		$this->db->insert('about_settings', $data);
	}
	
	//Update About
	public function update_about($data, $id) {
		$this->db->where('id', $id);
		$this->db->update('about_settings', $data);
	}
	
	//Publish About
	public function publish_about($id){
		$data = array(
               		'published' => 1
            	);

		$this->db->where('id', $id);
		$this->db->update('about_settings', $data); 
	}
	
	//Unpublish About
	public function unpublish_about($id){
		$data = array(
               		'published' => 0
            	);

		$this->db->where('id', $id);
		$this->db->update('about_settings', $data); 
	}
	
	//Delete About
	public function delete_about($id){
		$this->db->where('id', $id);
		$this->db->delete('about_settings', $data);
	}

    /**
     * Verify Entered About Page Data
     * @return bool
     */
    function verify_about() {
        //Validation Rules
        $this->form_validation->set_rules('title','Title','trim|required|min_length[4]|xss_clean');
        $this->form_validation->set_rules('description','Description','trim|required|xss_clean');
        $this->form_validation->set_rules('published','Publish','required');

        if (!$this->form_validation->run()) {
            return false ;
        } else {
            return true;
        }
    }


    /**
     * Fetch Data From contact_settings Table
     * @param null $order_by
     * @param string $sort
     * @param null $limit
     * @param int $offset
     * @return mixed
     */
	public function get_contact_data($order_by = null, $sort = 'DESC', $limit = null, $offset = 0){
		$this->db->select('*');
		$this->db->from('contact_settings');	
		if($limit != null){
			$this->db->limit($limit, $offset);
		}
		if($order_by != null){
			$this->db->order_by($order_by, $sort);
		}
		$query = $this->db->get();
		return $query->result();
	}
	
	//Get Single Contact Data
	public function get_single_contact_data($id){
		$this->db->where('id',$id);
		$query = $this->db->get('contact_settings');
		return $query->row();
	}
	
	//Update Contact
	public function update_contact_data($data, $id) {
		$this->db->where('id', $id);
		$this->db->update('contact_settings', $data);
	}

    /**
 * Verify Entered Email Data
 * @return bool
 */
    function verify_email() {
        $this->form_validation->set_rules('contactname', 'Name', 'trim|xss_clean');
        $this->form_validation->set_rules('email', 'Email Address', 'trim|valid_email|xss_clean');
        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('message', 'Message', 'trim|required|max_length[255]|xss_clean');

        if (!$this->form_validation->run()) {
            return false ;
        } else {
            return true;
        }
    }

    /**
     * Verify Contact Data
     * @return bool
     */
    function verify_contact() {
        //Validation Rules
        $this->form_validation->set_rules('value','Value','trim|min_length[4]|xss_clean');

        if (!$this->form_validation->run()) {
            return false ;
        } else {
            return true;
        }
    }

}
