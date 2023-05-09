// import { NaviUrl } from "../../util/path_config/NaviUrl.js";

// let geturl = async (urlname)=>{
//     const naviUrl = new NaviUrl();
//     naviUrl.geturl(urlname);
// }
const naviurl = "/hardware_pos_system/util/path_config/get_link.php";
let geturl = async (urlname) => {
    let url;
    let formData = new FormData();
    formData.append("url_name", urlname);

    await fetch(naviurl, { method: "POST", body: formData })
        .then((res) => res.text())
        .then((text) => {
            url = text;
        });

    return url;
};