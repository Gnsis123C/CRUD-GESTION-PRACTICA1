<?php
if (!$this->session->userdata('username')) {
    $this->session->sess_destroy();
    redirect(base_url());
}
?>