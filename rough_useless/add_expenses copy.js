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
// import { NaviUrl } from "../../util/path_config/NaviUrl.js";

// let geturl = async (urlname)=>{
//     const naviUrl = new NaviUrl();
//     naviUrl.geturl(urlname);
// }
const loadDescripions = async () => {
    let url = await geturl("expenses_load_description");
    let description = [];
    await fetch(url, { method: "POST" })
        .then((res) => res.json())
        .then((data) => {
            description = data;
        })
    console.log(description)
    return description;

}




const searchBox = document.querySelector("#searchBox");
const resultBox = document.querySelector("#resultBox");

let appendOnTextBox = (id) => {
    console.log(id);
    // searchBox.value = id;
    // searchHelper.clearEverything();
}
class SearchHelper {
    suggestions;
    searchBox;
    resultBox;
    emptyArray = [];
    constructor(searchBox, resultBox) {

        this.searchBox = searchBox;
        this.resultBox = resultBox;
        this.init();
        console.log("bro")
    }
    async init() {
        this.suggestions = await loadDescripions();
    }
    do() {
        this.searchBox.addEventListener('keyup', (event) => {
            let userData = event.target.value;

            if (userData) {
                this.emptyArray = this.suggestions.filter((data) => {

                    return data.toLocaleLowerCase().startsWith(userData.toLocaleLowerCase());
                })
                let id = 0;
                this.emptyArray = this.emptyArray.map((data) => {
                    const litag = document.createElement("li");
                    litag.innerHTML = data;
                    litag.setAttribute("id", id);
                    this.appendOnclick(litag)
                    id++;
                    return litag;
                })
                this.insertIntoResultBox(this.emptyArray)
                this.emptyArray = []
            } else {
                this.removeChildElements();
            }

        })
    }
    appendOnclick = (litag) => {
        litag.setAttribute("onclick", `appendOnTextBox('${litag.innerHTML}')`)
    }
    clearEverything = () => {
        this.removeChildElements();
        this.emptyArray = [];
    }

    removeChildElements = () => {
        while (this.resultBox.hasChildNodes())
            this.resultBox.removeChild(this.resultBox.firstChild)

    }
    insertIntoResultBox = (array) => {

        this.removeChildElements();
        array.forEach(element => {
            this.resultBox.appendChild(element)
        });

    }
}
const searchHelper = new SearchHelper(searchBox, resultBox);
searchHelper.do();

