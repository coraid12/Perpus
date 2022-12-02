<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * detail_p_id_buku_option_list Model Action
     * @return array
     */
	function detail_p_id_buku_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_buku AS value,judul AS label FROM buku";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * peminjaman_nim_option_list Model Action
     * @return array
     */
	function peminjaman_nim_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT nim AS value,nama_mhw AS label FROM mahasiswa";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * peminjaman_id_ptgs_option_list Model Action
     * @return array
     */
	function peminjaman_id_ptgs_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_ptgs AS value,nama_ptgs AS label FROM petugas";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * peminjaman_id_status_option_list Model Action
     * @return array
     */
	function peminjaman_id_status_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_status AS value,status AS label FROM status";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * detail_k_id_buku_option_list Model Action
     * @return array
     */
	function detail_k_id_buku_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_buku AS value,judul AS label FROM buku";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * pengembalian_nim_option_list Model Action
     * @return array
     */
	function pengembalian_nim_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT nim AS value,nama_mhw AS label FROM mahasiswa";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * pengembalian_id_pinjam_option_list Model Action
     * @return array
     */
	function pengembalian_id_pinjam_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_pinjam AS value,nim AS label FROM peminjaman";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * pengembalian_id_ptgs_option_list Model Action
     * @return array
     */
	function pengembalian_id_ptgs_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_ptgs AS value,nama_ptgs AS label FROM petugas";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * pengembalian_id_status_option_list Model Action
     * @return array
     */
	function pengembalian_id_status_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_status AS value,status AS label FROM status";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * getcount_mahasiswa Model Action
     * @return Value
     */
	function getcount_mahasiswa(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM mahasiswa";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_buku Model Action
     * @return Value
     */
	function getcount_buku(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM buku";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_petugas Model Action
     * @return Value
     */
	function getcount_petugas(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM petugas";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

}
