<?php
$comp_model = new SharedController;
$page_element_id = "add-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="add"  data-display-type="" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Tambah Transaksi Peminjaman</h4>
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
                <div class="col-md-7 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form id="peminjaman-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="<?php print_link("peminjaman/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="nim">NIM <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                <input id="ctrl-nim"  value="<?php  echo $this->set_field_value('nim',""); ?>" type="text" placeholder="Tambahkan NIM" list="nim_list"  required="" name="nim"  class="form-control " />
                                                    <datalist id="nim_list">
                                                        <?php 
                                                        $nim_options = $comp_model -> peminjaman_nim_option_list();
                                                        if(!empty($nim_options)){
                                                        foreach($nim_options as $option){
                                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                                        ?>
                                                        <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                                                        <?php
                                                        }
                                                        }
                                                        ?>
                                                    </datalist>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="tgl_pinjam">Tanggal Pinjam <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input id="ctrl-tgl_pinjam" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('tgl_pinjam',date_now()); ?>" type="datetime" name="tgl_pinjam" placeholder="Tambahkan Tanggal Pinjam" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="d-m-Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="tgl_kembali">Tanggal Kembali <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input id="ctrl-tgl_kembali" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('tgl_kembali',date('Y-m-d', strtotime('+3day'))); ?>" type="datetime" name="tgl_kembali" placeholder="Tambahkan Tanggal Kembali" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="d-m-Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="id_ptgs">ID Petugas <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <select required=""  id="ctrl-id_ptgs" name="id_ptgs"  placeholder="Select a value ..."    class="custom-select" >
                                                                <option value="">Select a value ...</option>
                                                                <?php 
                                                                $id_ptgs_options = $comp_model -> peminjaman_id_ptgs_option_list();
                                                                if(!empty($id_ptgs_options)){
                                                                foreach($id_ptgs_options as $option){
                                                                $value = (!empty($option['value']) ? $option['value'] : null);
                                                                $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                $selected = $this->set_field_selected('id_ptgs',$value, "");
                                                                ?>
                                                                <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                                    <?php echo $label; ?>
                                                                </option>
                                                                <?php
                                                                }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="id_status">Status <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <select required=""  id="ctrl-id_status" name="id_status"  placeholder="Select a value ..."    class="custom-select" >
                                                                <option value="">Select a value ...</option>
                                                                <?php 
                                                                $id_status_options = $comp_model -> peminjaman_id_status_option_list();
                                                                if(!empty($id_status_options)){
                                                                foreach($id_status_options as $option){
                                                                $value = (!empty($option['value']) ? $option['value'] : null);
                                                                $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                $selected = $this->set_field_selected('id_status',$value, "");
                                                                ?>
                                                                <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                                    <?php echo $label; ?>
                                                                </option>
                                                                <?php
                                                                }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-light p-2 subform">
                                            <h4 class="record-title">Detail Transaksi</h4>
                                            <hr />
                                            <div>
                                                <table class="table table-striped table-sm" data-maxrow="10" data-minrow="1">
                                                    <thead>
                                                        <tr>
                                                            <th class="bg-light"><label for="id_buku">Buku</label></th>
                                                            <th class="bg-light"><label for="jum_pinjam">Jumlah Pinjam</label></th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        for( $row = 1; $row <= 1; $row++ ){
                                                        ?>
                                                        <tr class="input-row">
                                                            <td>
                                                                <div id="ctrl-id_buku-row<?php echo $row; ?>-holder" class="">
                                                                    <select required=""  id="ctrl-id_buku-row<?php echo $row; ?>" name="detail_p[row<?php echo $row ?>][id_buku]"  placeholder="Select a value ..."    class="custom-select" >
                                                                        <option value="">Select a value ...</option>
                                                                        <?php 
                                                                        $id_buku_options = $comp_model -> detail_p_id_buku_option_list();
                                                                        if(!empty($id_buku_options)){
                                                                        foreach($id_buku_options as $option){
                                                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                        $selected = $this->set_field_selected('id_buku',$value, "");
                                                                        ?>
                                                                        <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                                            <?php echo $label; ?>
                                                                        </option>
                                                                        <?php
                                                                        }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div id="ctrl-jum_pinjam-row<?php echo $row; ?>-holder" class="">
                                                                    <input id="ctrl-jum_pinjam-row<?php echo $row; ?>"  value="<?php  echo $this->set_field_value('jum_pinjam',"", $row); ?>" type="number" placeholder="Jumlah Pinjam" step="1"  required="" name="detail_p[row<?php echo $row ?>][jum_pinjam]"  class="form-control " />
                                                                    </div>
                                                                </td>
                                                                <th class="text-center">
                                                                    <button type="button" class="close btn-remove-table-row">&times;</button>
                                                                </th>
                                                            </tr>
                                                            <?php 
                                                            }
                                                            ?>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th colspan="100" class="text-right">
                                                                    <?php $template_id = "table-row-" . random_str(); ?>
                                                                    <button type="button" data-template="#<?php echo $template_id ?>" class="btn btn-sm btn-light btn-add-table-row"><i class="fa fa-plus"></i></button>
                                                                </th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="form-group form-submit-btn-holder text-center mt-3">
                                                <div class="form-ajax-status"></div>
                                                <button class="btn btn-primary" type="submit">
                                                    Submit
                                                    <i class="fa fa-send"></i>
                                                </button>
                                            </div>
                                            </form><template id="<?php echo $template_id ?>">
                                            <tr class="input-row">
                                                <?php $row = 1; ?>
                                                <td>
                                                    <div id="ctrl-id_buku-row<?php echo $row; ?>-holder" class="">
                                                        <select required=""  id="ctrl-id_buku-row<?php echo $row; ?>" name="detail_p[row<?php echo $row ?>][id_buku]"  placeholder="Select a value ..."    class="custom-select" >
                                                            <option value="">Select a value ...</option>
                                                            <?php 
                                                            $id_buku_options = $comp_model -> detail_p_id_buku_option_list();
                                                            if(!empty($id_buku_options)){
                                                            foreach($id_buku_options as $option){
                                                            $value = (!empty($option['value']) ? $option['value'] : null);
                                                            $label = (!empty($option['label']) ? $option['label'] : $value);
                                                            $selected = $this->set_field_selected('id_buku',$value, "");
                                                            ?>
                                                            <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                                <?php echo $label; ?>
                                                            </option>
                                                            <?php
                                                            }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="ctrl-jum_pinjam-row<?php echo $row; ?>-holder" class="">
                                                        <input id="ctrl-jum_pinjam-row<?php echo $row; ?>"  value="<?php  echo $this->set_field_value('jum_pinjam',"", $row); ?>" type="number" placeholder="Jumlah Pinjam" step="1"  required="" name="detail_p[row<?php echo $row ?>][jum_pinjam]"  class="form-control " />
                                                        </div>
                                                    </td>
                                                    <th class="text-center">
                                                        <button type="button" class="close btn-remove-table-row">&times;</button>
                                                    </th>
                                                </tr>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
