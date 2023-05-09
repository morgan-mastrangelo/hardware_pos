import {Employee} from './Employee.js';
import {NaviUrl} from './NaviUrl.js';

const employee = new Employee('Alice', 100);
const naviurl = new NaviUrl();
 async function  doThis(){
    let url = await naviurl.geturl("db"); 
    console.log(url)
}
doThis();
let iam = ()=>{
    alert("iam")
}