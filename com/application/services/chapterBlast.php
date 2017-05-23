<?php
class chapterBlast extends ServiceAPI{


        function beforeFilter(){
        $this->chapterblastHelper = $this->useHelper('chapterblastHelper');

        }

        function blastMail (){
                global $CONFIG,$LOCALE;

                        $data['id']=$this->_p('id');

                        $email = $this->chapterblastHelper->blastMail($data);
                        if($email)
                        {
                                return array('status'=>1,'msg'=>'sucsess','data'=>$email);
                        }
                        else
                        {
                                return array('status'=>0,'msg'=>'nodata','data'=>false);
                        }
        }

        }

?>
