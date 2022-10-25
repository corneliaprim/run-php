
function validPw ($password){
    if(strlen($password) >= 8){
        if(!ctype_upper($password) && !ctype_lower($password) ){
            $passwordErr = "great";
        }
}