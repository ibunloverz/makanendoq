
  
<?php
date_default_timezone_set('Asia/Jakarta');
include "function.php";
ulang:
// function change(){
echo color("green","[]      BISMILLAHIRRAHMANIRRAHIM      []\n");
echo color("yellow","[]          BY : HERUTOK              []\n");
echo color("green","[]  Time  : ".date('[d-m-Y] [H:i:s]')."   []\n");
echo color("yellow","[] Format Penulisan Nomor 62xxxxxxxx  []\n");
        $nama = nama();
        $email = str_replace(" ", "", $nama) . mt_rand(100, 999);
        echo color("white"," NOMOR  : ");
        // $no = trim(fgets(STDIN));
        $nohp = trim(fgets(STDIN));
        $nohp = str_replace("62","62",$nohp);
        $nohp = str_replace("(","",$nohp);
        $nohp = str_replace(")","",$nohp);
        $nohp = str_replace("-","",$nohp);
        $nohp = str_replace(" ","",$nohp);

        if (!preg_match('/[^+0-9]/', trim($nohp))) {
            if (substr(trim($nohp),0,3)=='62') {
                $hp = trim($nohp);
            }
            else if (substr(trim($nohp),0,1)=='0') {
                $hp = '62'.substr(trim($nohp),1);
        }
         elseif(substr(trim($nohp), 0, 2)=='62'){
            $hp = '6'.substr(trim($nohp), 1);
        }
        else{
            $hp = '1'.substr(trim($nohp),0,13);
        }
    }
        $data = '{"email":"'.$email.'@yahoo.com","name":"'.$nama.'","phone":"+'.$hp.'","signed_up_country":"ID"}';
        $register = request("/v5/customers", null, $data);
        if(strpos($register, '"otp_token"')){
        $otptoken = getStr('"otp_token":"','"',$register);
        echo color("white"," KODE OTP..")."\n";
        otp:
        echo color("white"," Otp : ");
        $otp = trim(fgets(STDIN));
        $data1 = '{"client_name":"gojek:cons:android","data":{"otp":"' . $otp . '","otp_token":"' . $otptoken . '"},"client_secret":"83415d06-ec4e-11e6-a41b-6c40088ab51e"}';
        $verif = request("/v5/customers/phone/verify", null, $data1);
        if(strpos($verif, '"access_token"')){
        echo color("white","BERHASIL MENDAFTAR\n");
        $token = getStr('"access_token":"','"',$verif);
        $uuid = getStr('"resource_owner_id":',',',$verif);
        echo color("white","+] Your access token : ".$token."\n\n");
        save("token.txt",$token); 
        echo color("white","\n▬▬▬▬▬▬▬▬▬▬▬▬CLAIM VOUCHER▬▬▬▬▬▬▬▬▬▬▬▬");
        echo "\n".color("white","CLAIM VOUCHER 1..");
        echo "\n".color("white"," Please wait");
        for($a=1;$a<=3;$a++){
        echo color("white",".");
        sleep(5);
        }
        $code1 = request('/go-promotions/v1/promotions/enrollments', $token, '{"promo_code":"WENDYS"}');
        $message = fetch_value($code1,'"message":"','"');
        if(strpos($code1, 'Promo kamu sudah bisa dipakai')){
        echo "\n".color("green","Message: ".$message);
        goto gocar;
        }else{
        echo "\n".color("white"," Message: ".$message);
	gocar:
        echo "\n".color("white"," CLAIM VOUCHER 2.. ");
        echo "\n".color("white"," Please wait");
        for($a=1;$a<=3;$a++){
        echo color("white",".");
        sleep(35);
        }
        $code1 = request('/go-promotions/v1/promotions/enrollments', $token, '{"promo_code":"COBAGOFOOD0906"}');
        $message = fetch_value($code1,'"message":"','"');
        if(strpos($code1, 'Promo kamu sudah bisa dipakai.')){
        echo "\n".color("green","Message: ".$message);
        goto gofood;
        }else{
        echo "\n".color("white"," Message: ".$message);
        gofood:
        echo "\n".color("white"," CLAIM VOUCHER 2..");
        echo "\n".color("white"," Please wait");
        for($a=1;$a<=3;$a++){
        echo color("white",".");
        sleep(3);
        }
        $code1 = request('/go-promotions/v1/promotions/enrollments', $token, '{"promo_code":"PAKEGOFOOD0906"}');
        $message = fetch_value($code1,'"message":"','"');
        echo "\n".color("white"," Message: ".$message);
        echo "\n".color("white"," REFRESH..");
        echo "\n".color("white"," Please wait");
        for($a=1;$a<=3;
