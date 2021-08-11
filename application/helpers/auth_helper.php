<?php
function is_log_in()
{
  $ci = get_instance();
  if(!$ci->session->userdata('userid')){
    redirect('auth');
  }
}
?>
