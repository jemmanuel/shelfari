<?php


class Book_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function insertBook($data) {

		$this->db->insert('books',$data);

		return $this->db->insert_id();
	}

	//	default response to GET request to '/books'
	function getAllBooks() {
		//	cooresponding to 'SELECT * FROM "books"'
		$query = $this->db->get('books');
		//	accumulate results in container
		$results = array();

		foreach ($query->result_array() as $row) {
			array_push($results, array(
				'title' => $row['title'],
				'author' => $row['author'],
				'status' => $row['status'] === 't'? true:false,
				'id' => $row['id']
				)
			);
		}

		return $results;
	}

	//	response to GET request to '/boks/:id'
	function getBookById($id){
		//	execute query and generate result
		$query = $this->db->get_where('books', array('id' => $id));
		//	result container
		$results = array();

		foreach ($query->result_array() as $row) {
			array_push($results, array(
				'title' => $row['title'],
				'author' => $row['author'],
				'status' => $row['status'] === 't'? true:false,
				'id' => $row['id']
				)
			);
		}

		return $results;
	}

	function updateBook($data){
		//	update book with particular id
		return $this->db->update('books', $data, array('id' => $data['id']));
	}

	function deleteBook($id){
		//	delete book with particular id
		$var = $this->db->delete('books', array('id' => $id));
		return $var?true : false;
	}
}


/* End of file book_model.php */
/* Location: ./application/models/book/book_model.php */