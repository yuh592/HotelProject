<?php
class AppServiceProvider extends ServiceProvider {
    public function boot(){
        $dataUser = $this->db->table('taikhoan')->where('id_user', '=', 20)->first();
        $data['userInfo'] = $dataUser;
        $data['copyright'] = 'Copyright &copy; 2021 by Unicode';
        View::share($data);
    }
}