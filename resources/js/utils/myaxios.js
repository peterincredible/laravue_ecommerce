import axios from "axios";
axios.login=(user)=>{
    axios.defaults.headers.common.Authorization = `Bearer ${user.token}`;
}
axios.logout=()=>{
    delete axios.defaults.headers.common.Authorization;
}

if(localStorage['user']){
    let user = JSON.parse(localStorage.user)
    axios.login(user);
}
export default axios;