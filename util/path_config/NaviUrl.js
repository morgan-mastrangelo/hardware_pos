
export  class  NaviUrl {
     naviurl = "/hardware_pos_system/util/path_config/get_link.php";
   
    async geturl(urlname) {

        let url;
        let formData = new FormData();
        formData.append("url_name", urlname);

        await fetch(this.naviurl, { method: "POST", body: formData })
            .then((res) => res.text())
            .then((text) => {
                url = text;
            });
        console.log(url)
        return url;
    };
}