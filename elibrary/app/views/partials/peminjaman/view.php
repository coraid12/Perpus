<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">View  Peminjaman</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['id_pinjam']) ? urlencode($data['id_pinjam']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id_pinjam">
                                        <th class="title"> Id Pinjam: </th>
                                        <td class="value"> <?php echo $data['id_pinjam']; ?></td>
                                    </tr>
                                    <tr  class="td-nim">
                                        <th class="title"> Nim: </th>
                                        <td class="value">
                                            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("mahasiswa/view/" . urlencode($data['nim'])) ?>">
                                                <i class="fa fa-eye"></i> <?php echo $data['mahasiswa_nama_mhw'] ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr  class="td-tgl_pinjam">
                                        <th class="title"> Tgl Pinjam: </th>
                                        <td class="value"> <?php echo $data['tgl_pinjam']; ?></td>
                                    </tr>
                                    <tr  class="td-tgl_kembali">
                                        <th class="title"> Tgl Kembali: </th>
                                        <td class="value"> <?php echo $data['tgl_kembali']; ?></td>
                                    </tr>
                                    <tr  class="td-id_ptgs">
                                        <th class="title"> Id Ptgs: </th>
                                        <td class="value">
                                            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("petugas/view/" . urlencode($data['id_ptgs'])) ?>">
                                                <i class="fa fa-eye"></i> <?php echo $data['petugas_nama_ptgs'] ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr  class="td-id_status">
                                        <th class="title"> Id Status: </th>
                                        <td class="value">
                                            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("status/view/" . urlencode($data['id_status'])) ?>">
                                                <i class="fa fa-eye"></i> <?php echo $data['status_status'] ?>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
                            <div class="dropup export-btn-holder mx-1">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-save"></i> Export
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php $export_print_link = $this->set_current_page_link(array('format' => 'print')); ?>
                                    <a class="dropdown-item export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                        <img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> PRINT
                                        </a>
                                        <?php $export_pdf_link = $this->set_current_page_link(array('format' => 'pdf')); ?>
                                        <a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
                                            <img src="<?php print_link('assets/images/pdf.png') ?>" class="mr-2" /> PDF
                                            </a>
                                        </div>
                                    </div>
                                    <a class="btn btn-sm btn-info"  href="<?php print_link("peminjaman/edit/$rec_id"); ?>">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("peminjaman/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                        <i class="fa fa-times"></i> Delete
                                    </a>
                                </div>
                                <?php
                                }
                                else{
                                ?>
                                <!-- Empty Record Message -->
                                <div class="text-muted p-3">
                                    <i class="fa fa-ban"></i> No Record Found
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-12 comp-grid">
                            <div class=" ">
                                <?php  
                                $this->render_page("detail_p/list/detail_p.id_pinjam/$data[id_pinjam]?limit_count=20" , array( 'show_header' => false,'show_footer' => false )); 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
