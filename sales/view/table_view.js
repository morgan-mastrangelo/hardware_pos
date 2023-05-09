
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
const loadTable = async () => {
    let tableContainer = document.querySelector("#table_container");
    let item_type = document.querySelector("#item_type");
    let payment_type = document.querySelector("#payment_type");
    let date = document.querySelector("#date");
    console.log(date.value)
    const form = new FormData();
    form.append("payment_type_id", payment_type.value)
    form.append("item_type_id", item_type.value)
    form.append("date", date.value)


   
    let url = await geturl("table_for_sales");
    await fetch(url, { method: "POST",body:form })
        .then((response) => response.text())
        .then((json) => {
       
            tableContainer.innerHTML = json;
        });

}
// window.addEventListener('load', async () => {
//     await loadTable();
// })
