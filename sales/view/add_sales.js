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

const addSales = async () => {
    let amount = document.querySelector("#amount");
    let item_type = document.querySelector("#item_type");
    let payment_type = document.querySelector("#payment_type");

    const form = new FormData();
    form.append("amount", amount.value);
    form.append("item_type", item_type.value);
    form.append("payment_type", payment_type.value);
    let url = await geturl("add_sales");
    await fetch(url, { method: "POST", body: form })
        .then((response) => response.text())
        .then((text) => {
            if (text === "success") {
                amount.value = "";
                item_type.value = "1";
                payment_type.value = "1";
            } else {
                alert(text)
            }
        });


}
const load_daily_info = async () => {
    let url = await geturl("sales_services_show_info");
    await fetch(url, { method: "POST" })
        .then((response) => response.json())
        .then((json) => {
            console.log(json.total_sales)
            document.querySelector("#total_sales").value = json.total_sales;
            document.querySelector("#cement_sales").value = json.cement_sales;
            document.querySelector("#other_sales").value = json.other_sales;
            document.querySelector("#card_sales").value = json.card_sales;
        });
}
window.addEventListener('load', async () => {
    await load_daily_info();
})
const btn = document.querySelector("#add_btn");

btn.addEventListener('click', async () => {
    addSales();
    await load_daily_info();

})