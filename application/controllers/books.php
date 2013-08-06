<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Books extends REST_Controller {

	public function index_post() {

		$data = json_decode(file_get_contents('php://input'), true);

		$data['status'] = ($data['status']? 't':'f');

		$result = $this->book_model->insertBook($data);

		$this->response(array('id' => $result));
	}

	public function index_get() {
		//	check for 'GET' data
		if(!$this->uri->segment(2,false)){
			//	get all books
			$results = $this->book_model->getAllBooks();
			//	check if table empty
			if(!empty($results)){
				$this->response($results);
			}
		}else{
			//	get book by 'id'
			$results = $this->book_model->getBookById($this->uri->segment(2));
			//	check if book exists
			if(!empty($results)){
				$this->response($results);
			}
		}
	}

	public function index_put() {
		$data = array(
			'title' => $this->put('title', FALSE),
			'author' => $this->put('author', TRUE),
			'status' => ($this->put('status', TRUE)?'t':'f'),
			'id' => $this->put('id', TRUE)
			);

		$results = $this->book_model->updateBook($data);
		$this->response($results);
	}

	public function index_delete() {
		$this->response($this->book_model->deleteBook($this->uri->segment(2)));
	}
}

/* End of file books.php */
/* Location: ./application/controllers/books.php */