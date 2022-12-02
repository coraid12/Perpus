<?php 
/**
 * Detail_p Page Controller
 * @category  Controller
 */
class Detail_pController extends BaseController{
	function __construct(){
		parent::__construct();
		$this->tablename = "detail_p";
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
		$fields = array("detail_p.id_detail", 
			"detail_p.id_buku", 
			"buku.judul AS buku_judul", 
			"detail_p.jum_pinjam");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				detail_p.id_buku LIKE ? OR 
				detail_p.jum_pinjam LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "detail_p/search.php";
		}
		$db->join("buku", "detail_p.id_buku = buku.id_buku", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("detail_p.id_detail", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Detail P";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("detail_p/list.php", $data); //render the full page
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
		$fields = array("detail_p.id_detail", 
			"detail_p.id_pinjam", 
			"detail_p.id_buku", 
			"buku.judul AS buku_judul", 
			"detail_p.jum_pinjam");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("detail_p.id_detail", $rec_id);; //select record based on primary key
		}
		$db->join("buku", "detail_p.id_buku = buku.id_buku", "INNER");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Detail P";
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
		return $this->render_view("detail_p/view.php", $record);
	}
	/**
     * Insert multiple record into the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null, $parent_id = null){
		if($formdata){
			$request = $this->request;
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("id_detail","id_pinjam","id_buku","jum_pinjam"); 
			$allpostdata = $this->format_multi_request_data($formdata);
			$allmodeldata = array();
			foreach($allpostdata as &$postdata){
			$this->rules_array = array(
				'id_buku' => 'required',
				'jum_pinjam' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'id_buku' => 'sanitize_string',
				'jum_pinjam' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($parent_id){
				$modeldata['id_pinjam'] = $parent_id;
			}
				$allmodeldata[] = $modeldata;
			}
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insertMulti($tablename, $allmodeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("detail_p");
				}
				else{
					$this->set_page_error(); //check if there's any db error and pass it to the view
				}
			}
		}
		$page_title = $this->view->page_title = "Detail Transaksi";
		return $this->render_view("detail_p/add.php");
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
		$fields = $this->fields = array("id_detail","id_pinjam","id_buku","jum_pinjam");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'id_buku' => 'required',
				'jum_pinjam' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'id_buku' => 'sanitize_string',
				'jum_pinjam' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("detail_p.id_detail", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("detail_p");
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
						return	$this->redirect("detail_p");
					}
				}
			}
		}
		$db->where("detail_p.id_detail", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Detail P";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("detail_p/edit.php", $data);
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
		$db->where("detail_p.id_detail", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("detail_p");
	}
}
