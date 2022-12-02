<?php
/**
 * Menu Items
 * All Project Menu
 * @category  Menu List
 */

class Menu{
	
	
			public static $navbartopleft = array(
		array(
			'path' => 'mahasiswa', 
			'label' => 'Mahasiswa', 
			'icon' => ''
		),
		
		array(
			'path' => 'buku', 
			'label' => 'Buku', 
			'icon' => ''
		),
		
		array(
			'path' => 'petugas', 
			'label' => 'Petugas', 
			'icon' => ''
		),
		
		array(
			'path' => 'menu7', 
			'label' => 'Transaksi', 
			'icon' => '','submenu' => array(
		array(
			'path' => 'peminjaman', 
			'label' => 'Peminjaman', 
			'icon' => ''
		),
		
		array(
			'path' => 'pengembalian', 
			'label' => 'Pengembalian', 
			'icon' => ''
		)
	)
		),
		
		array(
			'path' => 'menu8', 
			'label' => 'Data', 
			'icon' => '','submenu' => array(
		array(
			'path' => 'detail_p', 
			'label' => 'Detail Peminjaman', 
			'icon' => ''
		),
		
		array(
			'path' => 'detail_k', 
			'label' => 'Detail Pengembalian', 
			'icon' => ''
		)
	)
		)
	);
		
	
	
}