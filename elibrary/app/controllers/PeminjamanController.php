<?php 
/**
 * Peminjaman Page Controller
 * @category  Controller
 */
class PeminjamanController extends BaseController{
	function __construct(){
		parent::__construct();
		$this->tablename = "peminjaman";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("peminjaman.id_pinjam", 
			"peminjaman.nim", 
			"mahasiswa.nama_mhw AS mahasiswa_nama_mhw", 
			"peminjaman.tgl_pinjam", 
			"peminjaman.tgl_kembali", 
			"peminjaman.id_ptgs", 
			"petugas.nama_ptgs AS petugas_nama_ptgs", 
			"peminjaman.id_status", 
			"status.status AS status_status");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				peminjaman.nim LIKE ? OR 
				peminjaman.tgl_pinjam LIKE ? OR 
				peminjaman.tgl_kembali LIKE ? OR 
				peminjaman.id_ptgs LIKE ? OR 
				peminjaman.id_status LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "peminjaman/search.php";
		}
		$db->join("mahasiswa", "peminjaman.nim = mahasiswa.nim", "INNER");
		$db->join("petugas", "peminjaman.id_ptgs = petugas.id_ptgs", "INNER");
		$db->join("status", "peminjaman.id_status = status.id_status", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("id_pinjam", "ASC");
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Peminjaman";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("peminjaman/list.php", $data); //render the full page
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("peminjaman.id_pinjam", 
			"peminjaman.nim", 
			"mahasiswa.nama_mhw AS mahasiswa_nama_mhw", 
			"peminjaman.tgl_pinjam", 
			"peminjaman.tgl_kembali", 
			"peminjaman.id_ptgs", 
			"petugas.nama_ptgs AS petugas_nama_ptgs", 
			"peminjaman.id_status", 
			"status.status AS status_status");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("peminjaman.id_pinjam", $rec_id);; //select record based on primary key
		}
		$db->join("mahasiswa", "peminjaman.nim = mahasiswa.nim", "INNER");
		$db->join("petugas", "peminjaman.id_ptgs = petugas.id_ptgs", "INNER");
		$db->join("status", "peminjaman.id_status = status.id_status", "INNER");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Peminjaman";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("peminjaman/view.php", $record);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("id_pinjam","nim","tgl_pinjam","tgl_kembali","id_ptgs","id_status");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'nim' => 'required',
				'tgl_pinjam' => 'required',
				'tgl_kembali' => 'required',
				'id_ptgs' => 'required',
				'id_status' => 'required',
			);
			$this->sanitize_array = array(
				'nim' => 'sanitize_string',
				'tgl_pinjam' => 'sanitize_string',
				'tgl_kembali' => 'sanitize_string',
				'id_ptgs' => 'sanitize_string',
				'id_status' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					// insert Detail_p record
					$detail_p_controller = new Detail_pController;
					$detail_p_controller->return_value = true; // return value instead of view
					$peminjaman_formdata = $formdata['detail_p'];
					$detail_p_controller_rec_id = $detail_p_controller->add($peminjaman_formdata, $rec_id);
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("peminjaman");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Tambah Transasksi Peminjaman";
		$this->render_view("peminjaman/add.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id_pinjam","nim","tgl_pinjam","tgl_kembali","id_ptgs","id_status");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'nim' => 'required',
				'tgl_pinjam' => 'required',
				'tgl_kembali' => 'required',
				'id_ptgs' => 'required',
				'id_status' => 'required',
			);
			$this->sanitize_array = array(
				'nim' => 'sanitize_string',
				'tgl_pinjam' => 'sanitize_string',
				'tgl_kembali' => 'sanitize_string',
				'id_ptgs' => 'sanitize_string',
				'id_status' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("peminjaman.id_pinjam", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("peminjaman");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("peminjaman");
					}
				}
			}
		}
		$db->where("peminjaman.id_pinjam", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Peminjaman";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("peminjaman/edit.php", $data);
	}
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("peminjaman.id_pinjam", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("peminjaman");
	}
}
