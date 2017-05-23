<?php
class checkEmailStatus extends ServiceAPI{


        function beforeFilter(){
        $this->checkEmailStatusHelper = $this->useHelper('checkEmailStatusHelper');

        }

        function checkMail (){
                global $CONFIG,$LOCALE;

                        $data['id']=$this->_p('id');

                        $status = $this->checkEmailStatusHelper->checkMail($data);
                        if($email)
                        {
                                return array('status'=>1,'msg'=>'sucsess','data'=>$status);
                        }
                        else
                        {
                                return array('status'=>0,'msg'=>'nodata','data'=>false);
                        }
        }

        }

?>
